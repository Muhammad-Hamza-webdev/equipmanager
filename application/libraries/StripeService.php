<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Stripe Service Library
 * 
 * Handles all Stripe API interactions including:
 * - Checkout session creation
 * - Webhook signature verification
 * - Payment processing
 * - Refund handling
 * 
 * @package    EquipManager
 * @subpackage Libraries
 * @category   Payment
 * @author     EquipManager Team
 * @link       https://stripe.com/docs/api
 */

// Include Stripe PHP SDK (install via composer: composer require stripe/stripe-php)
require_once FCPATH . 'vendor/autoload.php';

use Stripe\Stripe;
use Stripe\Checkout\Session;
use Stripe\Webhook;
use Stripe\Exception\SignatureVerificationException;

class StripeService
{
    protected $CI;
    protected $mode;
    protected $secret_key;
    protected $publishable_key;
    protected $webhook_secret;
    protected $currency;

    public function __construct()
    {
        $this->CI =& get_instance();
        $this->CI->load->config('stripe');
        
        // Load configuration
        $this->mode = $this->CI->config->item('stripe_mode');
        $this->currency = $this->CI->config->item('stripe_currency');
        
        // Set API keys based on mode
        if ($this->mode === 'live') {
            $this->secret_key = $this->CI->config->item('stripe_live_secret_key');
            $this->publishable_key = $this->CI->config->item('stripe_live_publishable_key');
            $this->webhook_secret = $this->CI->config->item('stripe_live_webhook_secret');
        } else {
            $this->secret_key = $this->CI->config->item('stripe_test_secret_key');
            $this->publishable_key = $this->CI->config->item('stripe_test_publishable_key');
            $this->webhook_secret = $this->CI->config->item('stripe_test_webhook_secret');
        }
        
        // Initialize Stripe with secret key
        Stripe::setApiKey($this->secret_key);
    }

    /**
     * Get publishable key for frontend
     * 
     * @return string Stripe publishable key
     */
    public function getPublishableKey()
    {
        return $this->publishable_key;
    }

    /**
     * Get secret key for backend
     * 
     * @return string Stripe secret key
     */
    public function getSecretKey()
    {
        return $this->secret_key;
    }

    /**
     * Create a Stripe Checkout Session
     * 
     * @param array $params Payment parameters
     * @return array|false Session data or false on failure
     */
    public function createCheckoutSession($params)
    {
        try {
            // Validate required parameters
            $required = ['amount', 'item_id', 'buyer_user_id', 'seller_company_id', 'item_name'];
            foreach ($required as $field) {
                if (empty($params[$field])) {
                    throw new Exception("Missing required field: {$field}");
                }
            }

            // Convert amount to cents (Stripe expects smallest currency unit)
            $amount_cents = intval($params['amount'] * 100);

            // Build line items
            $line_items = [
                [
                    'price_data' => [
                        'currency' => $this->currency,
                        'product_data' => [
                            'name' => $params['item_name'],
                            'description' => isset($params['item_description']) ? $params['item_description'] : '',
                        ],
                        'unit_amount' => $amount_cents,
                    ],
                    'quantity' => isset($params['quantity']) ? intval($params['quantity']) : 1,
                ]
            ];

            // Build metadata
            $metadata = [
                'item_id' => $params['item_id'],
                'buyer_user_id' => $params['buyer_user_id'],
                'seller_company_id' => $params['seller_company_id'],
                'quantity' => isset($params['quantity']) ? $params['quantity'] : 1,
            ];

            // Add rental dates if provided
            if (!empty($params['rental_start_date'])) {
                $metadata['rental_start_date'] = $params['rental_start_date'];
            }
            if (!empty($params['rental_end_date'])) {
                $metadata['rental_end_date'] = $params['rental_end_date'];
            }

            // Create checkout session
            $session = Session::create([
                'payment_method_types' => ['card'],
                'line_items' => $line_items,
                'mode' => 'payment',
                'success_url' => $this->CI->config->item('stripe_success_url') . '?session_id={CHECKOUT_SESSION_ID}',
                'cancel_url' => $this->CI->config->item('stripe_cancel_url'),
                'metadata' => $metadata,
                'customer_email' => isset($params['customer_email']) ? $params['customer_email'] : null,
            ]);

            return [
                'success' => true,
                'session_id' => $session->id,
                'session_url' => $session->url,
            ];

        } catch (Exception $e) {
            log_message('error', 'Stripe Checkout Session Error: ' . $e->getMessage());
            return [
                'success' => false,
                'error' => $e->getMessage(),
            ];
        }
    }

    /**
     * Verify webhook signature
     * 
     * @param string $payload Raw POST body
     * @param string $sig_header Stripe-Signature header
     * @return object|false Stripe event object or false on failure
     */
    public function verifyWebhookSignature($payload, $sig_header)
    {
        try {
            $event = Webhook::constructEvent(
                $payload,
                $sig_header,
                $this->webhook_secret
            );
            return $event;
        } catch (SignatureVerificationException $e) {
            log_message('error', 'Webhook signature verification failed: ' . $e->getMessage());
            return false;
        } catch (Exception $e) {
            log_message('error', 'Webhook error: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * Retrieve a checkout session
     * 
     * @param string $session_id Stripe session ID
     * @return object|false Session object or false on failure
     */
    public function retrieveSession($session_id)
    {
        try {
            $session = Session::retrieve($session_id);
            return $session;
        } catch (Exception $e) {
            log_message('error', 'Retrieve session error: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * Create a refund
     * 
     * @param string $payment_intent_id Stripe Payment Intent ID
     * @param int $amount Amount to refund in cents (optional, full refund if not provided)
     * @return array Refund result
     */
    public function createRefund($payment_intent_id, $amount = null)
    {
        try {
            $refund_params = ['payment_intent' => $payment_intent_id];
            
            if ($amount !== null) {
                $refund_params['amount'] = intval($amount);
            }

            $refund = \Stripe\Refund::create($refund_params);

            return [
                'success' => true,
                'refund_id' => $refund->id,
                'status' => $refund->status,
            ];

        } catch (Exception $e) {
            log_message('error', 'Refund error: ' . $e->getMessage());
            return [
                'success' => false,
                'error' => $e->getMessage(),
            ];
        }
    }

    /**
     * Calculate commission and net amount
     * 
     * @param float $gross_amount Total payment amount
     * @param float $commission_percent Commission percentage
     * @return array Commission details
     */
    public function calculateCommission($gross_amount, $commission_percent)
    {
        $commission_amount = ($gross_amount * $commission_percent) / 100;
        $net_amount = $gross_amount - $commission_amount;

        return [
            'gross_amount' => round($gross_amount, 2),
            'commission_percent' => round($commission_percent, 2),
            'commission_amount' => round($commission_amount, 2),
            'net_amount' => round($net_amount, 2),
        ];
    }
}
