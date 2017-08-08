<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
    function __construct()
    {
        parent::__construct();
        $this->load->Model('user');
        $this->session->sess_destroy();
    }

    public function index()
    {
        $this->load->view('login_view');
    }

    public function validateLogin()
    {
        $username = $this->input->post('username');
        $password = $this->input->post('password');

        echo (!$this->user->login($username, $password))?"0":"1";
    }
}