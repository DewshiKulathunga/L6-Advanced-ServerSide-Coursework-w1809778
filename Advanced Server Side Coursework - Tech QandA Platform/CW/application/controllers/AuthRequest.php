<?php defined('BASEPATH') OR exit('No direct script access allowed');

// Require the RestController and Format libraries for RESTful API functionality
require APPPATH . 'libraries/RestController.php';
require APPPATH . 'libraries/Format.php';

// Use the RestServer's RestController
use chriskacerguis\RestServer\RestController;

// Define the AuthRequest class which extends the RestController class
class AuthRequest extends RestController {
    function __construct() {
        parent::__construct();
        // Load the user model
        $this->load->model('user_model');
        // Load the form validation library for validating form inputs
        $this->load->library('form_validation');
        // Load the URL helper for URL-related functions
        $this->load->helper('url');
        // Load the session library for managing user sessions
        $this->load->library('session');
        // Load the database library for database operations
        $this->load->database();

    }

    // Method to handle user login via POST request
    public function login_post() {
        // Collect the username and password from the POST request
        $username = $this->post('username');
        $password = $this->post('password');

        //form validation rules
        $this->form_validation->set_data(['username' => $username, 'password' => $password]);
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');
    
        // Check if the form validation has passed
        if ($this->form_validation->run() == FALSE) {
            // Invalid input, return error
            $this->response([
                'status' => FALSE,
                'message' => 'Login failed. Validation errors.',
                'errors' => $this->form_validation->error_array()
            ], RestController::HTTP_BAD_REQUEST);
        } else {
            // Validation successful
            $user = $this->user_model->get_user_by_username($username);
    
            // Check if user exists and password is correct
            if ($user && password_verify($password, $user->password)) {
                // create session with user_id
                $this->user_model->create_session($user->user_id);
                // Return a success response with user data
                $this->response([
                    'status' => TRUE,
                    'message' => 'Login successful',
                    'userData' => $user
                ], RestController::HTTP_OK);
                
            } else {
                // Authentication failed, return error response
                $this->response([
                    'status' => FALSE,
                    'message' => 'Login failed. Email or password is incorrect. Please Check'
                ], RestController::HTTP_NOT_FOUND);
            }
        }
    }
}