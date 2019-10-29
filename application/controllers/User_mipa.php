<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User_mipa extends CI_Controller
{

    public function index()
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['title'] = "Siswa " . $data['user']['name'];
        $this->load->view('templates/header_dashboard', $data);
        $this->load->view('templates/sidebar_dashboard', $data);
        $this->load->view('user/index', $data);
        $this->load->view('templates/footer_dashboard');
    }
}
