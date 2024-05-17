<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// Define the Dashboard class which extends the CI_Controller class
class Dashboard extends CI_Controller {

    public function __construct() {
        parent::__construct();
        // Load the Question model
        $this->load->model('Question_model');
        // Load the database library for database operations
        $this->load->database();
        // Load the URL helper for URL-related functions
        $this->load->helper('url');
        // Load the session library for managing user sessions
        $this->load->library('session');
    }

    // Method to display the dashboard with the top 15 questions
    public function index() {
        $data['questions'] = $this->Question_model->get_top_questions(15);
        $this->load->view('dashboard', $data);
    }

    // Method to display all questions
    public function questions() {
        $data['questions'] = $this->Question_model->get_questions();
        $this->load->view('all_question', $data);
    }

    // Method to handle search functionality
    public function search() {
        $keyword = $this->input->post('keyword'); // Assuming the keyword is sent via POST
        if (!empty($keyword)) {
            // If a keyword is provided, search for matching questions
            $data['questions'] = $this->Question_model->search_questions($keyword);
        } else {
            // Show top 15 questions, If keyword is empty
            $data['questions'] = $this->Question_model->get_top_questions(15);
        }
        $this->load->view('dashboard', $data);
    }

    // Method to display the add question form
    public function add_question() {
        $this->load->view('add_question');
    }

    // Method to save a new question to the database
    public function save_question() {
        $user_id = $this->session->userdata('user_id');

        // Prepare the question data for insertion
        $data = array(
            'user_id' => $user_id,
            'title' => $this->input->post('title'),
            'content' => $this->input->post('content'),
            'tags' => $this->input->post('tags'),
            'created_at' => date('Y-m-d H:i:s')
        );

        // Add the new question to the database using the Question model
        $this->Question_model->add_question($data);
        
        redirect('dashboard');
    }
}
?>