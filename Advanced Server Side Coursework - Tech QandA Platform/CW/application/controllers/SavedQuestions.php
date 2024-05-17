<?php
// Define the SavedQuestions class which extends the CI_Controller class
class SavedQuestions extends CI_Controller {

    public function __construct() {
        parent::__construct();
        // Load the saved questions models
        $this->load->model('SavedQuestions_model');
        // Load the database library for database operations
        $this->load->database();
        // Load the URL helper for URL-related functions
        $this->load->helper('url');
        // Load the session library for managing user sessions
        $this->load->library('session');
        // Load the user_agent library
        $this->load->library('user_agent');
    }

    // Function to save a question
    public function save($question_id) {
        // Get the user ID from session
        $user_id = $this->session->userdata('user_id');

        // Check if the question is already saved for the user
        if (!$this->SavedQuestions_model->save_question($user_id, $question_id)) {
            // Set flashdata error message if the question is already saved
            $this->session->set_flashdata('error', 'Question already saved');
        } else {
            // Set flashdata success message if the question is saved successfully
            $this->session->set_flashdata('success', 'Question saved successfully');
        }

        // Redirect to the previous page
        redirect($this->agent->referrer());
    }

    // Function to view all saved questions
    public function index() {
        // Get the user ID from session
        $user_id = $this->session->userdata('user_id');

        // Get all saved questions for the user
        $data['saved_questions'] = $this->SavedQuestions_model->get_saved_questions($user_id);

        // Load the view to display saved questions
        $this->load->view('saved_questions', $data);
    }
}
