<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{

    public function index()
    {
        $this->load->view('Auth/login');
    }
    public function signup()
    {
        $this->load->view('Auth/signup');
    }
}
