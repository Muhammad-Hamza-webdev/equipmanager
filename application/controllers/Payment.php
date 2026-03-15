<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Payment Controller
 * 
 * Handles payment processing, checkout sessions, and payment confirmation
 * 
 * @package    EquipManager
 * @subpackage Controllers
 * @category   Payment
 */

class Payment extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('StripeService');
        $this->load->model('Payment_model', 'payment');
        $this->load->model('Generic_model', 'generic');
    }

    /**
     * Create Stripe Checkout Session
     * Server-side price calculation - NEVER trust frontend amounts
     */
    public function createCheckout()
    {
        // SECURITY: Verify user is logged in
        if (!$this->session->userdata('loginData')) {
            echo json_encode(['success' => false, 'error' => 'User not authenticated']);
            return;
        }

        // Get POST data
        $item_id = $this->input->post('item_id');
        $quantity = intval($this->input->post('quantity'));
        $rental_start_date = $this->input->post('rental_start_date');
        $rental_end_date = $this->input->post('rental_end_date');

        // Validate inputs
        if (!$item_id || $quantity < 1) {
            echo json_encode(['success' => false, 'error' => 'Invalid item or quantity']);
            return;
        }

        // Get item details from database (SECURITY: Calculate price server-side)
        $item = $this->generic->GetData('shopitem', ['itemID' => $item_id]);

        if (!$item || $item[0]['itemStatus'] != 1 || $item[0]['liveStatus'] != 1) {
            echo json_encode(['success' => false, 'error' => 'Item not available']);
            return;
        }

        $item_data = $item[0];
        $item_type = $item_data['itemType']; // 1=equipment, 2=workforce
        $sale_type = $item_data['saleType']; // 0=rental, 1=sale

        // Get item-specific details
        if ($item_type == 1) {
            // Equipment
            $shop_equipment = $this->generic->GetData('shopequipments', ['itemID' => $item_id]);

            if (!$shop_equipment) {
                echo json_encode(['success' => false, 'error' => 'Equipment not found']);
                return;
            }

            $equipment_data = $shop_equipment[0];
            $equipment_id = $equipment_data['equipmentID'];

            // Get equipment name
            $equipment = $this->generic->GetData('equipment', ['equipmentID' => $equipment_id]);
            $item_name = $equipment[0]['equipName'];

            // Secure Inventory Check
            $available_qty = $this->payment->getAvailableQuantity($item_data['equipmentID'], $rental_start_date, $rental_end_date);
            if ($quantity > $available_qty) {
                echo json_encode(['success' => false, 'error' => "Insufficient inventory. Only {$available_qty} units available."]);
                return;
            }

            $unit_price = floatval($equipment_data['eqpPrice']);
        } else {
            // Workforce
            $shop_workforce = $this->generic->GetData('shopworkforce', ['itemID' => $item_id]);

            if (!$shop_workforce) {
                echo json_encode(['success' => false, 'error' => 'Workforce not found']);
                return;
            }

            $workforce_data = $shop_workforce[0];
            $workforce_id = $workforce_data['workforceID'];

            // Get workforce name
            $workforce = $this->generic->GetData('workforce', ['workforceID' => $workforce_id]);
            $item_name = $workforce[0]['personName'];

            // Secure Availability Check
            if (!$this->payment->isWorkforceAvailable($workforce_id, $rental_start_date, $rental_end_date)) {
                echo json_encode(['success' => false, 'error' => 'Workforce is not available for requested dates.']);
                return;
            }

            $unit_price = floatval($workforce_data['workforcePrice']);
            $quantity = 1; // Workforce is always quantity 1
        }

        // Secure Server-Side Price Calculation
        $calculation = $this->payment->calculateTotalCost(
            $item_type,
            $item_type == 1 ? $equipment_data : $workforce_data,
            $quantity,
            $rental_start_date,
            $rental_end_date,
            ($sale_type == 1) ? 'purchase' : 'rental'
        );

        if ($calculation['error']) {
            echo json_encode(['success' => false, 'error' => $calculation['error']]);
            return;
        }

        $total_amount = $calculation['total'];

        // Define rental type for payment record
        $rental_type = null;
        if ($sale_type == 0) { // Rental
            $rental_type = ($item_type == 1) ? $equipment_data['eqpRentalType'] : $workforce_data['workforceRentalType'];
        }

        // Get user and company details
        $user_id = $this->session->userdata('loginData')['userID'];
        $user = $this->generic->GetData('users', ['userID' => $user_id]);
        $company_id = $item_data['companyID'];

        // Create payment record BEFORE Stripe session (for tracking)
        // Route to appropriate payment table based on item type
        if ($item_type == 1) {
            // Equipment payment
            $payment_id = $this->payment->createEquipmentPayment([
                'item_id' => $item_id,
                'equipment_id' => $equipment_id,
                'buyer_user_id' => $user_id,
                'seller_company_id' => $company_id,
                'gross_amount' => $total_amount,
                'quantity' => $quantity,
                'sale_type' => $sale_type == 1 ? 'purchase' : 'rental',
                'rental_start_date' => $rental_start_date,
                'rental_end_date' => $rental_end_date,
                'rental_type' => isset($rental_type) ? $this->mapRentalType($rental_type) : null,
            ]);
        } else {
            // Workforce payment
            $payment_id = $this->payment->createWorkforcePayment([
                'item_id' => $item_id,
                'workforce_id' => $workforce_id,
                'buyer_user_id' => $user_id,
                'seller_company_id' => $company_id,
                'gross_amount' => $total_amount,
                'rental_start_date' => $rental_start_date,
                'rental_end_date' => $rental_end_date,
                'rental_type' => $this->mapRentalType($rental_type),
            ]);
        }

        // Create Stripe Checkout Session
        $session_result = $this->stripeservice->createCheckoutSession([
            'amount' => $total_amount,
            'item_id' => $item_id,
            'buyer_user_id' => $user_id,
            'seller_company_id' => $company_id,
            'item_name' => $item_name,
            'item_description' => $sale_type == 0 ? "Rental: {$rental_start_date} to {$rental_end_date}" : "Purchase",
            'quantity' => $quantity,
            'rental_start_date' => $rental_start_date,
            'rental_end_date' => $rental_end_date,
            'customer_email' => $user[0]['userEmail'],
        ]);

        if ($session_result['success']) {
            // Update payment with session ID
            if ($item_type == 1) {
                $this->payment->updateEquipmentPaymentStatus($payment_id, 'pending', [
                    'stripeSessionID' => $session_result['session_id'],
                ]);
            } else {
                $this->payment->updateWorkforcePaymentStatus($payment_id, 'pending', [
                    'stripeSessionID' => $session_result['session_id'],
                ]);
            }

            echo json_encode([
                'success' => true,
                'session_id' => $session_result['session_id'],
                'session_url' => $session_result['session_url'],
            ]);
        } else {
            // Failed to create session
            if ($item_type == 1) {
                $this->payment->updateEquipmentPaymentStatus($payment_id, 'failed');
            } else {
                $this->payment->updateWorkforcePaymentStatus($payment_id, 'failed');
            }
            echo json_encode(['success' => false, 'error' => $session_result['error']]);
        }
    }

    /**
     * Payment success callback
     */
    public function success()
    {
        $session_id = $this->input->get('session_id');

        if (!$session_id) {
            redirect(base_url());
            return;
        }

        // Retrieve session from Stripe
        $session = $this->stripeservice->retrieveSession($session_id);

        if (!$session) {
            $this->data['error'] = 'Payment session not found';
            $this->load->view('payment/error', $this->data);
            return;
        }

        // Get payment from database (check both tables)
        $payment = $this->payment->getEquipmentPaymentBySessionId($session_id);

        if (!$payment) {
            $payment = $this->payment->getWorkforcePaymentBySessionId($session_id);
            if ($payment) {
                $payment['paymentType'] = 'workforce';
            }
        } else {
            $payment['paymentType'] = 'equipment';
        }

        if (!$payment) {
            $this->data['error'] = 'Payment record not found';
            $this->load->view('payment/error', $this->data);
            return;
        }

        $this->data['payment'] = $payment;
        $this->data['session'] = $session;
        $this->load->view('payment/success', $this->data);
    }

    /**
     * Payment cancelled callback
     */
    public function cancel()
    {
        $this->load->view('payment/cancel');
    }

    /**
     * View payment history for logged-in user
     */
    public function history()
    {
        // Check authentication
        if (!$this->session->userdata('loginData')) {
            redirect(base_url('login'));
            return;
        }

        $user_id = $this->session->userdata('loginData')['userID'];
        $user_type = $this->session->userdata('loginData')['userType'];

        // Get payments based on user type (combined equipment + workforce)
        if ($user_type == 2) {
            // Company Admin: Show payments to their company
            $company_id = $this->session->userdata('companyDetails')['companyID'];
            $this->data['payments'] = $this->payment->getAllPaymentsBySeller($company_id);
        } else {
            // Regular user: Show their purchases
            $this->data['payments'] = $this->payment->getAllPaymentsByBuyer($user_id);
        }

        $this->load->view('payment/history', $this->data);
    }

    /**
     * Get Stripe publishable key for frontend
     */
    public function getPublishableKey()
    {
        echo json_encode([
            'success' => true,
            'publishable_key' => $this->stripeservice->getPublishableKey(),
        ]);
    }

    /**
     * Helper: Map rental type integer to enum string
     * 
     * @param int $rental_type Rental type (1-4)
     * @return string Enum value
     */
    private function mapRentalType($rental_type)
    {
        $map = [
            1 => 'daily',
            2 => 'weekly',
            3 => 'monthly',
            4 => 'yearly'
        ];

        return isset($map[$rental_type]) ? $map[$rental_type] : 'daily';
    }
}
