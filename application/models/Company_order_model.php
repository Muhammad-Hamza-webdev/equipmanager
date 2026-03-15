<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Company_order_model
 * 
 * Handles database operations for company order management
 */
class Company_order_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    /**
     * Get all orders for a company with optional status filter
     * 
     * @param int $company_id
     * @param string $status_filter 'pending'|'approved'|'rejected'|null
     * @return array
     */
    public function get_company_orders($company_id, $status_filter = null)
    {
        $query = $this->db->select([
            'ep.equipmentPaymentID',
            'ep.grossAmount',
            'ep.quantity',
            'ep.orderStatus',
            'ep.paymentStatus',
            'ep.createdAt',
            'ep.stripePaymentIntentID',
            'ep.paymentMetadata',
            'e.equipName',
            'e.equipmentID',
            'u.userName as buyerName',
            'u.userEmail as buyerEmail',
            'u.userPhone as buyerPhone'
        ])
        ->from('equipment_payments ep')
        ->join('equipment e', 'ep.equipmentID = e.equipmentID', 'left')
        ->join('users u', 'ep.buyerUserID = u.userID', 'left')
        ->where('ep.sellerCompanyID', $company_id)
        ->order_by('ep.createdAt', 'DESC');
        
        if ($status_filter) {
            $query->where('ep.orderStatus', $status_filter);
        }
        
        return $query->get()->result();
    }

    /**
     * Get detailed order information
     * Verify order belongs to specified company
     * 
     * @param int $order_id
     * @param int $company_id
     * @return object|null
     */
    public function get_order_detail($order_id, $company_id)
    {
        return $this->db->select([
            'ep.*',
            'e.equipName as equipmentName',
            'e.equipDesc',
            'e.equipImg as equipImage',
            'e.equipTotalQuantity',
            'e.equipmentID',
            'u.userName as buyerName',
            'u.userEmail as buyerEmail',
            'u.userPhone as buyerPhone',
            'u.userID as buyerUserID',
            'cd.companyName as sellerCompanyName',
            'si.itemID',
            'oc.chatID',
            'approver.userName as approvedByName'
        ])
        ->from('equipment_payments ep')
        ->join('equipment e', 'ep.equipmentID = e.equipmentID', 'left')
        ->join('users u', 'ep.buyerUserID = u.userID', 'left')
        ->join('companydetail cd', 'ep.sellerCompanyID = cd.companyID', 'left')
        ->join('shopitem si', 'ep.itemID = si.itemID', 'left')
        ->join('order_chats oc', 'ep.equipmentPaymentID = oc.equipmentPaymentID', 'left')
        ->join('users approver', 'ep.approvedBy = approver.userID', 'left')
        ->where('ep.equipmentPaymentID', $order_id)
        ->where('ep.sellerCompanyID', $company_id)
        ->get()
        ->row();
    }

    /**
     * Approve an order and generate checkout token
     * 
     * @param int $order_id
     * @param int $admin_user_id
     * @param string $checkout_token
     * @param string $token_expiry
     * @return bool
     */
    public function approve_order($order_id, $admin_user_id, $checkout_token, $token_expiry)
    {
        $update_data = [
            'orderStatus' => 'payment_pending',
            'approvedBy' => $admin_user_id,
            'approvedAt' => date('Y-m-d H:i:s'),
            'checkoutToken' => $checkout_token,
            'checkoutTokenExpiry' => $token_expiry,
            'updatedAt' => date('Y-m-d H:i:s')
        ];
        
        $this->db->where('equipmentPaymentID', $order_id);
        $result = $this->db->update('equipment_payments', $update_data);
        
        if ($result) {
            log_message('info', "Order {$order_id} approved by admin {$admin_user_id}");
        }
        
        return $result;
    }

    /**
     * Reject an order with reason
     * 
     * @param int $order_id
     * @param int $admin_user_id
     * @param string $reason
     * @return bool
     */
    public function reject_order($order_id, $admin_user_id, $reason = null)
    {
        $update_data = [
            'orderStatus' => 'rejected',
            'approvedBy' => $admin_user_id,
            'approvedAt' => date('Y-m-d H:i:s'),
            'rejectionReason' => $reason,
            'updatedAt' => date('Y-m-d H:i:s')
        ];
        
        $this->db->where('equipmentPaymentID', $order_id);
        $result = $this->db->update('equipment_payments', $update_data);
        
        if ($result) {
            log_message('info', "Order {$order_id} rejected by admin {$admin_user_id}");
        }
        
        return $result;
    }

    /**
     * Mark order as shipped
     * 
     * @param int $order_id
     * @param int $admin_user_id
     * @param string $tracking_number
     * @param string $shipping_notes
     * @return bool
     */
    public function mark_as_shipped($order_id, $admin_user_id, $tracking_number = null, $shipping_notes = null)
    {
        $update_data = [
            'orderStatus' => 'shipped',
            'shippedBy' => $admin_user_id,
            'shippedAt' => date('Y-m-d H:i:s'),
            'updatedAt' => date('Y-m-d H:i:s')
        ];
        
        if ($tracking_number) {
            $update_data['trackingNumber'] = $tracking_number;
        }
        
        if ($shipping_notes) {
            $update_data['shippingNotes'] = $shipping_notes;
        }
        
        $this->db->where('equipmentPaymentID', $order_id);
        $result = $this->db->update('equipment_payments', $update_data);
        
        if ($result) {
            log_message('info', "Order {$order_id} marked as shipped by admin {$admin_user_id}");
        }
        
        return $result;
    }

    /**
     * Update approval status of an order (DEPRECATED - use approve_order or reject_order)
     * 
     * @param int $order_id
     * @param string $status 'approved'|'rejected'
     * @param int $admin_user_id
     * @param string $notes
     * @return bool
     */
    public function update_approval_status($order_id, $status, $admin_user_id, $notes = null)
    {
        $update_data = [
            'orderStatus' => $status,
            'approvedBy' => $admin_user_id,
            'approvedAt' => date('Y-m-d H:i:s'),
            'updatedAt' => date('Y-m-d H:i:s')
        ];
        
        if ($notes) {
            $update_data['rejectionReason'] = $notes;
        }
        
        $this->db->where('equipmentPaymentID', $order_id);
        $result = $this->db->update('equipment_payments', $update_data);
        
        if ($result) {
            log_message('info', "Order {$order_id} order status updated to {$status} by admin {$admin_user_id}");
        }
        
        return $result;
    }

    /**
     * Mark order as ready for pickup (pickup orders only)
     * 
     * @param int $order_id
     * @param int $admin_user_id
     * @return bool
     */
    public function mark_as_pickup_ready($order_id, $admin_user_id)
    {
        $update_data = [
            'orderStatus' => 'pickup_ready',
            'shippedBy'   => $admin_user_id,
            'shippedAt'   => date('Y-m-d H:i:s'),
            'updatedAt'   => date('Y-m-d H:i:s')
        ];

        $this->db->where('equipmentPaymentID', $order_id);
        $result = $this->db->update('equipment_payments', $update_data);

        if ($result) {
            log_message('info', "Order {$order_id} marked as pickup_ready by admin {$admin_user_id}");
        }

        return $result;
    }

    /**
     * Get order count by status for company
     * 
     * @param int $company_id
     * @return object
     */
    public function get_order_counts($company_id)
    {
        $result = $this->db->select([
            'COUNT(*) as total',
            'SUM(CASE WHEN orderStatus = "requested" THEN 1 ELSE 0 END) as requested',
            'SUM(CASE WHEN orderStatus = "payment_pending" THEN 1 ELSE 0 END) as payment_pending',
            'SUM(CASE WHEN orderStatus = "payment_secured" THEN 1 ELSE 0 END) as payment_secured',
            'SUM(CASE WHEN orderStatus = "shipped" THEN 1 ELSE 0 END) as shipped',
            'SUM(CASE WHEN orderStatus = "rejected" THEN 1 ELSE 0 END) as rejected'
        ])
        ->from('equipment_payments')
        ->where('sellerCompanyID', $company_id)
        ->get()
        ->row();
        
        return $result;
    }
}
