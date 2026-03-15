<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Order_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    /**
     * Get all orders for a specific user
     */
    public function get_user_orders($user_id, $limit = null, $offset = null)
    {
        $this->db->select([
            'ep.equipmentPaymentID',
            'ep.grossAmount',
            'ep.paymentStatus',
            'ep.createdAt',
            'ep.quantity',
            'ep.saleType',
            'e.equipName',
            'ec.catName'
        ])
        ->from('equipment_payments ep')
        ->join('equipment e', 'ep.equipmentID = e.equipmentID', 'left')
        ->join('equipcat ec', 'e.equipCatID = ec.equipCatID', 'left')
        ->where('ep.buyerUserID', $user_id)
        ->order_by('ep.createdAt', 'DESC');

        if ($limit !== null) {
            $this->db->limit($limit, $offset ?? 0);
        }

        return $this->db->get()->result();
    }

    /**
     * Get total orders count for a user
     */
    public function count_user_orders($user_id)
    {
        return $this->db->select('COUNT(*) as total')
                       ->from('equipment_payments')
                       ->where('buyerUserID', $user_id)
                       ->get()
                       ->row()
                       ->total;
    }

    /**
     * Get a single order by ID
     */
    public function get_order_by_id($order_id, $user_id)
    {
        return $this->db->select([
            'ep.equipmentPaymentID',
            'ep.grossAmount',
            'ep.commissionAmount',
            'ep.netAmount',
            'ep.paymentStatus',
            'ep.createdAt',
            'ep.updatedAt',
            'ep.quantity',
            'ep.saleType',
            'ep.rentalStartDate',
            'ep.rentalEndDate',
            'e.equipName',
            'e.equipDesc',
            'e.equipImg',
            'ec.catName',
            'cd.companyName'
        ])
        ->from('equipment_payments ep')
        ->join('equipment e', 'ep.equipmentID = e.equipmentID', 'left')
        ->join('equipcat ec', 'e.equipCatID = ec.equipCatID', 'left')
        ->join('companydetail cd', 'ep.sellerCompanyID = cd.companyID', 'left')
        ->where('ep.equipmentPaymentID', $order_id)
        ->where('ep.buyerUserID', $user_id)
        ->get()
        ->row();
    }

    /**
     * Get orders with search filter
     */
    public function search_orders($user_id, $search_term, $limit = 10, $offset = 0)
    {
        $this->db->select([
            'ep.equipmentPaymentID',
            'ep.grossAmount',
            'ep.paymentStatus',
            'ep.createdAt',
            'e.equipName',
            'ec.catName'
        ])
        ->from('equipment_payments ep')
        ->join('equipment e', 'ep.equipmentID = e.equipmentID', 'left')
        ->join('equipcat ec', 'e.equipCatID = ec.equipCatID', 'left')
        ->where('ep.buyerUserID', $user_id)
        ->group_start()
            ->like('e.equipName', $search_term)
            ->or_like('ec.catName', $search_term)
            ->or_like('ep.equipmentPaymentID', $search_term)
        ->group_end()
        ->order_by('ep.createdAt', 'DESC')
        ->limit($limit, $offset);

        return $this->db->get()->result();
    }

    /**
     * Get order statistics by status
     */
    public function get_order_statistics($user_id)
    {
        $result = $this->db->select('paymentStatus, COUNT(*) as count')
                          ->from('equipment_payments')
                          ->where('buyerUserID', $user_id)
                          ->group_by('paymentStatus')
                          ->get()
                          ->result_array();

        $stats = [
            'paid' => 0,
            'pending' => 0,
            'failed' => 0,
            'refunded' => 0
        ];

        foreach ($result as $row) {
            $stats[$row['paymentStatus']] = $row['count'];
        }

        return $stats;
    }

    /**
     * Get recent orders (for dashboard widget)
     */
    public function get_recent_orders($user_id, $limit = 5)
    {
        return $this->get_user_orders($user_id, $limit, 0);
    }

    /**
     * Get total spent by user
     */
    public function get_total_spent($user_id)
    {
        $result = $this->db->select('SUM(grossAmount) as total')
                          ->from('equipment_payments')
                          ->where('buyerUserID', $user_id)
                          ->where('paymentStatus', 'paid')
                          ->get()
                          ->row();

        return $result->total ?? 0;
    }
}
