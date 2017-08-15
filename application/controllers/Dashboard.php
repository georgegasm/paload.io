<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
    function __construct()
    {
        parent::__construct();
        $this->load->Model('user');
        $this->load->Model('loadorder');
        $this->load->Model('payment');
    }

    public function index()
    {
        $user = $this->session->userdata('user');
        validateActiveSession($user);
        $this->load->view('dashboard_view',$user);
    }

    public function createLoadOrder()
    {
        $user            = $this->session->userdata('user');
        validateActiveSession($user);
        
        $randomizer      = new RandomLib\Factory;
        $generator       = $randomizer->getGenerator(new SecurityLib\Strength(SecurityLib\Strength::LOW));
        
        $userID          = $user['id'];
        $referenceNumber = $generator->generateString(10, $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ');
        $mobileNumber    = $this->input->post('mobileNumber');
        $amountRequest   = $this->input->post('amountRequest');
        
        $this->loadorder->createLoadOrder($userID,$referenceNumber,$mobileNumber,$amountRequest);
    }

    public function cancelLoadOrder()
    {
        $user         = $this->session->userdata('user');
        validateActiveSession($user);
        $loadOrderID = $this->input->post('loadOrderID');

        $this->loadorder->cancelLoadOrder($loadOrderID);
    }

    public function fetchLoadOrderList()
    {
        $user = $this->session->userdata('user');
        validateActiveSession($user);

        $userID = $user['id'];
        $loadOrderList = $this->loadorder->fetchLoadOrderList($userID);

        header('Content-Type: application/json');
        echo json_encode($loadOrderList);
    }

    public function checkWalletBalance()
    {
        $user = $this->session->userdata('user');
        validateActiveSession($user);

        $userID = $user['id'];
        $this->payment->checkWalletBalance($userID);
    }
}