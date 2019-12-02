<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
    private $user_data = null;
    public function __construct()
    {
        parent::__construct();
        $this->user_data = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->library('form_validation');
        $this->load->library('pagination');
        if ($this->user_data['role_id'] != 1) {
            $this->session->set_flashdata('massage', '<div class="alerts failed" role="alert">Anda tidak memiliki akses!!</div>');
            redirect('Auth');
        }
    }
    public function index()
    {
        $data['user'] = $this->user_data;
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
    public function manage_quiz()
    {
        $data['user'] = $this->user_data;
        $data['mapels'] = $this->db->get('mapel')->result_array();
        $data['title'] = "Admin " . $data['user']['name'];
        $this->load->view('templates/header_dashboard', $data);
        $this->load->view('templates/sidebar_admin', $data);
        $this->load->view('admin/manage_quiz', $data);
        $this->load->view('templates/footer_dashboard');
    }
    public function quiz_list()
    {
        $data['user'] = $this->user_data;
        $data['chapter'] = $this->db->get_where('materi', ['id_mapel' => $this->input->get('mapel')])->result_array();
        $data['mapel'] = $this->db->get_where('mapel', ['id' => $this->input->get('mapel')])->row_array();
        $data['title'] = "Quiz " . $data['user']['name'];
        $this->load->view('templates/header_dashboard', $data);
        $this->load->view('templates/sidebar_admin', $data);
        $this->load->view('admin/quiz_list', $data);
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
        $data['user'] = $this->user_data;
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
        $data['user'] = $this->user_data;
        $mapel = $this->input->get('mapel');
        if ($data['user']['role_id'] == 1) {
            $this->db->where('id', $mapel);
            $this->db->delete('mapel');
            $this->session->set_flashdata('massage', '<div class="alerts success" role="alert">File telah dihapus</div>');
            redirect('Admin/manage_materi');
        } else {
            $this->session->set_flashdata('massage', '<div class="alerts failed" role="alert">File gagal dihapus</div>');
            redirect('Admin/manage_materi');
        }
    }
    function naming_quiz()
    {
        $data['user'] = $this->user_data;
        $data['id_chapter'] = $this->input->get('chapter');
        $chapter_id = $this->input->get('chapter');
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
            redirect('Admin/see_quiz?chapter=' . $chapter_id);
        }
    }
    function input_quiz()
    {
        $data['user'] = $this->user_data;
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
            redirect('Admin/see_question?quiz=' . $quiz_id);
        }
    }
    function add_quiz()
    {

        var_dump($this->input->post());
    }
    function quiz_for()
    {
        $data['user'] = $this->user_data;
        $data['materi'] = $this->db->get_where('materi', ['id_mapel' => $this->input->get('mapel')])->result_array();
        $data['title'] = "Pilih Chapter";
        $this->load->view('templates/header_dashboard', $data);
        $this->load->view('templates/sidebar_admin', $data);
        $this->load->view('admin/quiz_for', $data);
        $this->load->view('templates/footer_dashboard');
    }
    function see_quiz_for()
    {
        $data['user'] = $this->user_data;
        $data['materi'] = $this->db->get_where('materi', ['id_mapel' => $this->input->get('mapel')])->result_array();
        $data['title'] = "Pilih Chapter";
        $this->load->view('templates/header_dashboard', $data);
        $this->load->view('templates/sidebar_admin', $data);
        $this->load->view('admin/see_quiz_for', $data);
        $this->load->view('templates/footer_dashboard');
    }
    function see_quiz()
    {
        $data['user'] = $this->user_data;
        $data['quiz'] = $this->db->get_where('quiz', ['chapter_id' => $this->input->get('chapter')])->result_array();
        $data['title'] = "Pilih Quiz";
        $this->load->view('templates/header_dashboard', $data);
        $this->load->view('templates/sidebar_admin', $data);
        $this->load->view('admin/quiz_list', $data);
        $this->load->view('templates/footer_dashboard');
    }
    function see_question()
    {
        $data['user'] = $this->user_data;
        $data['questions'] = $this->db->get_where('question', ['quiz_id' => $this->input->get('quiz')])->result_array();
        $data['title'] = "Question List";
        $this->load->view('templates/header_dashboard', $data);
        $this->load->view('templates/sidebar_admin', $data);
        $this->load->view('admin/question_list', $data);
        $this->load->view('templates/footer_dashboard');
    }
    public function delete_question()
    {
        $question = $this->input->get('question');
        $quiz = $this->input->get('quiz');
        $this->db->where('id', $question);
        $this->db->delete('question');
        //delete answer
        $this->db->where('question_id', $question);
        $this->db->delete('answer');

        $this->session->set_flashdata('massage', '<div class="alerts success" role="alert">Pertanyaan telah dihapus</div>');
        redirect('Admin/see_question?quiz=' . $quiz);
    }
    public function answer_list()
    {
        $data['user'] = $this->user_data;
        $data['answers'] = $this->db->get_where('answer', ['question_id' => $this->input->get('question')])->result_array();
        $data['title'] = "Answer List";
        $this->load->view('templates/header_dashboard', $data);
        $this->load->view('templates/sidebar_admin', $data);
        $this->load->view('admin/answer_list', $data);
        $this->load->view('templates/footer_dashboard');
    }
    public function monitor_siswa()
    {
        $data['user'] = $this->user_data;

        $this->db->select('id,name,email');
        $this->db->from('user');
        $this->db->where('role_id', 2);
        $this->db->or_where('role_id', 3);
        $total = $this->db->get()->num_rows();
        // var_dump($data['siswa']);
        // die;
        $config['base_url'] = 'http://localhost/Learn/admin/monitor_siswa';
        $config['total_rows'] = $total;
        $config['per_page'] = 10;
        $config['full_tag_open'] = '<div class="paginations">';
        $config['full_tag_close'] = '</div>';
        $data['start'] = $this->uri->segment(3);
        $this->pagination->initialize($config);
        // get data
        $this->db->select('id,name,email');
        $this->db->from('user');
        $this->db->where('role_id', 2);
        $this->db->or_where('role_id', 3);
        $this->db->limit($config['per_page'], $data['start']);
        $data['siswa'] = $this->db->get()->result_array();
        $data['title'] = "List Siswa";
        $this->load->view('templates/header_dashboard', $data);
        $this->load->view('templates/sidebar_admin', $data);
        $this->load->view('admin/monitor_siswa', $data);
        $this->load->view('templates/footer_dashboard');
    }
    public function murid()
    {
        $data['user'] = $this->user_data;
        $jurusan = $this->uri->segment(3);
        $this->db->select('id,name,email');
        $this->db->from('user');
        $this->db->where('role_id', $jurusan);
        $total = $this->db->get()->num_rows();
        // var_dump($data['siswa']);
        // die;
        $config['base_url'] = 'http://localhost/Learn/admin/murid/' . $jurusan;
        $config['total_rows'] = $total;
        $config['per_page'] = 10;
        $config['full_tag_open'] = '<div class="paginations">';
        $config['full_tag_close'] = '</div>';
        $data['start'] = $this->uri->segment(4);
        $this->pagination->initialize($config);
        // get data
        $this->db->select('id,name,email');
        $this->db->from('user');
        $this->db->where('role_id', $jurusan);
        $this->db->limit($config['per_page'], $data['start']);
        $data['siswa'] = $this->db->get()->result_array();
        // var_dump($data['siswa']);
        // die;

        $data['title'] = "List Siswa";
        $this->load->view('templates/header_dashboard', $data);
        $this->load->view('templates/sidebar_admin', $data);
        $this->load->view('admin/monitor_siswa', $data);
        $this->load->view('templates/footer_dashboard');
    }
    public function detail_siswa()
    {
        $data['user'] = $this->user_data;
        $id = $this->input->get('siswa');
        $this->db->select('*');
        $this->db->from('user');
        $this->db->where('id', $id);
        $data['siswa'] = $this->db->get()->row_array();
        // var_dump($data['siswa']);
        // die;
        $this->db->select('*');
        $this->db->from('exam');
        $this->db->join('quiz', 'quiz.id=exam.quiz_id');
        $this->db->join('materi', 'quiz.chapter_id=materi.id');
        $this->db->join('mapel', 'mapel.id=materi.id_mapel');
        $this->db->where('exam.user_id', $id);
        $data['rekap'] = $this->db->get()->result_array();
        // 
        $data['title'] = "Detail Siswa";
        $this->load->view('templates/header_dashboard', $data);
        $this->load->view('templates/sidebar_admin', $data);
        $this->load->view('admin/detail_siswa', $data);
        $this->load->view('templates/footer_dashboard');
    }
    public function profil()
    {
        $data['user'] = $this->user_data;
        $data['title'] = "Edit Profil";

        $this->form_validation->set_rules('name', 'Full name', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header_dashboard', $data);
            $this->load->view('templates/sidebar_admin', $data);
            $this->load->view('admin/profil', $data);
            $this->load->view('templates/footer_dashboard');
        } else {
            $name = $this->input->post('name');
            $email = $this->input->post('email');

            $upload_image = $_FILES['image']['name'];
            if ($upload_image) {
                $config['allowed_types'] = 'jpg|jpeg|png';
                $config['max_size'] = '12048';
                $config['upload_path'] = './assets/img/profile/';
                $this->load->library('upload', $config);
                if ($this->upload->do_upload('image')) {
                    $new_image = $this->upload->data('file_name');
                    $this->db->set('image', $new_image);
                } else {
                    $error = $this->upload->display_errors();
                    $this->session->set_flashdata('massage', '<div class="alerts failed" role="alert">' . $error . '</div>');
                    redirect('User_mipa/profil');
                }
            }
            $this->db->set('name', $name);
            $this->db->where('email', $email);
            $this->db->update('user');

            $this->session->set_flashdata('massage', '<div class="alerts success" role="alert">Profil berhasil diedit!</div>');
            redirect('Admin/profil');
        }
    }
    public function materi_list()
    {
        $data['user'] = $this->user_data;
        $id_mapel = $this->input->get('mapel');
        $mapel = $this->db->get_where('mapel', ['id' => $id_mapel])->row_array();
        $data['materis'] = $this->db->get_where('materi', ['id_mapel' => $id_mapel])->result_array();
        $data['title'] = $mapel['mapel_name'];
        $this->load->view('templates/header_dashboard', $data);
        $this->load->view('templates/sidebar_admin', $data);
        $this->load->view('admin/chapters', $data);
        $this->load->view('templates/footer_dashboard');
    }
    public function delete_materi()
    {
        $materi = $this->input->get('materi');
        $mapel = $this->input->get('mapel');
        $this->db->from('materi');
        $this->db->join('quiz', 'materi.id=quiz.chapter_id');
        $this->db->join('question', 'quiz.id=question.quiz_id');
        $this->db->join('answer', 'question.id=answer.question_id');
        $this->db->join('exam', 'quiz.id=exam.quiz_id');
        $this->db->where('materi.id', $materi);
        $this->db->delete('materi');
        // //delete answer
        // $this->db->where('question_id', $question);
        // $this->db->delete('answer');

        $this->session->set_flashdata('massage', '<div class="alerts success" role="alert">Pertanyaan telah dihapus</div>');
        redirect('Admin/materi_list?mapel=' . $mapel);
    }
    public function add_admin()
    {
        $data['user'] = $this->user_data;
        $data['title'] = "Tambah Admin";
        $this->form_validation->set_rules('name', 'Name', 'required|trim');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[user.email]');
        $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[4]|matches[password2]');
        $this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header_dashboard', $data);
            $this->load->view('templates/sidebar_admin', $data);
            $this->load->view('admin/add_admin', $data);
            $this->load->view('templates/footer_dashboard');
        } else {

            $data = [
                'name' => htmlspecialchars($this->input->post('name', true)),
                'email' => htmlspecialchars($this->input->post('email', true)),
                'image' => 'default.jpg',
                'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
                'role_id' => 1,
                'is_active' => 1,
                'date_created' => time()
            ];

            $this->db->insert('user', $data);
            $this->session->set_flashdata('massage', '<div class="alerts success" role="alert">Registrasi berhasil</div>');
            redirect('Admin/profil');
        }
    }
}
