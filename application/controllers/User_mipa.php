<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User_mipa extends CI_Controller
{
    private $user_data = null;
    public function __construct()
    {
        parent::__construct();
        $this->user_data = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        if ($this->user_data['role_id'] != 2 && $this->user_data['role_id'] != 3) {
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
    function quiz_list()
    {
        $data['user'] = $this->user_data;
        $data['quiz'] = $this->db->get_where('quiz', ['chapter_id' => $this->input->get('chapter')])->result_array();
        $data['title'] = "Pilih Quiz";
        $this->load->view('templates/header_dashboard', $data);
        $this->load->view('templates/sidebar_dashboard', $data);
        $this->load->view('user/quiz_list', $data);
        $this->load->view('templates/footer_dashboard');
    }
    function quiz_start()
    {
        $data['user'] = $this->user_data;
        $data['questions'] = $this->db->get_where('question', ['quiz_id' => $this->input->get('quiz')])->result_array();
        foreach ($data['questions'] as $question) {
            $data['options'][$question['id']] = $this->db->get_where('answer', ['question_id' => $question['id']])->result_array();
            // var_dump($data['options'][$question['id']]);
            // echo "<hr>";
        }
        // var_dump($data['questions']);
        // echo "</br><hr>";

        // die;
        $data['title'] = "Kerjakan Quiz";
        $this->load->view('templates/header_dashboard', $data);
        $this->load->view('templates/sidebar_dashboard', $data);
        $this->load->view('user/quiz_start', $data);
        $this->load->view('templates/footer_dashboard');
    }
    function assessment()
    {
        if (null == $this->input->post()) {
            redirect('user_mipa/materi');
        }
        $data['user'] = $this->user_data;
        $i = 1;
        $score = 0;
        $max = $this->input->post('max');
        $quiz_id = $this->input->post('quiz');
        $questions = $this->db->get_where('question', ['quiz_id' => $quiz_id])->result_array();
        foreach ($questions as $question) {
            $answer[$question['id']] = $this->db->get_where('answer', ['question_id' => $question['id'], 'is_correct' => 'yes'])->result_array();
        }
        // koreksi
        foreach ($answer as $option) {
            foreach ($option as $true) {
                for ($i = 1; $i <= $max; $i++) {
                    if ($true['id'] == $this->input->post($i)) {
                        $score += 1;
                    }
                }
            }
        }
        $score = $score / $max * 100;
        $time = time();
        $status = "Belum lulus";
        if ($score >= 70) {
            $status = "Lulus";
        }
        // var_dump($question);
        // echo "<br><hr>";
        // var_dump($this->input->post());
        // echo "</br><hr>" . $status;
        // var_dump($answer);
        // echo "<hr><button>" . $score . " | " . $time . "</button>";
        // die;
        $exam = [
            'user_id' => $data['user']['id'],
            'quiz_id' => $quiz_id,
            'score' => $score,
            'status' => $status,
            'time_taken' => $time,
        ];
        $this->db->insert('exam', $exam);
        $data['result'] = [
            'score' => $score,
            'status' => $status,
        ];
        $data['title'] = "Hasil Quiz";
        $this->load->view('templates/header_dashboard', $data);
        $this->load->view('templates/sidebar_dashboard', $data);
        $this->load->view('user/quiz_result', $data);
        $this->load->view('templates/footer_dashboard');
    }
}
