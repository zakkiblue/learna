<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        
        $this->load->library('form_validation');
    }

    public function index()
    {
        if (null !== $this->session->userdata('email')) {
            if ($this->session->userdata('role_id') == 1) {
                $this->session->set_flashdata('massage', '<div class="alerts failed" role="alert">Anda tidak memiliki akses!!</div>');
                redirect('admin');
            } elseif ($this->session->userdata('role_id') == 2 || $this->session->userdata('role_id') == 3) {
                $this->session->set_flashdata('massage', '<div class="alerts failed" role="alert">Anda tidak memiliki akses!!</div>');
                redirect('user_mipa');
            }
        }
        //Validasi form
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'required|trim');
        if ($this->form_validation->run() == false) {
            $this->load->view('Auth/login');
        } else {
            $this->_login();
        }
    }
    private function _login()
    {
        $email = $this->input->post('email');
        $password = $this->input->post('password');

        $user = $this->db->get_where('user', ['email' => $email])->row_array();

        //user found
        if ($user) {
            //user active
            if ($user['is_active'] == 1) {
                //cek password
                if (password_verify($password, $user['password'])) {
                    $data = [
                        'email' => $user['email'],
                        'role_id' => $user['role_id'],
                    ];
                    $this->session->set_userdata($data);
                    if ($user['role_id'] == 1) {
                        redirect('admin');
                    } elseif ($user['role_id'] == 2 || $user['role_id'] == 3) {

                        redirect('user_mipa');
                    }
                } else {
                    $this->session->set_flashdata('massage', '<div class="alerts failed" role="alert">Password salah</div>');
                    redirect('Auth');
                }
            } else {
                $this->session->set_flashdata('massage', '<div class="alerts failed" role="alert">Email belum diverifikasi</div>');
                redirect('Auth');
            }
        } else {
            $this->session->set_flashdata('massage', '<div class="alerts failed" role="alert">Email belum terdaftar</div>');
            redirect('Auth');
        }
    }

    public function signup()
    {
        //cek login
        if (null !== $this->session->userdata('email')) {
            if ($this->session->userdata('role_id') == 1) {
                $this->session->set_flashdata('massage', '<div class="alerts failed" role="alert">Anda tidak memiliki akses!!</div>');
                redirect('admin');
            } elseif ($this->session->userdata('role_id') == 2 || $this->session->userdata('role_id') == 3) {
                $this->session->set_flashdata('massage', '<div class="alerts failed" role="alert">Anda tidak memiliki akses!!</div>');
                redirect('user_mipa');
            }
        }
        $this->form_validation->set_rules('name', 'Name', 'required|trim');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[user.email]');
        $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[4]|matches[password2]');
        $this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]');

        if ($this->form_validation->run() == false) {
            $this->load->view('Auth/signup');
        } else {

            if ($this->input->post('jurusan') == 'mipa') {
                $role = 2;
            } elseif ($this->input->post('jurusan') == 'ips') {
                $role = 3;
            }

            $data = [
                'name' => htmlspecialchars($this->input->post('name', true)),
                'email' => htmlspecialchars($this->input->post('email', true)),
                'image' => 'default.jpg',
                'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
                'role_id' => $role,
                'is_active' => 1,
                'date_created' => time()
            ];

            $this->db->insert('user', $data);
            $this->session->set_flashdata('massage', '<div class="alerts success" role="alert">Registrasi berhasil</div>');
            redirect('Auth');
        }
    }

    public function logout()
    {
        $this->session->unset_userdata('email');
        $this->session->unset_userdata('role_id');

        $this->session->set_flashdata('massage', '<div class="alerts success" role="alert">Berhasil logout</div>');
        redirect('Auth');
    }
}
