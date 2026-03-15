<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Orders extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        
        // Load database and model
        $this->load->database();
        $this->load->model('Order_model');
    }

    /**
     * Display all orders for the logged-in user with optional status filtering
     */
    public function index()
    {
        // DEBUG: Log page load session
        $session_id = session_id();
        error_log("[ORDERS INDEX DEBUG] SessionID: $session_id");
        
        // MY_Controller ensures user is authenticated before this runs
        // Safely get userID from loginData
        $login_data = $this->session->userdata('loginData');
        
        error_log("[ORDERS INDEX DEBUG] LoginData exists: " . (isset($login_data) ? 'YES' : 'NO'));
        
        if (!$login_data || !isset($login_data['userID'])) {
            redirect('login');
        }
        
        $user_id = $login_data['userID'];
        error_log("[ORDERS INDEX DEBUG] User ID: $user_id");
        
        // Get filter parameter from URL
        $filter = $this->input->get('status');
        
        // Build query to get all orders
        $this->db->select([
            'ep.equipmentPaymentID',
            'ep.grossAmount',
            'ep.paymentStatus',
            'ep.orderStatus',
            'ep.checkoutToken',
            'ep.checkoutTokenExpiry',
            'ep.createdAt',
            'ep.quantity',
            'ep.saleType',
            'e.equipName',
            'ec.equipCatID',
            'ec.catName',
            'oc.chatID'
        ])
        ->from('equipment_payments ep')
        ->join('equipment e', 'ep.equipmentID = e.equipmentID', 'left')
        ->join('equipcat ec', 'e.equipCatID = ec.equipCatID', 'left')
        ->join('order_chats oc', 'ep.equipmentPaymentID = oc.equipmentPaymentID', 'left')
        ->where('ep.buyerUserID', $user_id);

        // Apply filter if provided
        if ($filter && !empty($filter)) {
            $valid_filters = ['requested', 'payment_pending', 'payment_secured', 'in_progress', 'shipped', 'pickup_ready', 'delivered', 'completed', 'rejected', 'cancelled'];
            if (in_array($filter, $valid_filters)) {
                $this->db->where('ep.orderStatus', $filter);
            }
        }

        // Order by newest first
        $this->db->order_by('ep.createdAt', 'DESC');

        $query = $this->db->get();
        $orders = $query->result();

        // Prepare data for view
        $data = [
            'orders' => $orders,
            'filter' => $filter
        ];

        // Load layout with component
        $this->load->view('orders/user_orders_list', $data);
    }

    /**
     * Display a single order details page
     * Note: Authentication is handled by MY_Controller (checks loginData)
     */
    public function view($order_id)
    {
        // MY_Controller ensures user is authenticated before this runs
        // Safely get userID from loginData
        $login_data = $this->session->userdata('loginData');
        
        if (!$login_data || !isset($login_data['userID'])) {
            redirect('login');
        }
        
        $user_id = $login_data['userID'];
        
        // Validate order ID is numeric
        if (!is_numeric($order_id)) {
            show_404();
            return;
        }
        
        // Get order details
        $this->db->select([
            'ep.equipmentPaymentID',
            'ep.grossAmount',
            'ep.commissionAmount',
            'ep.commissionPercent',
            'ep.netAmount',
            'ep.paymentStatus',
            'ep.orderStatus',
            'ep.createdAt',
            'ep.updatedAt',
            'ep.quantity',
            'ep.saleType',
            'ep.rentalStartDate',
            'ep.rentalEndDate',
            'ep.rentalType',
            'ep.itemID',
            'ep.trackingNumber',
            'ep.shippedAt',
            'e.equipName',
            'e.equipDesc',
            'e.equipImg',
            'ec.equipCatID',
            'ec.catName',
            'cd.companyName',
            'oc.chatID'
        ])
        ->from('equipment_payments ep')
        ->join('equipment e', 'ep.equipmentID = e.equipmentID', 'left')
        ->join('equipcat ec', 'e.equipCatID = ec.equipCatID', 'left')
        ->join('companydetail cd', 'ep.sellerCompanyID = cd.companyID', 'left')
        ->join('order_chats oc', 'ep.equipmentPaymentID = oc.equipmentPaymentID', 'left')
        ->where('ep.equipmentPaymentID', $order_id)
        ->where('ep.buyerUserID', $user_id);

        $query = $this->db->get();
        $order = $query->row();

        if (!$order) {
            show_404();
            return;
        }

        // Fetch shopequipments images for this item
        $images = array();
        
        // First, try to get images using itemID
        if (!empty($order->itemID)) {
            $this->db->select([
                'eqpimg1', 'eqpimg2', 'eqpimg3', 'eqpimg4', 'eqpimg5',
                'eqpimg6', 'eqpimg7', 'eqpimg8', 'eqpimg9', 'eqpimg10'
            ])
            ->from('shopequipments')
            ->where('itemID', $order->itemID)
            ->limit(1);
            
            $eq_query = $this->db->get();
            $shop_equipment = $eq_query->row();
            
            if ($shop_equipment) {
                // Collect all non-empty image paths
                for ($i = 1; $i <= 10; $i++) {
                    $img_field = 'eqpimg' . $i;
                    if (!empty($shop_equipment->$img_field)) {
                        $images[] = 'assets/website/images/' . $shop_equipment->$img_field;
                    }
                }
            }
        }
        
        // If still no images, try using equipmentID as fallback
        if (empty($images) && !empty($order->equipmentID)) {
            $this->db->select([
                'eqpimg1', 'eqpimg2', 'eqpimg3', 'eqpimg4', 'eqpimg5',
                'eqpimg6', 'eqpimg7', 'eqpimg8', 'eqpimg9', 'eqpimg10'
            ])
            ->from('shopequipments')
            ->where('equipmentID', $order->equipmentID)
            ->limit(1);
            
            $eq_query = $this->db->get();
            $shop_equipment = $eq_query->row();
            
            if ($shop_equipment) {
                // Collect all non-empty image paths
                for ($i = 1; $i <= 10; $i++) {
                    $img_field = 'eqpimg' . $i;
                    if (!empty($shop_equipment->$img_field)) {
                        $images[] = 'assets/website/images/' . $shop_equipment->$img_field;
                    }
                }
            }
        }
        
        // If still no images, use equipment's main image as fallback
        if (empty($images) && !empty($order->equipImg)) {
            $images[] = 'assets/website/images/' . $order->equipImg;
        }

        $data = [
            'order' => $order,
            'images' => $images
        ];

        $this->load->view('orders/detail_layout', $data);
    }

    /**
     * Get orders via AJAX (for dynamic loading)
     */
    public function ajax_get_orders()
    {
        $login_data = $this->session->userdata('loginData');
        
        if (!$login_data || !isset($login_data['userID'])) {
            http_response_code(401);
            header('Content-Type: application/json');
            echo json_encode(['success' => false, 'message' => 'Unauthorized']);
            return;
        }
        
        $user_id = $login_data['userID'];
        
        $page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
        $search = isset($_GET['search']) ? $this->db->escape_str($_GET['search']) : '';
        $per_page = 10;
        $offset = ($page - 1) * $per_page;

        // Base query
        $this->db->select([
            'ep.equipmentPaymentID',
            'ep.grossAmount',
            'ep.paymentStatus',
            'ep.createdAt',
            'ep.quantity',
            'e.equipName',
            'ec.catName'
        ])
        ->from('equipment_payments ep')
        ->join('equipment e', 'ep.equipmentID = e.equipmentID', 'left')
        ->join('equipcat ec', 'e.equipCatID = ec.equipCatID', 'left')
        ->where('ep.buyerUserID', $user_id);

        // Search filter
        if (!empty($search)) {
            $this->db->group_start()
                     ->like('e.equipName', $search)
                     ->or_like('ec.catName', $search)
                     ->or_like('ep.equipmentPaymentID', $search)
                     ->group_end();
        }

        $this->db->order_by('ep.createdAt', 'DESC')
                 ->limit($per_page, $offset);

        $query = $this->db->get();
        $orders = $query->result();

        // Get total count
        $this->db->select('COUNT(*) as total')
                 ->from('equipment_payments')
                 ->where('buyerUserID', $user_id);
        
        if (!empty($search)) {
            $this->db->group_start()
                     ->like('equipmentName', $search)
                     ->group_end();
        }
        
        $count_result = $this->db->get();
        $total = $count_result->row()->total;

        $response = [
            'success' => true,
            'orders' => $orders,
            'pagination' => [
                'current_page' => $page,
                'total_pages' => ceil($total / $per_page),
                'total' => $total,
                'per_page' => $per_page
            ]
        ];

        header('Content-Type: application/json');
        echo json_encode($response);
    }

    /**
     * Get order status statistics
     */
    public function ajax_get_statistics()
    {
        $login_data = $this->session->userdata('loginData');
        
        if (!$login_data || !isset($login_data['userID'])) {
            http_response_code(401);
            header('Content-Type: application/json');
            echo json_encode(['success' => false, 'message' => 'Unauthorized']);
            return;
        }

        $user_id = $login_data['userID'];

        $stats = $this->db->select('paymentStatus, COUNT(*) as count')
                          ->from('equipment_payments')
                          ->where('buyerUserID', $user_id)
                          ->group_by('paymentStatus')
                          ->get()
                          ->result();

        $response = [
            'success' => true,
            'statistics' => $stats
        ];

        header('Content-Type: application/json');
        echo json_encode($response);
    }

    /**
     * DEBUG: Test session data and routing
     * Access via /orders/test_session
     */
    public function test_session()
    {
        header('Content-Type: application/json');
        
        $login_data = $this->session->userdata('loginData');
        $session_id = session_id();
        $all_session_data = $this->session->userdata();
        
        $response = [
            'page' => 'orders/test_session',
            'route_successful' => true,
            'session_id' => $session_id,
            'loginData_exists' => isset($login_data),
            'loginData' => $login_data ?? null,
            'all_session_keys' => array_keys($all_session_data),
            'php_session_exists' => !empty($_SESSION),
            'timestamp' => date('Y-m-d H:i:s'),
            'message' => $login_data ? 'Session is ACTIVE' : 'Session DATA MISSING - This is the problem!'
        ];
        
        log_message('debug', 'DEBUG Session Test: ' . json_encode($response));
        echo json_encode($response);
    }

    /**
     * Confirm delivery of shipped order
     * POST only
     */
    public function confirm_delivery()
    {
        // Verify POST method
        if ($this->input->server('REQUEST_METHOD') !== 'POST') {
            show_error('Invalid request method', 405);
            return;
        }
        
        // DEBUG: Log detailed session information
        $session_id = session_id();
        $all_session_data = $this->session->userdata();
        error_log("[CONFIRM_DELIVERY DEBUG] SessionID: $session_id");
        error_log("[CONFIRM_DELIVERY DEBUG] All Session Data: " . json_encode($all_session_data));
        
        $login_data = $this->session->userdata('loginData');
        error_log("[CONFIRM_DELIVERY DEBUG] LoginData: " . json_encode($login_data));
        
        if (!$login_data || !isset($login_data['userID'])) {
            error_log("[CONFIRM_DELIVERY ERROR] Session loginData not found! Redirecting to login");
            $this->session->set_flashdata('error', 'Please log in to confirm delivery');
            redirect('login');
            return;
        }
        
        error_log("[CONFIRM_DELIVERY DEBUG] User authenticated: {$login_data['userID']}");
        
        $user_id = $login_data['userID'];
        $order_id = $this->input->post('order_id', TRUE);
        $order_id = intval($order_id);
        
        if (!$order_id) {
            $this->session->set_flashdata('error', 'Invalid order ID');
            redirect('orders');
            return;
        }
        
        // Verify order belongs to this buyer and is in shipped status
        $order = $this->db->select('ep.*, cd.companyID as sellerCompanyID, oc.chatID')
                          ->from('equipment_payments ep')
                          ->join('companydetail cd', 'ep.sellerCompanyID = cd.companyID', 'left')
                          ->join('order_chats oc', 'ep.equipmentPaymentID = oc.equipmentPaymentID', 'left')
                          ->where('ep.equipmentPaymentID', $order_id)
                          ->where('ep.buyerUserID', $user_id)
                          ->get()
                          ->row();
        
        if (!$order) {
            $this->session->set_flashdata('error', 'Order not found or access denied');
            redirect('orders');
            return;
        }
        
        if ($order->orderStatus !== 'shipped') {
            $this->session->set_flashdata('error', 'Order cannot be confirmed - not yet shipped. Current status: ' . $order->orderStatus);
            redirect('orders');
            return;
        }
        
        // Update order status to completed (directly since admin already marked as shipped)
        $update_data = [
            'orderStatus' => 'completed',
            'deliveredBy' => $user_id,
            'deliveredAt' => date('Y-m-d H:i:s'),
            'updatedAt' => date('Y-m-d H:i:s'),
            'completedAt' => date('Y-m-d H:i:s')
        ];
        
        $this->db->where('equipmentPaymentID', $order_id);
        $result = $this->db->update('equipment_payments', $update_data);
        
        if ($result) {
            // Send automated chat messages to both parties
            $this->load->model('Chat_model');
            
            if ($order->chatID) {
                // Message to seller
                $message = "Delivery Confirmed!\n\n"
                         . "Order #" . $order_id . "\n"
                         . "The buyer has confirmed receipt of the product.\n\n"
                         . "💰 Funds are being released to your account now.\n\n"
                         . "Thank you for your business!";
                
                $this->Chat_model->send_automated_message(
                    $order->chatID,
                    $message,
                    $order->sellerCompanyID,
                    'system'
                );
                
                // Message to buyer
                $buyer_message = "Thank you for confirming delivery!\n\n"
                               . "Order #" . $order_id . "\n"
                               . "Payment has been released to the seller.\n\n"
                               . "We hope you enjoy your purchase!";
                
                $this->Chat_model->send_automated_message(
                    $order->chatID,
                    $buyer_message,
                    $order->sellerCompanyID,
                    'system'
                );

                // Lock the chat — order is complete, no further messages needed
                $this->Chat_model->lock_chat($order->chatID);
            }
            
            // Trigger automatic fund release (if needed in future)
            // For now, funds are released immediately when order is marked completed
            // $this->release_funds($order_id);
            
            $this->session->set_flashdata('success', 'Delivery confirmed! Order completed and payment released to seller.');
            log_message('info', "Buyer {$user_id} confirmed delivery for order {$order_id}");
        } else {
            $this->session->set_flashdata('error', 'Failed to confirm delivery');
        }
        
        // Check if this is an AJAX request
        if ($this->input->is_ajax_request()) {
            // Return JSON response for AJAX
            $this->output->set_content_type('application/json')
                         ->set_output(json_encode([
                             'success' => $result,
                             'message' => $result ? 'Delivery confirmed successfully!' : 'Failed to confirm delivery',
                             'redirect' => base_url('orders')
                         ]));
        } else {
            // Regular form submission - redirect to orders page
            redirect('orders');
        }
    }

    /**
     * Confirm pickup of a pickup order (pickup_ready → completed)
     * POST only
     */
    public function confirm_pickup()
    {
        if ($this->input->server('REQUEST_METHOD') !== 'POST') {
            show_error('Invalid request method', 405);
            return;
        }

        $login_data = $this->session->userdata('loginData');
        if (!$login_data || !isset($login_data['userID'])) {
            $this->session->set_flashdata('error', 'Please log in to confirm pickup');
            redirect('login');
            return;
        }

        $user_id  = $login_data['userID'];
        $order_id = intval($this->input->post('order_id', TRUE));

        if (!$order_id) {
            $this->session->set_flashdata('error', 'Invalid order ID');
            redirect('orders');
            return;
        }

        $order = $this->db->select('ep.*, cd.companyID as sellerCompanyID, oc.chatID')
                          ->from('equipment_payments ep')
                          ->join('companydetail cd', 'ep.sellerCompanyID = cd.companyID', 'left')
                          ->join('order_chats oc', 'ep.equipmentPaymentID = oc.equipmentPaymentID', 'left')
                          ->where('ep.equipmentPaymentID', $order_id)
                          ->where('ep.buyerUserID', $user_id)
                          ->get()
                          ->row();

        if (!$order) {
            $this->session->set_flashdata('error', 'Order not found or access denied');
            redirect('orders');
            return;
        }

        if ($order->orderStatus !== 'pickup_ready') {
            $this->session->set_flashdata('error', 'Order cannot be confirmed — not yet ready for pickup. Current status: ' . $order->orderStatus);
            redirect('orders');
            return;
        }

        $update_data = [
            'orderStatus' => 'completed',
            'deliveredBy' => $user_id,
            'deliveredAt' => date('Y-m-d H:i:s'),
            'completedAt' => date('Y-m-d H:i:s'),
            'updatedAt'   => date('Y-m-d H:i:s'),
        ];

        $this->db->where('equipmentPaymentID', $order_id);
        $result = $this->db->update('equipment_payments', $update_data);

        if ($result) {
            $this->load->model('Chat_model');

            if ($order->chatID) {
                // Notify seller
                $seller_msg = "Pickup Confirmed!\n\n"
                            . "Order #" . $order_id . "\n"
                            . "The buyer has collected the item.\n\n"
                            . "Funds are being released to your account now.\n\n"
                            . "Thank you for your business!";

                $this->Chat_model->send_automated_message(
                    $order->chatID,
                    $seller_msg,
                    $order->sellerCompanyID,
                    'system'
                );

                // Notify buyer
                $buyer_msg = "Thank you for confirming pickup!\n\n"
                           . "Order #" . $order_id . "\n"
                           . "Payment has been released to the seller.\n\n"
                           . "We hope you enjoy your purchase!";

                $this->Chat_model->send_automated_message(
                    $order->chatID,
                    $buyer_msg,
                    $order->sellerCompanyID,
                    'system'
                );

                // Lock the chat — order is complete
                $this->Chat_model->lock_chat($order->chatID);
            }

            $this->session->set_flashdata('success', 'Pickup confirmed! Order completed and payment released to seller.');
            log_message('info', "Buyer {$user_id} confirmed pickup for order {$order_id}");
        } else {
            $this->session->set_flashdata('error', 'Failed to confirm pickup');
        }

        if ($this->input->is_ajax_request()) {
            $this->output->set_content_type('application/json')
                         ->set_output(json_encode([
                             'success' => $result,
                             'message' => $result ? 'Pickup confirmed successfully!' : 'Failed to confirm pickup',
                             'redirect' => base_url('orders')
                         ]));
        } else {
            redirect('orders');
        }
    }

    /**
     * Release funds to seller (called automatically after delivery confirmation)
     * 
     * @param int $order_id
     */
    private function release_funds($order_id)
    {
        // Get order details
        $order = $this->db->select('ep.*, cd.companyID as sellerCompanyID')
                          ->from('equipment_payments ep')
                          ->join('companydetail cd', 'ep.sellerCompanyID = cd.companyID', 'left')
                          ->where('ep.equipmentPaymentID', $order_id)
                          ->get()
                          ->row();
        
        if (!$order || $order->orderStatus !== 'delivered') {
            log_message('error', "Cannot release funds for order {$order_id} - invalid status");
            return false;
        }
        
        // TODO: Implement Stripe transfer to seller's connected account
        // For now, just update the order status to completed
        
        $update_data = [
            'orderStatus' => 'completed',
            'fundsReleasedAt' => date('Y-m-d H:i:s'),
            'completedAt' => date('Y-m-d H:i:s'),
            'updatedAt' => date('Y-m-d H:i:s')
        ];
        
        $this->db->where('equipmentPaymentID', $order_id);
        $result = $this->db->update('equipment_payments', $update_data);
        
        if ($result) {
            log_message('info', "Funds released for order {$order_id} - Order completed");
            // TODO: Add Stripe transfer logic here
            // $this->stripeservice->transfer_to_seller($order->netAmount, $seller_stripe_account);
        }
        
        return $result;
    }
}
