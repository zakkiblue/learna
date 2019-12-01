<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User_mipa extends CI_Controller
{
    private $user_data = null;
    public function __construct()
    {
        parent::__construct();
        $this->user_data = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        if ($this->user_data['role_id'] != 2 || $this->user_data['role_id'] != 3) {
            $this->session->set_flashdata('massage', '<div class="alerts failed" role="alert">Anda tidak memiliki akses!!</div>');
            redirect('Auth');
        }
    }

    public function index()
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['title'] = "Siswa " . $data['user']['name'];
        $this->load->view('templates/header_dashboard', $data);
        $this->load->view('templates/sidebar_dashboard', $data);
        $this->load->view('user/index', $data);
        $this->load->view('templates/footer_dashboard');
    }
    public function materi()
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $role_user = $data['user']['role_id'];
        $data['title'] = "Materi";
        $this->db->select('*');
        $this->db->from('mapel');
        $this->db->join('role_mapel', 'role_mapel.mapel_id=mapel.id');
        $this->db->where('role_id', $role_user);
        $data['mapels'] = $this->db->get()->result_array();

        $this->load->view('templates/header_dashboard', $data);
        $this->load->view('templates/sidebar_dashboard', $data);
        $this->load->view('user/materi', $data);
        $this->load->view('templates/footer_dashboard');
    }
    public function materi_list()
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $id_mapel = $this->input->get('mapel');
        $data['materis'] = $this->db->get_where('materi', ['id_mapel' => $id_mapel])->result_array();
        $data['title'] = "Siswa " . $data['user']['name'];
        $this->load->view('templates/header_dashboard', $data);
        $this->load->view('templates/sidebar_dashboard', $data);
        $this->load->view('user/chapters', $data);
        $this->load->view('templates/footer_dashboard');
    }

    public function materi_view()
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['chapter'] = $this->db->get_where('materi', ['id' => $this->input->get('chapter')])->row_array();

        $data['title'] = "Siswa " . $data['user']['name'];
        $this->load->view('templates/header_dashboard', $data);
        $this->load->view('templates/sidebar_dashboard', $data);
        $this->load->view('user/chapter_view', $data);
        $this->load->view('templates/footer_dashboard');
    }
}
