<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
    private $user_data = null;
    public function __construct()
    {
        parent::__construct();
        $this->user_data = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        if ($this->user_data['role_id'] != 1) {
            $this->session->set_flashdata('massage', '<div class="alerts failed" role="alert">Anda tidak memiliki akses!!</div>');
            redirect('user_mipa');
        }
    }
    public function index()
    {
        $data['title'] = "Admin " . $this->user_data['name'];
        $this->load->view('templates/header_dashboard', $data);
        $this->load->view('templates/sidebar_admin', $data);
        $this->load->view('admin/index', $data);
        $this->load->view('templates/footer_dashboard');
    }
    public function manage_materi()
    {
        $data['user'] = $this->user_data;
        $data['mapels'] = $this->db->get('mapel')->result_array();
        $data['title'] = "Admin " . $data['user']['name'];
        $this->load->view('templates/header_dashboard', $data);
        $this->load->view('templates/sidebar_admin', $data);
        $this->load->view('admin/manage_materi', $data);
        $this->load->view('templates/footer_dashboard');
    }
    public function add_mapel()
    {
        $data['user'] = $this->user_data;
        $data['title'] = "Tambah Mata Pelajaran";
        $this->load->library('form_validation');
        $this->form_validation->set_rules('mapel_name', 'Mata pelajaran', 'required|trim');
        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header_dashboard', $data);
            $this->load->view('templates/sidebar_admin', $data);
            $this->load->view('admin/add_mapel', $data);
            $this->load->view('templates/footer_dashboard');
        } else {

            $data = [
                'mapel_name' => htmlspecialchars($this->input->post('mapel_name', true)),
                'chapters' => htmlspecialchars($this->input->post('chapters', true)),
                'date_created' => time()
            ];

            $this->db->insert('mapel', $data);
            $id_mapel = $this->db->insert_id();
            if ($this->input->post('mapel1') == 'Mipa') {
                $data1 = [
                    'role_id' => 2,
                    'mapel_id' => $id_mapel
                ];
                $this->db->insert('role_mapel', $data1);
            }
            if ($this->input->post('mapel2') == 'Ips') {
                $data1 = [
                    'role_id' => 3,
                    'mapel_id' => $id_mapel
                ];
                $this->db->insert('role_mapel', $data1);
            }
            $this->session->set_flashdata('massage', '<div class="alerts success" role="alert">Mata pelajaran berhasil ditambahkan!</div>');
            redirect('Admin/manage_materi');
        }
    }

    public function input_materi()
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['mapels'] = $this->db->get('mapel')->result_array();
        $data['title'] = "Input Materi";
        $this->load->library('form_validation');
        $this->form_validation->set_rules('chapter_name', 'Chapter name', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header_dashboard', $data);
            $this->load->view('templates/sidebar_admin', $data);
            $this->load->view('admin/input_materi', $data);
            $this->load->view('templates/footer_dashboard');
        } else {
            $mapel = $this->db->get_where('mapel', ['mapel_name' => $this->input->post('mapel')])->row_array();
            $upload_file = $_FILES['filename']['name'];
            $file_type = $this->input->post('type-file');
            //cek file 
            if ($file_type == 'docs' && $upload_file) {
                $config['allowed_types'] = 'pdf';
                $config['max_size'] = '10240';
                $config['upload_path'] = './assets/files/docs/';
                $this->load->library('upload', $config);

                if ($this->upload->do_upload('filename')) {
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
                } else {
                    $error_msg = $this->upload->display_errors();
                    $this->session->set_flashdata('massage', '<div class="alerts failed" role="alert">' . $error_msg . '</div>');
                    redirect('Admin/input_materi');
                }
            }
            if ($file_type == 'videos' && $upload_file) {
                $config['allowed_types'] = 'mp4';
                $config['max_size'] = '102400';
                $config['upload_path'] = './assets/files/videos/';
                $this->load->library('upload', $config);

                if ($this->upload->do_upload('filename')) {
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
                } else {
                    $error_msg = $this->upload->display_errors();
                    $this->session->set_flashdata('massage', '<div class="alerts failed" role="alert">' . $error_msg . '</div>');
                    redirect('Admin/input_materi');
                }
            } else {
                $this->session->set_flashdata('massage', '<div class="alerts failed" role="alert">File harus diisi</div>');
                redirect('Admin/input_materi');
            }
        }
    }
    function delete_mapel()
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $mapel = $this->input->get('mapel');
        if ($data['user']['role_id'] == 1) {
            $this->db->where('id', $mapel);
            $this->db->delete('mapel');
            $this->session->set_flashdata('massage', '<div class="alerts success" role="alert">File telah dihapus</div>');
            redirect('Admin/manage_materi');
        } else {
            echo "gagal";
        }
    }
    function naming_quiz()
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['id_chapter'] = $this->input->get('chapter');
        $chapter_id = $this->input->get('chapter');;
        $data['title'] = "Input Kuis";
        $this->load->library('form_validation');
        $this->form_validation->set_rules('quiz_name', 'Nama Kuis', 'required|trim');
        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header_dashboard', $data);
            $this->load->view('templates/sidebar_admin', $data);
            $this->load->view('admin/naming_quiz', $data);
            $this->load->view('templates/footer_dashboard');
        } else {
            $data = [
                'quiz_name' => htmlspecialchars($this->input->post('quiz_name', true)),
                'chapter_id' => $chapter_id,
            ];

            $this->db->insert('quiz', $data);
            $quiz_id = $this->db->insert_id('id');
            $this->session->set_flashdata('massage', '<div class="alerts success" role="alert">Quiz baru berhasil ditambahkan!</div>');
            redirect('Admin/input_quiz?quiz=' . $quiz_id);
        }
    }
    function input_quiz()
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['id_quiz'] = $this->input->get('quiz');
        $quiz_id = $this->input->get('quiz');;
        $data['title'] = "Input Pertanyaan";
        $this->load->library('form_validation');

        $this->form_validation->set_rules('question', 'Pertanyaan', 'required|trim');
        $this->form_validation->set_rules('option1', 'Pilihan 1', 'required|trim');
        $this->form_validation->set_rules('option2', 'Pilihan 2', 'required|trim');
        $this->form_validation->set_rules('option3', 'Pilihan 3', 'required|trim');
        $this->form_validation->set_rules('option4', 'Pilihan 4', 'required|trim');


        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header_dashboard', $data);
            $this->load->view('templates/sidebar_admin', $data);
            $this->load->view('admin/input_quiz', $data);
            $this->load->view('templates/footer_dashboard');
        } else {

            $data_question = [
                'question' => htmlspecialchars($this->input->post('question', true)),
                'is_active' => 1,
                'quiz_id' => $quiz_id,
            ];
            $this->db->insert('question', $data_question);
            $question_id = $this->db->insert_id();

            $data1 = [
                'answer' => htmlspecialchars($this->input->post('option1')),
                'is_correct' => $this->input->post('option1_cek'),
                'question_id' => $question_id
            ];
            $data2 = [
                'answer' => htmlspecialchars($this->input->post('option2')),
                'is_correct' => $this->input->post('option2_cek'),
                'question_id' => $question_id
            ];
            $data3 = [
                'answer' => htmlspecialchars($this->input->post('option3')),
                'is_correct' => $this->input->post('option3_cek'),
                'question_id' => $question_id
            ];
            $data4 = [
                'answer' => htmlspecialchars($this->input->post('option4')),
                'is_correct' => $this->input->post('option4_cek'),
                'question_id' => $question_id
            ];
            $this->db->insert('answer', $data1);
            $this->db->insert('answer', $data2);
            $this->db->insert('answer', $data3);
            $this->db->insert('answer', $data4);
            $this->session->set_flashdata('massage', '<div class="alerts success" role="alert">Pertanyaan berhasil ditambahkan!</div>');
            redirect('Admin/input_quiz?quiz=' . $quiz_id);
        }
    }
    function add_quiz()
    {

        var_dump($this->input->post());
    }
    function quiz_for()
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['materi'] = $this->db->get_where('materi', ['id_mapel' => $this->input->get('mapel')])->result_array();
        $data['title'] = "Pilih Chapter";
        $this->load->view('templates/header_dashboard', $data);
        $this->load->view('templates/sidebar_admin', $data);
        $this->load->view('admin/quiz_for', $data);
        $this->load->view('templates/footer_dashboard');
    }
}
