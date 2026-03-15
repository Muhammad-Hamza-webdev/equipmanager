<?php
defined('BASEPATH') or exit('No direct script access allowed');

class MY_Controller extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        
        // Load chat system configuration
        require_once(APPPATH . 'config/chat_config.php');
        
        // List of controllers/methods to exclude from the session check
        $excluded_pages = array(
            'welcome', // Exclude the default Welcome controller (base URL)
            'welcome/index', // Exclude the welcome index when CI routes unknown URIs here via 404_override
            'welcome/LoginData', // Exclude the login page
            'welcome/RegisterView', // Exclude the login page
            'welcome/comapnyRegisterationData', // Exclude the login page
            'welcome/VerifyAccount', // Exclude the login page
            'welcome/TestMail', // Exclude the login page
            'welcome/VerifyAccountData', // Exclude the login page
            'welcome/resendVerificationEmail', // Exclude the login page
            'welcome/forgotpassword', // Exclude the forget pass email page
            'welcome/forgotpasswordData', // Exclude the forget pass OTP page
            'welcome/resetPassword', // Exclude the forget pass reset page
            'welcome/resetPasswordData', // Exclude the forget pass reset data page
            'welcome/login', // Exclude the forget pass reset data page
            'chat/api_validate', // Exclude chat API endpoints (Node.js calls these without session)
            'chat/api_send', // Exclude chat API endpoints (Node.js calls these without session)
            'chat/api_lock', // Exclude chat API endpoints (PHP calls these)
            'chat/health', // Allow Chat health check
            'chat/debug', // Allow Chat debug endpoint
            'chat/view', // Allow Chat view for regular users (session can still expire, but view() checks it)
            'chat/company_view', // Allow Chat view for company admin
            'orders/test_session', // DEBUG: Session test endpoint
        );

        // Get the current controller and method
        $current_controller = $this->router->fetch_class();
        $current_method = $this->router->fetch_method();
        $current_page = $current_controller . '/' . $current_method;
        // Check if the current request is for the base URL
        $is_base_url = ($this->uri->uri_string() === '');
        
        // DEBUG: Log session state for troubleshooting
        $login_data = $this->session->userdata('loginData');
        $session_id = session_id();
        error_log("[MY_CONTROLLER DEBUG] Page: $current_page | SessionID: $session_id | LoginData: " . (isset($login_data) ? 'EXISTS' : 'MISSING'));
        
        //  var_dump($this->session->userdata('loginData')); 
        if (!$is_base_url) {
            // For POST requests to specific endpoints, let the controller method handle auth
            // This prevents session loss on form submissions
            $is_post_request = $this->input->server('REQUEST_METHOD') === 'POST';
            $allow_post_methods = array(
                'orders/confirm_delivery',        // Allow buyer to confirm delivery
                'company_orders/mark_shipped',    // Allow admin to ship order
                'company_orders/approve_order',   // Allow admin to approve
                'company_orders/reject_order'     // Allow admin to reject
            );
            
            $is_allowed_post = $is_post_request && in_array($current_page, $allow_post_methods);
            
            // Check if the user is logged in.
            // Allow any request handled by the `welcome` controller to pass
            // so `404_override` can dispatch unknown slugs (like "about-us") to it.
            // Also allow specific POST methods to handle their own auth checks
            if ($current_controller !== 'welcome' && !in_array($current_page, $excluded_pages) && !$is_allowed_post && !$this->session->userdata('loginData')) {
                error_log("[MY_CONTROLLER REDIRECT] Redirecting to login from $current_page - Session missing!");
                redirect(base_url('login')); // Redirect to the login page or home page
            }
            $this->load->library('email');
            $this->config->load('email'); // Load SMTP settings
        }
    }
    public function send_email($to, $subject, $message)
    {
        $this->email->from('info@nexphi.com', 'Equip Manager');
        $this->email->to($to);
        $this->email->subject($subject);
        $this->email->message($message);

        if ($this->email->send()) {
            return true;
        } else {
            return $this->email->print_debugger(); // For debugging errors
        }
    }
}
