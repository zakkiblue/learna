<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{

    public function index()
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['title'] = "Admin";
        $this->load->view('templates/header_dashboard', $data);
        $this->load->view('templates/sidebar_admin', $data);
        $this->load->view('admin/index', $data);
        $this->load->view('templates/footer_dashboard');
    }

    public function input_materi(){
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['title'] = "Input Materi";
        $this->load->library('form_validation');
        $this->form_validation->set_rules('chapter_name', 'Chapter name', 'required|trim');
        

        if($this->form_validation->run() == false){
        $this->load->view('templates/header_dashboard', $data);
        $this->load->view('templates/sidebar_admin', $data);
        $this->load->view('admin/input_materi', $data);
        $this->load->view('templates/footer_dashboard');
        }
        else {
            $mapel = $this->db->get_where('mapel', ['mapel_name' => $this->input->post('mapel')])->row_array();
            $upload_file = $_FILES['filename']['name'];
            $file_type = $this->input->post('type-file');
            //cek file 
            if($file_type == 'pdf' && $upload_file){
                $config['allowed_types'] = 'pdf';
                $config['max_size'] = '10240';
                $config['upload_path'] = './assets/files/docs/';
                $this->load->library('upload', $config);

                if($this->upload->do_upload('filename')){
                    $file_name = $this->upload->data('file_name');
                    $data = [
                        'chapter_name' => htmlspecialchars($this->input->post('chapter_name', true)),
                        'id_mapel' => $mapel['id'],
                        'chapter_no' => $this->input->post('chapter_no'),
                        'file_type' => $this->input->post('type-file'),
                        'filename' => $file_name,
                        'date_uploaded' => time()
                    ];
                    $this->db->insert('materi', $data);
                    $this->session->set_flashdata('massage', '<div class="alerts success" role="alert">input materi berhasil</div>');
                    redirect('Admin/input_materi');
                }else {
                    $error_msg = $this->upload->display_errors();
                    $this->session->set_flashdata('massage', '<div class="alerts success" role="alert">'.$error_msg.'</div>');
                    redirect('Admin/input_materi');
                }
            }
            if($file_type == 'video' && $upload_file){
                $config['allowed_types'] = 'mp4';
                $config['max_size'] = '102400';
                $config['upload_path'] = './assets/files/videos/';
                $this->load->library('upload', $config);

                if($this->upload->do_upload('filename')){
                    $file_name = $this->upload->data('file_name');
                    $data = [
                        'chapter_name' => htmlspecialchars($this->input->post('chapter_name', true)),
                        'id_mapel' => $mapel['id'],
                        'chapter_no' => $this->input->post('chapter_no'),
                        'file_type' => $this->input->post('type-file'),
                        'filename' => $file_name,
                        'date_uploaded' => time()
                    ];
                    $this->db->insert('materi', $data);
                    $this->session->set_flashdata('massage', '<div class="alerts success" role="alert">input materi berhasil</div>');
                    redirect('Admin/input_materi');
                }else {
                    $error_msg = $this->upload->display_errors();
                    $this->session->set_flashdata('massage', '<div class="alerts success" role="alert">'.$error_msg.'</div>');
                    redirect('Admin/input_materi');
                }
            }



            
        }
    }
}