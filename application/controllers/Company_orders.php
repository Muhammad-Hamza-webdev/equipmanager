<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Company_orders Controller
 * 
 * Handles order management for company admins
 * Allows review and approval/rejection of purchase requests
 */
class Company_orders extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        
        $this->load->database();
        $this->load->model('Company_order_model');
        $this->load->model('Chat_model');
        
        // Ensure only company admins can access
        $login_data = $this->session->userdata('loginData');
        if (!$login_data || $login_data['userType'] != 2) {
            show_error('Access denied. Company admin access required.', 403);
        }
    }

    /**
     * Display all purchase requests for company's equipment
     */
    public function index()
    {
        $login_data = $this->session->userdata('loginData');
        $user_id = $login_data['userID'];
        
        // Get company ID for logged-in admin
        $company = $this->db->select('companyID')
                            ->from('companydetail')
                            ->where('userID', $user_id)
                            ->get()
                            ->row();
        
        if (!$company) {
            show_error('Company not found', 404);
            return;
        }
        
        $company_id = $company->companyID;
        
        // Get filter from query string
        $filter = $this->input->get('status', TRUE);
        
        // Get all orders for this company
        $data['orders'] = $this->Company_order_model->get_company_orders($company_id, $filter);
        $data['filter'] = $filter;
        $data['company_id'] = $company_id;
        
        // Load view
        $this->load->view('company/orders_list', $data);
    }

    /**
     * View detailed order information
     */
    public function view($order_id)
    {
        $login_data = $this->session->userdata('loginData');
        $user_id = $login_data['userID'];
        
        // Get company ID
        $company = $this->db->select('companyID')
                            ->from('companydetail')
                            ->where('userID', $user_id)
                            ->get()
                            ->row();
        
        if (!$company) {
            show_error('Company not found', 404);
            return;
        }
        
        // Get order details - verify it belongs to this company
        $order = $this->Company_order_model->get_order_detail($order_id, $company->companyID);
        
        if (!$order) {
            show_error('Order not found or access denied', 404);
            return;
        }
        
        // Convert object to array for easier access in view
        $data['order'] = (array) $order;

        // Build images array — try shopequipments first, fallback to equipment main image
        $images = [];
        if (!empty($order->itemID)) {
            $shop_eq = $this->db->select([
                'eqpimg1','eqpimg2','eqpimg3','eqpimg4','eqpimg5',
                'eqpimg6','eqpimg7','eqpimg8','eqpimg9','eqpimg10'
            ])->from('shopequipments')->where('itemID', $order->itemID)->limit(1)->get()->row();
            if ($shop_eq) {
                for ($i = 1; $i <= 10; $i++) {
                    $f = 'eqpimg' . $i;
                    if (!empty($shop_eq->$f)) $images[] = 'assets/website/images/' . $shop_eq->$f;
                }
            }
        }
        if (empty($images) && !empty($order->equipmentID)) {
            $shop_eq = $this->db->select([
                'eqpimg1','eqpimg2','eqpimg3','eqpimg4','eqpimg5',
                'eqpimg6','eqpimg7','eqpimg8','eqpimg9','eqpimg10'
            ])->from('shopequipments')->where('equipmentID', $order->equipmentID)->limit(1)->get()->row();
            if ($shop_eq) {
                for ($i = 1; $i <= 10; $i++) {
                    $f = 'eqpimg' . $i;
                    if (!empty($shop_eq->$f)) $images[] = 'assets/website/images/' . $shop_eq->$f;
                }
            }
        }
        if (empty($images) && !empty($order->equipImage)) {
            $images[] = 'assets/website/images/' . $order->equipImage;
        }
        $data['images'] = $images;

        // Load view
        $this->load->view('company/order_detail', $data);
    }

    /**
     * Accept a purchase request
     * POST only, CSRF protected
     */
    public function accept()
    {
        // Verify POST method
        if ($this->input->server('REQUEST_METHOD') !== 'POST') {
            show_error('Invalid request method', 405);
            return;
        }
        
        $login_data = $this->session->userdata('loginData');
        $user_id = $login_data['userID'];
        
        // Get company ID
        $company = $this->db->select('companyID')
                            ->from('companydetail')
                            ->where('userID', $user_id)
                            ->get()
                            ->row();
        
        if (!$company) {
            $this->session->set_flashdata('error', 'Company not found');
            redirect('company-orders');
            return;
        }
        
        $order_id = $this->input->post('order_id', TRUE);
        $order_id = intval($order_id);
        
        if (!$order_id) {
            $this->session->set_flashdata('error', 'Invalid order ID');
            redirect('company-orders');
            return;
        }
        
        // Verify order belongs to this company and is in requested status
        $order = $this->Company_order_model->get_order_detail($order_id, $company->companyID);
        
        if (!$order) {
            $this->session->set_flashdata('error', 'Order not found or access denied');
            redirect('company-orders');
            return;
        }
        
        if ($order->orderStatus !== 'requested') {
            $this->session->set_flashdata('error', 'Order cannot be modified - already processed');
            redirect('company-orders');
            return;
        }
        
        // Generate unique checkout token
        $checkout_token = bin2hex(random_bytes(32)); // 64-character token
        $token_expiry = date('Y-m-d H:i:s', strtotime('+7 days'));
        
        // Update order status to payment_pending with checkout token
        $result = $this->Company_order_model->approve_order(
            $order_id, 
            $user_id,
            $checkout_token,
            $token_expiry
        );
        
        if ($result) {
            // Send automated chat message with checkout link
            $checkout_url = site_url('checkout/pay/' . $checkout_token);
            $message = "Your purchase request has been approved!\n\n"
                     . "You can now complete your payment using this secure link:\n"
                     . $checkout_url . "\n\n"
                     . "This link will expire in 7 days.\n\n"
                     . "If you have any questions, feel free to message us!";
            
            // Send message via Chat model
            $this->Chat_model->send_automated_message(
                $order->chatID,
                $message,
                $company->companyID,
                'system'
            );
            
            $this->session->set_flashdata('success', 'Purchase request approved successfully. Checkout link sent to buyer.');
            log_message('info', "Company admin {$user_id} approved order {$order_id} - Checkout token: {$checkout_token}");
        } else {
            $this->session->set_flashdata('error', 'Failed to update order status');
        }
        
        redirect('company-orders');
    }

    /**
     * Reject a purchase request
     * POST only, CSRF protected
     */
    public function reject()
    {
        // Verify POST method
        if ($this->input->server('REQUEST_METHOD') !== 'POST') {
            show_error('Invalid request method', 405);
            return;
        }
        
        $login_data = $this->session->userdata('loginData');
        $user_id = $login_data['userID'];
        
        // Get company ID
        $company = $this->db->select('companyID')
                            ->from('companydetail')
                            ->where('userID', $user_id)
                            ->get()
                            ->row();
        
        if (!$company) {
            $this->session->set_flashdata('error', 'Company not found');
            redirect('company-orders');
            return;
        }
        
        $order_id = $this->input->post('order_id', TRUE);
        $rejection_reason = $this->input->post('rejection_reason', TRUE);
        $order_id = intval($order_id);
        
        if (!$order_id) {
            $this->session->set_flashdata('error', 'Invalid order ID');
            redirect('company-orders');
            return;
        }
        
        // Verify order belongs to this company and is in pending status
        $order = $this->Company_order_model->get_order_detail($order_id, $company->companyID);
        
        if (!$order) {
            $this->session->set_flashdata('error', 'Order not found or access denied');
            redirect('company-orders');
            return;
        }
        
        if ($order->orderStatus !== 'requested') {
            $this->session->set_flashdata('error', 'Order cannot be modified - already processed');
            redirect('company-orders');
            return;
        }
        
        // Reject the order
        $result = $this->Company_order_model->reject_order($order_id, $user_id, $rejection_reason);
        
        if ($result) {
            // Send automated chat message
            $message = "❌ Your purchase request has been declined.\n\n";
            if ($rejection_reason) {
                $message .= "Reason: " . $rejection_reason . "\n\n";
            }
            $message .= "If you have any questions or would like to discuss alternatives, feel free to message us here.";
            
            $this->Chat_model->send_automated_message(
                $order->chatID,
                $message,
                $company->companyID,
                'system'
            );
            
            $this->session->set_flashdata('success', 'Purchase request rejected. Buyer has been notified.');
            log_message('info', "Company admin {$user_id} rejected order {$order_id}");
        } else {
            $this->session->set_flashdata('error', 'Failed to update order status');
        }
        
        redirect('company-orders');
    }

    /**
     * Mark order as shipped
     * POST only, CSRF protected
     */
    public function mark_shipped()
    {
        // Verify POST method
        if ($this->input->server('REQUEST_METHOD') !== 'POST') {
            show_error('Invalid request method', 405);
            return;
        }
        
        // ===== SECURITY CHECK: USER MUST BE LOGGED IN =====
        $login_data = $this->session->userdata('loginData');
        if (!$login_data || !isset($login_data['userID'])) {
            $this->session->set_flashdata('error', 'Please log in to continue');
            redirect('login');
            return;
        }
        
        $user_id = $login_data['userID'];
        
        // Get company ID
        $company = $this->db->select('companyID')
                            ->from('companydetail')
                            ->where('userID', $user_id)
                            ->get()
                            ->row();
        
        if (!$company) {
            $this->session->set_flashdata('error', 'Company not found');
            redirect('company-orders');
            return;
        }
        
        $order_id = $this->input->post('order_id', TRUE);
        $tracking_number = $this->input->post('tracking_number', TRUE);
        $shipping_notes = $this->input->post('shipping_notes', TRUE);
        $order_id = intval($order_id);
        
        if (!$order_id) {
            $this->session->set_flashdata('error', 'Invalid order ID');
            redirect('company-orders');
            return;
        }
        
        // Verify order belongs to this company and is in payment_secured status
        $order = $this->Company_order_model->get_order_detail($order_id, $company->companyID);
        
        if (!$order) {
            $this->session->set_flashdata('error', 'Order not found or access denied');
            redirect('company-orders');
            return;
        }
        
        if ($order->orderStatus !== 'payment_secured') {
            $this->session->set_flashdata('error', 'Order cannot be shipped - payment not secured yet. Current status: ' . $order->orderStatus);
            redirect('company-orders');
            return;
        }

        // Guard: only delivery orders can be marked as shipped
        $meta = json_decode($order->paymentMetadata ?? '{}', true);
        if (intval($meta['delivery_method'] ?? 0) === 1) {
            // This is a pickup order — use allow_pickup instead
            $this->session->set_flashdata('error', 'This is a pickup order. Use "Allow Pickup" instead of shipping.');
            redirect('company-orders/view/' . $order_id);
            return;
        }
        
        // Update order status to in_progress
        $result = $this->Company_order_model->mark_as_shipped(
            $order_id,
            $user_id,
            $tracking_number,
            $shipping_notes
        );
        
        if ($result) {
            // Ensure Chat_model is loaded
            $this->load->model('Chat_model');
            
            // Send automated chat message to buyer
            $message = "Your order has been shipped!\n\n"
                     . "Order #" . $order_id . "\n";
            
            if ($tracking_number) {
                $message .= "Tracking Number: " . $tracking_number . "\n";
            }
            
            if ($shipping_notes) {
                $message .= "\nShipping Notes:\n" . $shipping_notes . "\n";
            }
            
            $message .= "\nOnce you receive your order, please confirm delivery in your orders dashboard to mark the order as completed.";
            
            // Send message via chat
            if (isset($order->chatID) && $order->chatID) {
                $this->Chat_model->send_automated_message(
                    $order->chatID,
                    $message,
                    $company->companyID,
                    'system'
                );
            }
            
            $this->session->set_flashdata('success', 'Order marked as shipped successfully. Buyer has been notified.');
            log_message('info', "Company admin {$user_id} marked order {$order_id} as shipped with status in_progress");
        } else {
            $this->session->set_flashdata('error', 'Failed to update order status');
            log_message('error', "Failed to mark order {$order_id} as shipped for company {$company->companyID}");
        }
        
        redirect('company-orders');
    }

    /**
     * Allow pickup for a pickup order (payment_secured → pickup_ready)
     * POST only, CSRF protected
     */
    public function allow_pickup()
    {
        if ($this->input->server('REQUEST_METHOD') !== 'POST') {
            show_error('Invalid request method', 405);
            return;
        }

        $login_data = $this->session->userdata('loginData');
        if (!$login_data || !isset($login_data['userID'])) {
            $this->session->set_flashdata('error', 'Please log in to continue');
            redirect('login');
            return;
        }

        $user_id = $login_data['userID'];

        $company = $this->db->select('companyID')
                            ->from('companydetail')
                            ->where('userID', $user_id)
                            ->get()
                            ->row();

        if (!$company) {
            $this->session->set_flashdata('error', 'Company not found');
            redirect('company-orders');
            return;
        }

        $order_id = intval($this->input->post('order_id', TRUE));

        if (!$order_id) {
            $this->session->set_flashdata('error', 'Invalid order ID');
            redirect('company-orders');
            return;
        }

        $order = $this->Company_order_model->get_order_detail($order_id, $company->companyID);

        if (!$order) {
            $this->session->set_flashdata('error', 'Order not found or access denied');
            redirect('company-orders');
            return;
        }

        if ($order->orderStatus !== 'payment_secured') {
            $this->session->set_flashdata('error', 'Order cannot be processed — payment not secured yet. Current status: ' . $order->orderStatus);
            redirect('company-orders');
            return;
        }

        // Confirm this is actually a pickup order
        $meta = json_decode($order->paymentMetadata ?? '{}', true);
        if (($meta['delivery_method'] ?? 0) != 1) {
            $this->session->set_flashdata('error', 'This action is only available for pickup orders.');
            redirect('company-orders/view/' . $order_id);
            return;
        }

        $result = $this->Company_order_model->mark_as_pickup_ready($order_id, $user_id);

        if ($result) {
            $this->load->model('Chat_model');

            $message = "Your order is ready for pickup!\n\n"
                     . "Order #" . $order_id . "\n"
                     . "Please visit us at our location to collect your item.\n\n"
                     . "Once you have picked up the order, please confirm pickup in your orders dashboard to complete the transaction.";

            if (isset($order->chatID) && $order->chatID) {
                $this->Chat_model->send_automated_message(
                    $order->chatID,
                    $message,
                    $company->companyID,
                    'system'
                );
            }

            $this->session->set_flashdata('success', 'Pickup approved. Buyer has been notified to collect the order.');
            log_message('info', "Company admin {$user_id} allowed pickup for order {$order_id}");
        } else {
            $this->session->set_flashdata('error', 'Failed to update order status');
        }

        redirect('company-orders');
    }
}
