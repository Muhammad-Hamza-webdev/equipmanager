<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Price Calculator API Controller
 * 
 * Handles secure server-side price calculations for equipment and workforce rentals/purchases.
 * This ensures that frontend price manipulation is impossible as the final payment amount
 * is always recalculated on the server.
 */
class PriceCalculator extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Payment_model', 'payment');
        $this->load->model('Generic_model', 'generic');

        // Ensure request is AJAX
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        }
    }

    /**
     * Calculate Price
     * 
     * Calculates the total price based on item type, rental duration, and quantity.
     * Returns a detailed breakdown of costs including commission.
     */
    public function calculate()
    {
        // Require authenticated session
        $login_data = $this->session->userdata('loginData');
        if (!$login_data || !isset($login_data['userID'])) {
            http_response_code(401);
            $this->json_response(['success' => false, 'message' => 'Unauthorised']);
            return;
        }

        // Get POST data
        $item_id = $this->input->post('item_id');
        $item_type = $this->input->post('item_type'); // 1=equipment, 2=workforce
        $sale_type = $this->input->post('sale_type'); // 0=rental, 1=purchase
        $quantity = (int)$this->input->post('quantity');
        $start_date = $this->input->post('start_date');
        $end_date = $this->input->post('end_date');

        // Basic validation
        if (!$item_id || !$item_type) {
            $this->json_response(['success' => false, 'message' => 'Invalid parameters']);
            return;
        }

        // Force quantity to 1 for workforce
        if ($item_type == 2) {
            $quantity = 1;
        }

        // Validate quantity
        if ($quantity < 1) {
            $this->json_response(['success' => false, 'message' => 'Quantity must be at least 1']);
            return;
        }

        try {
            // Fetch item details
            $item_data = [];

            if ($item_type == 1) {
                // Equipment
                $item = $this->generic->GetData('shopequipments', ['itemID' => $item_id]);
                if (!$item) throw new Exception('Item not found');
                $item_data = $item[0];

                $available_qty = $this->payment->getAvailableQuantity($item_data['equipmentID'], $start_date, $end_date);

                // Check stock
                if ($quantity > $available_qty) {
                    throw new Exception("Only {$available_qty} units available for selected dates");
                }
            } else {
                // Workforce
                $item = $this->generic->GetData('shopworkforce', ['itemID' => $item_id]);
                if (!$item) throw new Exception('Workforce not found');
                $item_data = $item[0];

                // Check availability
                if (!$this->payment->isWorkforceAvailable($item_data['workforceID'], $start_date, $end_date)) {
                    throw new Exception('Workforce is not available for selected dates');
                }
            }

            // Calculate cost using shared model logic
            $calculation = $this->payment->calculateTotalCost(
                $item_type,
                $item_data,
                $quantity,
                $start_date,
                $end_date,
                ($sale_type == 1) ? 'purchase' : 'rental'
            );

            if ($calculation['error']) {
                throw new Exception($calculation['error']);
            }

            $total_amount = $calculation['total'];
            $breakdown = $calculation['breakdown'];

            // Calculate commission
            $commission_percent = $this->payment->getGlobalCommissionRate();
            $commission_amount = ($total_amount * $commission_percent) / 100;

            $this->json_response([
                'success' => true,
                'data' => [
                    'total_amount' => number_format($total_amount, 2, '.', ''),
                    'commission' => number_format($commission_amount, 2, '.', ''),
                    'breakdown' => $breakdown
                ]
            ]);
        } catch (Exception $e) {
            $this->json_response(['success' => false, 'message' => $e->getMessage()]);
        }
    }

    /**
     * Helper to send JSON response
     */
    private function json_response($data)
    {
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($data));
    }
}
