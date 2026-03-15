<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * General User Dashboard
     * Available for all logged-in users
     */
    public function index()
    {
        // Auth check is handled in the view
        $this->load->view('dashboards/user_dashboard');
    }

    /**
     * Orders page
     */
    public function orders()
    {
        // This is a placeholder - implement as needed
        redirect('dashboard');
    }

    /**
     * Chats page
     */
    public function chats()
    {
        // This is a placeholder - implement as needed
        redirect('dashboard');
    }

    /**
     * Settings page
     */
    public function settings()
    {
        // This is a placeholder - implement as needed
        redirect('dashboard');
    }
}
