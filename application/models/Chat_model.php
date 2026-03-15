<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Chat_model
 * 
 * Handles all database operations for order-based chat system.
 * One chat per order, between buyer and seller only.
 */
class Chat_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    /**
     * Create a new chat for an order
     * Called when payment is successful
     * 
     * @param int $equipmentPaymentID
     * @param int $buyerUserID
     * @param int $sellerCompanyID
     * @return int|false chatID on success, false on failure
     */
    public function create_chat($equipmentPaymentID, $buyerUserID, $sellerCompanyID)
    {
        // Check if chat already exists for this order
        $existing = $this->db->get_where('order_chats', [
            'equipmentPaymentID' => $equipmentPaymentID
        ])->row();

        if ($existing) {
            return $existing->chatID;
        }

        $data = [
            'equipmentPaymentID' => $equipmentPaymentID,
            'buyerUserID' => $buyerUserID,
            'sellerCompanyID' => $sellerCompanyID,
            'chatStatus' => 'open',
            'createdAt' => date('Y-m-d H:i:s')
        ];

        if ($this->db->insert('order_chats', $data)) {
            return $this->db->insert_id();
        }

        return false;
    }

    /**
     * Get chat by order ID
     * 
     * @param int $equipmentPaymentID
     * @return object|null
     */
    public function get_chat_by_order($equipmentPaymentID)
    {
        return $this->db->get_where('order_chats', [
            'equipmentPaymentID' => $equipmentPaymentID
        ])->row();
    }

    /**
     * Get chat by chat ID
     * 
     * @param int $chatID
     * @return object|null
     */
    public function get_chat_by_id($chatID)
    {
        return $this->db->get_where('order_chats', [
            'chatID' => $chatID
        ])->row();
    }

    /**
     * Validate if user has access to this chat
     * User must be either the buyer or belong to the seller company
     * 
     * @param int $chatID
     * @param int $userID
     * @return array ['has_access' => bool, 'role' => 'buyer'|'seller'|null]
     */
    public function validate_user_access($chatID, $userID)
    {
        $chat = $this->get_chat_by_id($chatID);

        if (!$chat) {
            log_message('error', "[Chat_model] validate_user_access: Chat ID {$chatID} not found");
            return ['has_access' => false, 'role' => null];
        }

        log_message('info', "[Chat_model] validate_user_access: Chat ID {$chatID}, User ID {$userID}");
        log_message('info', "[Chat_model] Chat buyerUserID: {$chat->buyerUserID}, sellerCompanyID: {$chat->sellerCompanyID}");

        // Check if user is the buyer
        if ($chat->buyerUserID == $userID) {
            log_message('info', "[Chat_model] ✓ User {$userID} is BUYER");
            return ['has_access' => true, 'role' => 'buyer'];
        }

        log_message('info', "[Chat_model] ✗ User {$userID} is NOT the buyer (buyer is {$chat->buyerUserID})");

        // Check if user belongs to seller company (is company admin/owner)
        $this->db->select('companyID');
        $this->db->from('companydetail');
        $this->db->where('userID', $userID);
        $this->db->where('companyID', $chat->sellerCompanyID);
        $company_owner = $this->db->get()->row();

        if ($company_owner) {
            log_message('info', "[Chat_model] ✓ User {$userID} is company OWNER");
            return ['has_access' => true, 'role' => 'seller'];
        }

        // Check if user is an employee of the seller company
        $this->db->select('userID');
        $this->db->from('usercompanyworkforcelink');
        $this->db->where('userID', $userID);
        $this->db->where('companyID', $chat->sellerCompanyID);
        $company_employee = $this->db->get()->row();

        if ($company_employee) {
            log_message('info', "[Chat_model] ✓ User {$userID} is company EMPLOYEE");
            return ['has_access' => true, 'role' => 'seller'];
        }

        log_message('error', "[Chat_model] ✗ User {$userID} has NO ACCESS to chat {$chatID}");
        return ['has_access' => false, 'role' => null];
    }

    /**
     * Save a new message
     * 
     * @param int $chatID
     * @param int $senderUserID
     * @param string $messageText
     * @return int|false messageID on success, false on failure
     */
    public function save_message($chatID, $senderUserID, $messageText)
    {
        // Validate chat exists and is open
        $chat = $this->get_chat_by_id($chatID);

        if (!$chat || $chat->chatStatus !== 'open') {
            return false;
        }

        // Validate user has access
        $access = $this->validate_user_access($chatID, $senderUserID);
        if (!$access['has_access']) {
            return false;
        }

        // Sanitize and validate message
        $messageText = trim($messageText);
        if (empty($messageText) || strlen($messageText) > 2500) {
            return false;
        }

        $data = [
            'chatID' => $chatID,
            'senderUserID' => $senderUserID,
            'messageText' => $messageText,
            'createdAt' => date('Y-m-d H:i:s')
        ];

        if ($this->db->insert('order_chat_messages', $data)) {
            return $this->db->insert_id();
        }

        return false;
    }

    /**
     * Get all messages for a chat
     * Returns messages in chronological order
     * 
     * @param int $chatID
     * @param int $limit (optional)
     * @return array
     */
    public function get_messages($chatID, $limit = 500)
    {
        $this->db->select('m.*, u.userName as firstName, "" as lastName, u.userEmail as email');
        $this->db->from('order_chat_messages m');
        $this->db->join('users u', 'u.userID = m.senderUserID', 'left');
        $this->db->where('m.chatID', $chatID);
        $this->db->order_by('m.createdAt', 'ASC');
        $this->db->limit($limit);

        return $this->db->get()->result();
    }

    /**
     * Lock a chat (when order is completed/cancelled)
     * 
     * @param int $chatID
     * @return bool
     */
    public function lock_chat($chatID)
    {
        $data = [
            'chatStatus' => 'locked',
            'lockedAt' => date('Y-m-d H:i:s')
        ];

        $this->db->where('chatID', $chatID);
        return $this->db->update('order_chats', $data);
    }

    /**
     * Get chat status
     * 
     * @param int $chatID
     * @return string|null 'open'|'locked'|null
     */
    public function get_chat_status($chatID)
    {
        $chat = $this->get_chat_by_id($chatID);
        return $chat ? $chat->chatStatus : null;
    }

    /**
     * Get chat with full details including buyer and seller info
     * 
     * @param int $chatID
     * @return object|null
     */
    public function get_chat_details($chatID)
    {
        $this->db->select('
            c.chatID,
            c.equipmentPaymentID,
            c.buyerUserID,
            c.sellerCompanyID,
            c.chatStatus,
            c.createdAt,
            c.lockedAt,
            buyer.userName as buyerFirstName,
            "" as buyerLastName,
            buyer.userEmail as buyerEmail,
            company.companyName as sellerCompanyName,
            seller_user.userName as sellerUserName,
            ep.grossAmount,
            ep.orderStatus
        ');
        $this->db->from('order_chats c');
        $this->db->join('users buyer', 'buyer.userID = c.buyerUserID', 'left');
        $this->db->join('companydetail company', 'company.companyID = c.sellerCompanyID', 'left');
        $this->db->join('users seller_user', 'seller_user.userID = company.userID', 'left');
        $this->db->join('equipment_payments ep', 'c.equipmentPaymentID = ep.equipmentPaymentID', 'left');
        $this->db->where('c.chatID', $chatID);

        return $this->db->get()->row();
    }

    /**
     * Send an automated system message in a chat
     * Used for approval/rejection notifications, shipping updates, etc.
     * 
     * @param int $chatID
     * @param string $message
     * @param int $companyID Sender company ID (will resolve to admin userID)
     * @param string $senderType 'system'|'seller'|'buyer' (for logging, not stored)
     * @return int|false messageID on success, false on failure
     */
    public function send_automated_message($chatID, $message, $companyID, $senderType = 'system')
    {
        // Verify chat exists
        $chat = $this->get_chat_by_id($chatID);
        if (!$chat) {
            log_message('error', "Cannot send automated message: Chat {$chatID} not found");
            return false;
        }

        // Get the admin userID for this company
        $admin = $this->db->select('userID')
                         ->from('companydetail')
                         ->where('companyID', $companyID)
                         ->get()
                         ->row();
        
        if (!$admin) {
            log_message('error', "Cannot send automated message: Company {$companyID} admin userID not found");
            return false;
        }

        $data = [
            'chatID' => $chatID,
            'senderUserID' => $admin->userID,
            'messageText' => $message,
            'createdAt' => date('Y-m-d H:i:s')
        ];

        if ($this->db->insert('order_chat_messages', $data)) {
            $messageID = $this->db->insert_id();
            log_message('info', "Automated message sent to chat {$chatID} by user {$admin->userID}: {$message}");
            return $messageID;
        }

        log_message('error', "Failed to send automated message to chat {$chatID}");
        return false;
    }

    /**
     * Send an automated message in a chat directly as a specific user (e.g. buyer side)
     *
     * @param int $chatID
     * @param string $message
     * @param int $userID  The userID to send as (buyer)
     * @return int|false messageID on success, false on failure
     */
    public function send_automated_message_as_user($chatID, $message, $userID)
    {
        $data = [
            'chatID'       => $chatID,
            'senderUserID' => $userID,
            'messageText'  => $message,
            'createdAt'    => date('Y-m-d H:i:s')
        ];

        if ($this->db->insert('order_chat_messages', $data)) {
            $messageID = $this->db->insert_id();
            log_message('info', "Automated buyer message sent to chat {$chatID} by user {$userID}");
            return $messageID;
        }

        log_message('error', "Failed to send automated buyer message to chat {$chatID}");
        return false;
    }
}
