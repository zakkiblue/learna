<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User_mipa extends CI_Controller
{

    public function index()
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        echo "Welcome " . $data['user']['name'];
    }
}
