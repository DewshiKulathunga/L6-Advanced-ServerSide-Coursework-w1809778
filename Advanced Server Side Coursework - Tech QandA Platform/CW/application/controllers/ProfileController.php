<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// Define the ProfileController class which extends the CI_Controller class
class ProfileController extends CI_Controller {
    public function __construct() {
        parent::__construct();
        // Load the Profile model
        $this->load->model('ProfileModel');
        // Load the database library for database operations
        $this->load->database();
        // Load the URL helper for URL-related functions
        $this->load->helper('url');
        // Load the session library for managing user sessions
        $this->load->library('session');
    }

    // Function to display the user's profile
    public function index() {
        // Get the user ID from session
        $user_id = $this->session->userdata('user_id');

        // Collect user details, questions, and answers
        $data['user'] = $this->ProfileModel->getUserById($user_id);
        $data['questions'] = $this->ProfileModel->getQuestionsByUser($user_id);
        $data['answers'] = $this->ProfileModel->getAnswersByUser($user_id);

        $this->load->view('profile_view', $data);
    }

    // Function to delete a question
    public function deleteQuestion($question_id) {
        // check if user can delete a question by Calling method to delete the question
        $this->ProfileModel->deleteQuestion($question_id);
        redirect('profileController/index'); 
    }

    // Function to delete an answer
    public function deleteAnswer($answer_id) {
        // check if user can delete a answer by Calling method to delete the answer
        $this->ProfileModel->deleteAnswer($answer_id);
        redirect('profileController/index'); 
    }

    // Function to update user's information
    public function updateUser() {
        // Get the user ID from session
        $user_id = $this->session->userdata('user_id');
        // Get the new username from POST
        $new_username = $this->input->post('new_username');
        // Get the new password from POST
        $new_password = $this->input->post('new_password');
    
    
        // Updating the user's username and password
        $this->ProfileModel->updateUser($user_id, $new_username, $new_password);
    
        redirect('profileController/index');
    }
}
?>
