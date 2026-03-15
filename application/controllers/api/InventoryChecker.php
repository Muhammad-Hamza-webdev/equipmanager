<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Inventory Checker API Controller
 * 
 * Provides real-time inventory availability checks for equipment and workforce.
 * This allows the frontend to give immediate feedback to users when they select
 * dates or quantities that aren't available.
 */
class InventoryChecker extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Payment_model', 'payment');
        // We only want AJAX requests here to keep things clean
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        }
    }

    /**
     * Check Availability
     * 
     * Verifies if the requested quantity of an item is available for the selected date range.
     * Takes into account existing bookings to prevent overbooking.
     */
    public function check()
    {
        $item_id = $this->input->post('item_id');
        $item_type = $this->input->post('item_type'); // 1=Equipment, 2=Workforce
        $start_date = $this->input->post('start_date');
        $end_date = $this->input->post('end_date');
        $quantity = (int)$this->input->post('quantity');

        if (!$item_id || !$start_date || !$end_date) {
            $this->json_response(['success' => false, 'message' => 'Missing required information']);
            return;
        }

        // Default quantity to 1 if not provided
        if ($quantity < 1) $quantity = 1;

        try {
            $is_available = false;
            $message = '';
            $available_qty = 0;

            if ($item_type == 1) {
                // Checking Equipment Stock
                $equipment_id = $this->payment->getEquipmentIDByItemID($item_id);
                if (!$equipment_id) throw new Exception('Equipment not found');

                $available_qty = $this->payment->getAvailableQuantity($equipment_id, $start_date, $end_date);

                if ($available_qty >= $quantity) {
                    $is_available = true;
                    $message = 'In Stock';
                } else {
                    $is_available = false;
                    $message = "Only {$available_qty} units available for these dates";
                }
            } else {
                // Checking Workforce Availability
                // Workforce is either available (1) or not (0), they can't be split
                $workforce_id = $this->payment->getWorkforceIDByItemID($item_id);
                if (!$workforce_id) throw new Exception('Workforce not found');

                if ($this->payment->isWorkforceAvailable($workforce_id, $start_date, $end_date)) {
                    $is_available = true;
                    $message = 'Available';
                } else {
                    $is_available = false;
                    $message = 'Not available for selected dates';
                }
            }

            $this->json_response([
                'success' => true,
                'available' => $is_available,
                'available_quantity' => $available_qty,
                'message' => $message
            ]);
        } catch (Exception $e) {
            $this->json_response(['success' => false, 'message' => $e->getMessage()]);
        }
    }

    private function json_response($data)
    {
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($data));
    }
}
