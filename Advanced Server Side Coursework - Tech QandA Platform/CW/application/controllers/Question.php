<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// Define the Question class which extends the CI_Controller class
class Question extends CI_Controller {

    public function __construct() {
        parent::__construct();
        // Load the database library for database operations
        $this->load->database();
        // Load the URL helper for URL-related functions
        $this->load->helper('url');
        // Load the session library for managing user sessions
        $this->load->library('session');
        // Load the models for interacting with questions and answers
        $this->load->model('Question_model');
        $this->load->model('answer_model');
    }
    
    // Method to view a specific question along with its answers
    public function view($question_id) {
        $this->load->model('question_model');
        $this->load->model('answer_model');
        
        // Get the question details
        $data['question'] = $this->question_model->get_question($question_id);
        
        // Get answers for the question
        $data['answers'] = $this->answer_model->get_answers($question_id);
        
        // Load the view and pass data
        $this->load->view('question_view', $data);
    }

    // Method to submit an answer to a specific question
    public function submit_answer($question_id) {
        // Check if the request method is POST
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            // Retrieve the user ID from the session data
            $user_id = $this->session->userdata('user_id');

            // Prepare the answer data for insertion
            $data = array(
                'user_id' => $user_id,
                'content' => $this->input->post('answer_content'),
                'question_id' => $question_id,
            );

            // Call the model to add the answer
            $this->answer_model->add_answer($data);

            // Redirect back to the question view
            redirect('question/view/' . $question_id);
        }

    }

    // Method to upvote a specific answer
    public function upvote_answer($answer_id, $question_id) {
        $this->load->model('question_model');

        // Perform upvote logic
        $this->question_model->upvote_answer($answer_id, $question_id);

        // Redirect back to the question view
        redirect('question/view/' . $question_id);
    }

    // Method to downvote a specific answer
    public function downvote_answer($answer_id, $question_id) {
        $this->load->model('question_model');

        // Perform downvote logic
        $this->question_model->downvote_answer($answer_id, $question_id);

        // Redirect back to the question view
        redirect('question/view/' . $question_id);
    }

}