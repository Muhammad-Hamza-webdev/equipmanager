<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Chat Controller
 * 
 * Handles chat view rendering and API endpoints for Node.js integration.
 * All business logic and validation happens here (PHP is source of truth).
 */
class Chat extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Chat_model');
        $this->load->library('Jwt_service');
    }

    /**
     * Display chat view for an order
     * GET /chat/view/{equipmentPaymentID}
     * 
     * @param int $equipmentPaymentID
     */
    public function view($equipmentPaymentID)
    {
        log_message('info', "[Chat::view] User accessing chat for equipmentPaymentID: {$equipmentPaymentID}");
        
        $loginData = $this->session->userdata('loginData');
        
        // Verify session exists
        if (!$loginData || !isset($loginData['userID'])) {
            log_message('error', '[Chat::view] ✗ No valid session found. LoginData: ' . json_encode($loginData));
            show_error('Session expired. Please log in again.', 401);
            return;
        }
        
        $userID = $loginData['userID'];
        log_message('info', "[Chat::view] ✓ Session valid. User ID: {$userID}, Type: {$loginData['userType']}");

        // Get or create chat for this order
        $chat = $this->Chat_model->get_chat_by_order($equipmentPaymentID);

        if (!$chat) {
            log_message('error', "[Chat::view] ✗ Chat not found for equipmentPaymentID {$equipmentPaymentID}");
            show_error('Chat not found for this order', 404);
            return;
        }

        log_message('info', "[Chat::view] ✓ Chat found: ID {$chat->chatID}, Status: {$chat->chatStatus}");

        // Validate user access
        $access = $this->Chat_model->validate_user_access($chat->chatID, $userID);

        if (!$access['has_access']) {
            log_message('error', "[Chat::view] ✗ Access denied for user {$userID} to chat {$chat->chatID}");
            show_error('You do not have permission to access this chat', 403);
            return;
        }

        log_message('info', "[Chat::view] ✓ Access granted. User role: {$access['role']}");

        // Get chat details and messages
        $data['chat'] = $this->Chat_model->get_chat_details($chat->chatID);
        $data['messages'] = $this->Chat_model->get_messages($chat->chatID);
        $data['current_user_id'] = $userID;
        $data['user_role'] = $access['role'];

        log_message('info', '[Chat::view] Loading chat view with SMS messages');

        // Generate JWT for Socket.io authentication
        $data['jwt_token'] = $this->jwt_service->generate_token(
            $userID,
            $data['chat']->chatID,
            $access['role']
        );

        // Load view
        $this->load->view('chats/view_layout', $data);
    }

    /**
     * Display chat view for company admin within admin layout
     * GET /company-chats/view/{equipmentPaymentID}
     * 
     * @param int $equipmentPaymentID
     */
    public function company_view($equipmentPaymentID)
    {
        $loginData = $this->session->userdata('loginData');
        
        // Verify session exists
        if (!$loginData || !isset($loginData['userID'])) {
            log_message('warning', 'Chat access attempt without valid session');
            show_error('Session expired. Please log in again.', 401);
            return;
        }

        // Verify user is company admin or manager
        if ($loginData['userType'] != 2 && $loginData['userType'] != 3) {
            show_error('You do not have permission to access this page', 403);
            return;
        }

        $userID = $loginData['userID'];

        // Get or create chat for this order
        $chat = $this->Chat_model->get_chat_by_order($equipmentPaymentID);

        if (!$chat) {
            show_error('Chat not found for this order', 404);
            return;
        }

        // Validate user access
        $access = $this->Chat_model->validate_user_access($chat->chatID, $userID);

        if (!$access['has_access']) {
            show_error('You do not have permission to access this chat', 403);
            return;
        }

        // Get chat details and messages
        $data['chat'] = $this->Chat_model->get_chat_details($chat->chatID);
        $data['messages'] = $this->Chat_model->get_messages($chat->chatID);
        $data['current_user_id'] = $userID;
        $data['user_role'] = $access['role'];
        $data['user_type'] = $loginData['userType'];

        // Generate JWT for Socket.io authentication
        $data['jwt_token'] = $this->jwt_service->generate_token(
            $userID,
            $data['chat']->chatID,
            $access['role']
        );

        // Load view with admin layout
        $this->load->view('chats/view_admin_layout', $data);
    }

    /**
     * API: Validate chat access for Socket.io
     * POST /chat/api/validate
     * 
     * Request body: { chat_id, user_id }
     * Response: { success: bool, role: string, chat_status: string }
     */
    public function api_validate()
    {
        header('Content-Type: application/json');

        // SECURITY (C3): Verify the request originates from the trusted Node.js server.
        // The shared secret is set via NODE_API_SECRET in phpenv.php and chat-server/.env.
        // hash_equals prevents timing-attack enumeration of the secret.
        $node_secret = getenv('NODE_API_SECRET');
        if (!empty($node_secret)) {
            $provided = isset($_SERVER['HTTP_X_NODE_SECRET']) ? $_SERVER['HTTP_X_NODE_SECRET'] : '';
            if (!hash_equals($node_secret, $provided)) {
                log_message('error', 'Chat api_validate: Unauthorized request — missing or incorrect NODE_API_SECRET header');
                http_response_code(401);
                echo json_encode(['success' => false, 'message' => 'Unauthorized']);
                return;
            }
        }

        // Get JSON input
        $input = json_decode(file_get_contents('php://input'), true);

        if (!isset($input['chat_id']) || !isset($input['user_id'])) {
            echo json_encode([
                'success' => false,
                'message' => 'Missing required fields'
            ]);
            return;
        }

        $chatID = (int)$input['chat_id'];
        $userID = (int)$input['user_id'];

        // Validate access
        $access = $this->Chat_model->validate_user_access($chatID, $userID);

        if (!$access['has_access']) {
            echo json_encode([
                'success' => false,
                'message' => 'Access denied'
            ]);
            return;
        }

        // Get chat status
        $chatStatus = $this->Chat_model->get_chat_status($chatID);

        echo json_encode([
            'success' => true,
            'role' => $access['role'],
            'chat_status' => $chatStatus
        ]);
    }

    /**
     * API: Save message (called by Node.js)
     * POST /chat/api/send
     * 
     * Request body: { chat_id, user_id, message }
     * Response: { success: bool, message_id: int, timestamp: string }
     */
    public function api_send()
    {
        header('Content-Type: application/json');

        // SECURITY (C3): Verify the request originates from the trusted Node.js server.
        $node_secret = getenv('NODE_API_SECRET');
        if (!empty($node_secret)) {
            $provided = isset($_SERVER['HTTP_X_NODE_SECRET']) ? $_SERVER['HTTP_X_NODE_SECRET'] : '';
            if (!hash_equals($node_secret, $provided)) {
                log_message('error', 'Chat api_send: Unauthorized request — missing or incorrect NODE_API_SECRET header');
                http_response_code(401);
                echo json_encode(['success' => false, 'message' => 'Unauthorized']);
                return;
            }
        }

        // Get JSON input
        $input = json_decode(file_get_contents('php://input'), true);

        if (!isset($input['chat_id']) || !isset($input['user_id']) || !isset($input['message'])) {
            echo json_encode([
                'success' => false,
                'message' => 'Missing required fields'
            ]);
            return;
        }

        $chatID = (int)$input['chat_id'];
        $userID = (int)$input['user_id'];
        $messageText = $input['message'];

        // Save message (includes validation)
        $messageID = $this->Chat_model->save_message($chatID, $userID, $messageText);

        if (!$messageID) {
            echo json_encode([
                'success' => false,
                'message' => 'Failed to save message. Chat may be locked or you do not have permission.'
            ]);
            return;
        }

        // Get sender info
        $this->db->select('userName');
        $sender = $this->db->get_where('users', ['userID' => $userID])->row();

        echo json_encode([
            'success' => true,
            'message_id' => $messageID,
            'timestamp' => date('Y-m-d H:i:s'),
            'sender_name' => $sender ? $sender->userName : 'Unknown'
        ]);
    }

    /**
     * API: Lock chat (called when order is completed/cancelled)
     * POST /chat/api/lock
     * 
     * Request body: { equipment_payment_id }
     * Response: { success: bool, chat_id: int }
     */
    public function api_lock()
    {
        header('Content-Type: application/json');

        // Get JSON input
        $input = json_decode(file_get_contents('php://input'), true);

        if (!isset($input['equipment_payment_id'])) {
            echo json_encode([
                'success' => false,
                'message' => 'Missing equipment_payment_id'
            ]);
            return;
        }

        $equipmentPaymentID = (int)$input['equipment_payment_id'];

        // Get chat
        $chat = $this->Chat_model->get_chat_by_order($equipmentPaymentID);

        if (!$chat) {
            echo json_encode([
                'success' => false,
                'message' => 'Chat not found'
            ]);
            return;
        }

        // Lock chat
        $success = $this->Chat_model->lock_chat($chat->chatID);

        if ($success) {
            // Notify Node.js server to emit chat_locked event
            $this->notify_node_chat_locked($chat->chatID);

            echo json_encode([
                'success' => true,
                'chat_id' => $chat->chatID
            ]);
        } else {
            echo json_encode([
                'success' => false,
                'message' => 'Failed to lock chat'
            ]);
        }
    }

    /**
     * Notify Node.js server that chat is locked
     * 
     * @param int $chatID
     */
    private function notify_node_chat_locked($chatID)
    {
        // Get Node.js server URL from config or environment
        $nodeServerUrl = getenv('NODE_SERVER_URL') ?: 'http://localhost:3000';

        // Send async request to Node.js
        $ch = curl_init($nodeServerUrl . '/api/chat-locked');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode(['chat_id' => $chatID]));
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
        curl_setopt($ch, CURLOPT_TIMEOUT, 2); // Don't wait long

        curl_exec($ch);
        curl_close($ch);
    }

    /**
     * Helper: Create chat when payment is successful
     * This should be called from your payment processing code
     * 
     * @param int $equipmentPaymentID
     * @param int $buyerUserID
     * @param int $sellerCompanyID
     * @return int|false chatID on success
     */
    public function create_chat_on_payment($equipmentPaymentID, $buyerUserID, $sellerCompanyID)
    {
        return $this->Chat_model->create_chat($equipmentPaymentID, $buyerUserID, $sellerCompanyID);
    }

    /**
     * Health check endpoint for Socket.IO server to verify connection
     * GET /chat/health
     */
    public function health()
    {
        header('Content-Type: application/json');
        
        $loginData = $this->session->userdata('loginData');
        $userID = isset($loginData['userID']) ? $loginData['userID'] : null;

        echo json_encode([
            'status' => 'ok',
            'timestamp' => date('Y-m-d H:i:s'),
            'user_id' => $userID,
            'php_version' => phpversion(),
            'database' => $this->db->conn_id ? 'connected' : 'disconnected'
        ]);
    }

    /**
     * Debug method to test chat access
     * GET /chat/debug/(:num)
     * Shows detailed info about chat and user access
     */
    public function debug($equipmentPaymentID)
    {
        header('Content-Type: application/json');

        $loginData = $this->session->userdata('loginData');
        
        $response = [
            'timestamp' => date('Y-m-d H:i:s'),
            'equipment_payment_id' => $equipmentPaymentID,
            'session' => [
                'has_session' => !empty($loginData),
                'user_id' => isset($loginData['userID']) ? $loginData['userID'] : null,
                'user_type' => isset($loginData['userType']) ? $loginData['userType'] : null,
            ],
            'chat' => [],
            'access' => null
        ];

        // Get chat by order
        $chat = $this->Chat_model->get_chat_by_order($equipmentPaymentID);
        
        if (!$chat) {
            $response['chat']['found'] = false;
            $response['chat']['error'] = 'Chat not found for this equipment payment';
        } else {
            $response['chat']['found'] = true;
            $response['chat']['id'] = $chat->chatID;
            $response['chat']['buyer_user_id'] = $chat->buyerUserID;
            $response['chat']['seller_company_id'] = $chat->sellerCompanyID;
            $response['chat']['status'] = $chat->chatStatus;

            // Check access if user is logged in
            if ($loginData && isset($loginData['userID'])) {
                $access = $this->Chat_model->validate_user_access($chat->chatID, $loginData['userID']);
                $response['access'] = [
                    'has_access' => $access['has_access'],
                    'role' => $access['role'],
                    'buyer_match' => ($chat->buyerUserID == $loginData['userID']),
                    'is_seller_admin' => false,
                    'is_seller_employee' => false
                ];

                // Check seller company
                $company_owner = $this->db->select('companyID')
                    ->from('companydetail')
                    ->where('userID', $loginData['userID'])
                    ->where('companyID', $chat->sellerCompanyID)
                    ->get()->row();
                
                if ($company_owner) {
                    $response['access']['is_seller_admin'] = true;
                }

                $company_employee = $this->db->select('userID')
                    ->from('usercompanyworkforcelink')
                    ->where('userID', $loginData['userID'])
                    ->where('companyID', $chat->sellerCompanyID)
                    ->get()->row();
                
                if ($company_employee) {
                    $response['access']['is_seller_employee'] = true;
                }
            }
        }

        echo json_encode($response, JSON_PRETTY_PRINT);
    }
}
