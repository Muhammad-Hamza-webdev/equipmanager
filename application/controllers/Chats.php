<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Chats Controller
 * 
 * Displays list of chats for logged-in user (buyer or seller)
 */
class Chats extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Chat_model');
        $this->load->database();
    }

    /**
     * Display list of all chats for current user
     * Shows both chats where user is buyer and chats where user is seller
     */
    public function index()
    {
        $loginData = $this->session->userdata('loginData');
        
        // Verify session exists
        if (!$loginData || !isset($loginData['userID'])) {
            log_message('warning', 'Chats list access attempt without valid session');
            show_error('Session expired. Please log in again.', 401);
            return;
        }
        
        $userID = $loginData['userID'];

        // Get companyID - check companyDetails first, then loginData
        $companyID = null;
        if ($this->session->userdata('companyDetails')) {
            $companyDetails = $this->session->userdata('companyDetails');
            $companyID = $companyDetails['companyID'];
        } elseif (isset($loginData['companyID'])) {
            $companyID = $loginData['companyID'];
        }

        // Get all chats where user is buyer
        $this->db->select('
            c.*,
            ep.grossAmount,
            ep.paymentStatus,
            ep.createdAt as orderDate,
            company.companyName as sellerCompanyName,
            seller_user.userName as sellerUserName,
            (SELECT COUNT(*) FROM order_chat_messages WHERE chatID = c.chatID) as messageCount,
            (SELECT MAX(createdAt) FROM order_chat_messages WHERE chatID = c.chatID) as lastMessageAt
        ');
        $this->db->from('order_chats c');
        $this->db->join('equipment_payments ep', 'c.equipmentPaymentID = ep.equipmentPaymentID');
        $this->db->join('companydetail company', 'c.sellerCompanyID = company.companyID', 'left');
        $this->db->join('users seller_user', 'seller_user.userID = company.userID', 'left');
        $this->db->where('c.buyerUserID', $userID);
        $buyer_chats = $this->db->get()->result();

        // Get all chats where user's company is seller
        $seller_chats = [];
        if ($companyID) {
            $this->db->select('
                c.*,
                ep.grossAmount,
                ep.paymentStatus,
                ep.createdAt as orderDate,
                buyer.userName as buyerFirstName,
                "" as buyerLastName,
                buyer.userEmail as buyerEmail,
                company.companyName as sellerCompanyName,
                (SELECT COUNT(*) FROM order_chat_messages WHERE chatID = c.chatID) as messageCount,
                (SELECT MAX(createdAt) FROM order_chat_messages WHERE chatID = c.chatID) as lastMessageAt
            ');
            $this->db->from('order_chats c');
            $this->db->join('equipment_payments ep', 'c.equipmentPaymentID = ep.equipmentPaymentID');
            $this->db->join('users buyer', 'c.buyerUserID = buyer.userID', 'left');
            $this->db->join('companydetail company', 'c.sellerCompanyID = company.companyID', 'left');
            $this->db->where('c.sellerCompanyID', $companyID);
            $seller_chats = $this->db->get()->result();
        }

        // Combine and sort by last message time
        $all_chats = array_merge($buyer_chats, $seller_chats);

        // Remove duplicate chats (same chatID) - keep the first occurrence
        $seen_chats = [];
        $unique_chats = [];
        foreach ($all_chats as $chat) {
            if (!isset($seen_chats[$chat->chatID])) {
                $seen_chats[$chat->chatID] = true;
                $unique_chats[] = $chat;
            }
        }
        $all_chats = $unique_chats;

        // Sort by last message time (most recent first)
        usort($all_chats, function ($a, $b) {
            $timeA = $a->lastMessageAt ?: $a->createdAt;
            $timeB = $b->lastMessageAt ?: $b->createdAt;
            return strtotime($timeB) - strtotime($timeA);
        });

        $userType = $loginData['userType'];

        $data = [
            'chats' => $all_chats,
            'user_id' => $userID,
            'company_id' => $companyID,
            'user_type' => $userType
        ];

        // Determine which layout to use based on user type

        // Store data for views
        $this->data = $data;

        if ($userType == 2 || $userType == 3) {
            // Company admin or manager - use admin layout
            $this->load->view('chats/list_layout', $data);
        } else {
            // Regular user - use website layout
            $this->load->view('chats/list_website_layout', $data);
        }
    }
}
