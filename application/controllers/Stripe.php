<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Stripe Webhook Controller
 * 
 * Handles Stripe webhook events with signature verification
 * CRITICAL: This endpoint must be publicly accessible
 * 
 * @package    EquipManager
 * @subpackage Controllers
 * @category   Payment
 */

class Stripe extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('StripeService');
        $this->load->model('Payment_model', 'payment');
        $this->load->model('Generic_model', 'generic');
    }

    /**
     * Webhook endpoint
     * URL: /stripe/webhook
     * 
     * SECURITY REQUIREMENTS:
     * - Verify Stripe signature
     * - Idempotent processing (handle duplicate events)
     * - Log all events for audit trail
     */
    public function webhook()
    {
        // Get raw POST body
        $payload = @file_get_contents('php://input');
        $sig_header = $_SERVER['HTTP_STRIPE_SIGNATURE'] ?? '';

        // Log webhook received
        log_message('info', 'Stripe webhook received');

        // Verify signature
        $event = $this->stripeservice->verifyWebhookSignature($payload, $sig_header);

        if (!$event) {
            log_message('error', 'Webhook signature verification failed');
            http_response_code(400);
            echo json_encode(['error' => 'Invalid signature']);
            return;
        }

        // Get event type and data
        $event_type = $event->type;
        $event_data = $event->data->object;

        log_message('info', "Processing webhook event: {$event_type}");

        // Handle different event types
        switch ($event_type) {
            case 'checkout.session.completed':
                $this->handleCheckoutCompleted($event_data);
                break;

            case 'payment_intent.succeeded':
                $this->handlePaymentSucceeded($event_data);
                break;

            case 'payment_intent.payment_failed':
                $this->handlePaymentFailed($event_data);
                break;

            case 'charge.refunded':
                $this->handleChargeRefunded($event_data);
                break;

            default:
                log_message('info', "Unhandled event type: {$event_type}");
        }

        // Return 200 to acknowledge receipt
        http_response_code(200);
        echo json_encode(['success' => true]);
    }

    /**
     * Handle checkout.session.completed event
     * This fires when checkout is completed, before payment is processed
     */
    private function handleCheckoutCompleted($session)
    {
        $session_id = $session->id;
        $payment_intent_id = $session->payment_intent;
        $metadata = $session->metadata;

        log_message('info', "Checkout completed: {$session_id}");

        // IDEMPOTENCY: Check if already processed (check both tables)
        $equipment_payment = $this->payment->getEquipmentPaymentBySessionId($session_id);
        $workforce_payment = $this->payment->getWorkforcePaymentBySessionId($session_id);

        $existing_payment = null;
        $payment_type = null;
        $payment_id = null;

        if ($equipment_payment) {
            $existing_payment = $equipment_payment;
            $payment_type = 'equipment';
            $payment_id = $equipment_payment['equipmentPaymentID'];
        } elseif ($workforce_payment) {
            $existing_payment = $workforce_payment;
            $payment_type = 'workforce';
            $payment_id = $workforce_payment['workforcePaymentID'];
        }

        if (!$existing_payment) {
            log_message('error', "Payment record not found for session: {$session_id}");
            return;
        }

        // Update payment with Payment Intent ID
        if ($payment_type === 'equipment') {
            $this->payment->updateEquipmentPaymentStatus($payment_id, 'pending', [
                'stripePaymentIntentID' => $payment_intent_id,
            ]);
        } else {
            $this->payment->updateWorkforcePaymentStatus($payment_id, 'pending', [
                'stripePaymentIntentID' => $payment_intent_id,
            ]);
        }

        log_message('info', "Payment {$payment_id} ({$payment_type}) updated with Payment Intent: {$payment_intent_id}");
    }

    /**
     * Handle payment_intent.succeeded event
     * This is the CRITICAL event - payment is confirmed
     */
    private function handlePaymentSucceeded($payment_intent)
    {
        $payment_intent_id = $payment_intent->id;
        $amount_received = $payment_intent->amount_received / 100; // Convert from cents

        log_message('info', "Payment succeeded: {$payment_intent_id}, Amount: {$amount_received}");

        // IDEMPOTENCY: Get payment by Payment Intent ID (check both tables)
        $equipment_payment = $this->payment->getEquipmentPaymentByIntentId($payment_intent_id);
        $workforce_payment = $this->payment->getWorkforcePaymentByIntentId($payment_intent_id);

        $payment = null;
        $payment_type = null;
        $payment_id = null;
        $payment_table = null;
        $payment_pk = null;

        if ($equipment_payment) {
            $payment = $equipment_payment;
            $payment_type = 'equipment';
            $payment_id = $equipment_payment['equipmentPaymentID'];
            $payment_table = 'equipment_payments';
            $payment_pk = 'equipmentPaymentID';
        } elseif ($workforce_payment) {
            $payment = $workforce_payment;
            $payment_type = 'workforce';
            $payment_id = $workforce_payment['workforcePaymentID'];
            $payment_table = 'workforce_payments';
            $payment_pk = 'workforcePaymentID';
        }

        if (!$payment) {
            log_message('error', "Payment record not found for Payment Intent: {$payment_intent_id}");
            return;
        }

        // RACE CONDITION FIX: Begin transaction and re-read with exclusive row lock
        // This prevents duplicate webhook processing under concurrent delivery
        $this->db->trans_start();

        $locked_query = $this->db->query(
            "SELECT {$payment_pk}, paymentStatus FROM `{$payment_table}` WHERE {$payment_pk} = ? FOR UPDATE",
            [$payment_id]
        );

        if (!$locked_query || $locked_query->num_rows() === 0) {
            $this->db->trans_rollback();
            log_message('error', "Row lock failed for payment {$payment_id}");
            return;
        }

        $locked_row = $locked_query->row_array();

        // Check if already processed inside the lock
        if ($locked_row['paymentStatus'] === 'paid') {
            $this->db->trans_rollback();
            log_message('info', "Payment {$payment_id} ({$payment_type}) already processed (detected under lock), skipping");
            return;
        }

        try {
            // 1. Update payment status to paid
            if ($payment_type === 'equipment') {
                $this->payment->updateEquipmentPaymentStatus($payment_id, 'paid', [
                    'stripePaymentIntentID' => $payment_intent_id
                ]);

                // 2. Lock inventory for equipment
                $this->payment->lockEquipmentInventory($payment['equipmentID'], $payment['quantity']);
                log_message('info', "Locked {$payment['quantity']} units of equipment {$payment['equipmentID']}");
            } else {
                $this->payment->updateWorkforcePaymentStatus($payment_id, 'paid', [
                    'stripePaymentIntentID' => $payment_intent_id
                ]);
            }

            // 3. Create payout record (pending SuperAdmin approval)
            // Commission already calculated and stored in payment record
            if ($payment_type === 'equipment') {
                $this->payment->createEquipmentPayout(
                    $payment_id,
                    $payment['sellerCompanyID'],
                    $payment['netAmount']
                );
            } else {
                $this->payment->createWorkforcePayout(
                    $payment_id,
                    $payment['sellerCompanyID'],
                    $payment['netAmount']
                );
            }

            log_message('info', "Payout created for company {$payment['sellerCompanyID']}: {$payment['netAmount']} (Commission: {$payment['commissionAmount']})");

            // ===== CREATE CHAT FOR ORDER =====
            // Automatically create chat between buyer and seller
            $this->load->model('Chat_model');

            $chatID = null;
            if ($payment_type === 'equipment') {
                $chatID = $this->Chat_model->create_chat(
                    $payment_id,
                    $payment['buyerUserID'],
                    $payment['sellerCompanyID']
                );
            } else {
                // Workforce payments also get chat
                $chatID = $this->Chat_model->create_chat(
                    $payment_id,
                    $payment['buyerUserID'],
                    $payment['sellerCompanyID']
                );
            }

            if ($chatID) {
                log_message('info', "Chat created for {$payment_type} payment {$payment_id}: Chat ID {$chatID}");
            } else {
                log_message('error', "Failed to create chat for {$payment_type} payment {$payment_id}");
            }


            // 4. Send email notification to buyer
            $buyer = $this->generic->GetData('users', ['userID' => $payment['buyerUserID']]);

            if ($buyer) {
                $email_subject = 'Payment Confirmed - EquipManager';
                $email_message = "
                    <h2>Payment Confirmed</h2>
                    <p>Your payment of \${$payment['grossAmount']} has been successfully processed.</p>
                    <p>Payment ID: {$payment_id}</p>
                    <p>Type: " . ucfirst($payment_type) . "</p>
                    <p>Thank you for using EquipManager!</p>
                ";
                $this->send_email($buyer[0]['userEmail'], $email_subject, $email_message);
            }

            // 5. Send notification to seller
            $company = $this->generic->GetData('companydetail', ['companyID' => $payment['sellerCompanyID']]);

            if ($company) {
                $company_user = $this->generic->GetData('users', ['userID' => $company[0]['userID']]);

                if ($company_user) {
                    $email_subject = 'New Sale - Pending Payout - EquipManager';
                    $email_message = "
                        <h2>New Sale Received</h2>
                        <p>You have received a new " . $payment_type . " sale of \${$payment['grossAmount']}.</p>
                        <p>Commission ({$payment['commissionPercent']}%): \${$payment['commissionAmount']}</p>
                        <p>Your payout amount: \${$payment['netAmount']}</p>
                        <p>Payout is pending SuperAdmin approval.</p>
                    ";
                    $this->send_email($company_user[0]['userEmail'], $email_subject, $email_message);
                }
            }

            $this->db->trans_complete();

            if ($this->db->trans_status() === FALSE) {
                log_message('error', "Transaction failed for payment {$payment_id} ({$payment_type})");
            } else {
                log_message('info', "Payment {$payment_id} ({$payment_type}) processed successfully");
            }
        } catch (Exception $e) {
            $this->db->trans_rollback();
            log_message('error', "Exception processing payment: " . $e->getMessage());
        }
    }


    /**
     * Handle payment_intent.payment_failed event
     */
    private function handlePaymentFailed($payment_intent)
    {
        $payment_intent_id = $payment_intent->id;

        log_message('info', "Payment failed: {$payment_intent_id}");

        // Get payment by Payment Intent ID (check both tables)
        $equipment_payment = $this->payment->getEquipmentPaymentByIntentId($payment_intent_id);
        $workforce_payment = $this->payment->getWorkforcePaymentByIntentId($payment_intent_id);

        $payment = null;
        $payment_type = null;
        $payment_id = null;

        if ($equipment_payment) {
            $payment = $equipment_payment;
            $payment_type = 'equipment';
            $payment_id = $equipment_payment['equipmentPaymentID'];
        } elseif ($workforce_payment) {
            $payment = $workforce_payment;
            $payment_type = 'workforce';
            $payment_id = $workforce_payment['workforcePaymentID'];
        }

        if (!$payment) {
            log_message('error', "Payment record not found for Payment Intent: {$payment_intent_id}");
            return;
        }

        // Update payment status to failed
        if ($payment_type === 'equipment') {
            $this->payment->updateEquipmentPaymentStatus($payment_id, 'failed');
        } else {
            $this->payment->updateWorkforcePaymentStatus($payment_id, 'failed');
        }

        // Send email notification to buyer
        $buyer = $this->generic->GetData('users', ['userID' => $payment['buyerUserID']]);

        if ($buyer) {
            $email_subject = 'Payment Failed - EquipManager';
            $email_message = "
                <h2>Payment Failed</h2>
                <p>Your payment could not be processed.</p>
                <p>Please try again or contact support.</p>
            ";
            $this->send_email($buyer[0]['userEmail'], $email_subject, $email_message);
        }

        log_message('info', "Payment {$payment_id} ({$payment_type}) marked as failed");
    }

    /**
     * Handle charge.refunded event
     */
    private function handleChargeRefunded($charge)
    {
        $payment_intent_id = $charge->payment_intent;
        $amount_refunded = $charge->amount_refunded / 100;

        log_message('info', "Charge refunded: {$payment_intent_id}, Amount: {$amount_refunded}");

        // Get payment by Payment Intent ID (check both tables)
        $equipment_payment = $this->payment->getEquipmentPaymentByIntentId($payment_intent_id);
        $workforce_payment = $this->payment->getWorkforcePaymentByIntentId($payment_intent_id);

        $payment = null;
        $payment_type = null;
        $payment_id = null;

        if ($equipment_payment) {
            $payment = $equipment_payment;
            $payment_type = 'equipment';
            $payment_id = $equipment_payment['equipmentPaymentID'];
        } elseif ($workforce_payment) {
            $payment = $workforce_payment;
            $payment_type = 'workforce';
            $payment_id = $workforce_payment['workforcePaymentID'];
        }

        if (!$payment) {
            log_message('error', "Payment record not found for Payment Intent: {$payment_intent_id}");
            return;
        }

        // Update payment status to refunded
        if ($payment_type === 'equipment') {
            $this->payment->updateEquipmentPaymentStatus($payment_id, 'refunded');

            // Release inventory for equipment
            $this->payment->releaseEquipmentInventory($payment['equipmentID'], $payment['quantity']);
            log_message('info', "Released {$payment['quantity']} units of equipment {$payment['equipmentID']}");
        } else {
            $this->payment->updateWorkforcePaymentStatus($payment_id, 'refunded');
        }

        // Update payout status to rejected
        if ($payment_type === 'equipment') {
            $payout = $this->payment->getEquipmentPayoutByPaymentId($payment_id);
            if ($payout) {
                $this->payment->updateEquipmentPayoutStatus($payout['equipmentPayoutID'], 'rejected', null, 'Payment refunded');
            }
        } else {
            $payout = $this->payment->getWorkforcePayoutByPaymentId($payment_id);
            if ($payout) {
                $this->payment->updateWorkforcePayoutStatus($payout['workforcePayoutID'], 'rejected', null, 'Payment refunded');
            }
        }

        // Send email notification
        $buyer = $this->generic->GetData('users', ['userID' => $payment['buyerUserID']]);

        if ($buyer) {
            $email_subject = 'Refund Processed - EquipManager';
            $email_message = "
                <h2>Refund Processed</h2>
                <p>Your payment of \${$amount_refunded} has been refunded.</p>
                <p>Payment ID: {$payment_id}</p>
                <p>Type: " . ucfirst($payment_type) . "</p>
            ";
            $this->send_email($buyer[0]['userEmail'], $email_subject, $email_message);
        }

        // ===== LOCK CHAT FOR REFUNDED ORDER =====
        $this->load->helper('payment');
        $this->load->model('Chat_model');

        $chat = $this->Chat_model->get_chat_by_order($payment_id);
        if ($chat && $chat->chatStatus === 'open') {
            $this->Chat_model->lock_chat($chat->chatID);
            notify_node_chat_locked($chat->chatID);
            log_message('info', "Chat {$chat->chatID} locked due to refund for payment {$payment_id}");
        }

        log_message('info', "Payment {$payment_id} ({$payment_type}) refunded successfully");
    }

    /**
     * Send email helper
     */
    private function send_email($to, $subject, $message)
    {
        try {
            $this->load->library('email');
            $this->config->load('email');

            $this->email->from('info@nexphi.com', 'Equip Manager');
            $this->email->to($to);
            $this->email->subject($subject);
            $this->email->message($message);
            $this->email->send();
        } catch (Exception $e) {
            log_message('error', "Email send failed: " . $e->getMessage());
        }
    }
}
