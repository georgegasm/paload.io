<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
    function __construct()
    {
        parent::__construct();
        $this->load->Model('user');
    }

    public function index()
    {
        $user = $context->session->userdata('user');
        validateActiveSession($user);
        $this->load->view('dashboard_view',$user);
    }
}