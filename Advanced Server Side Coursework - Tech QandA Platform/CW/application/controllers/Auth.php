<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// Defining the Auth class which extends the CI_Controller class
class Auth extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        // Load the URL helper for URL-related functions
        $this->load->helper('url'); 
        // Load the user_model
        $this->load->model('user_model');
        // Load the form validation library for validating form inputs
        $this->load->library('form_validation');
        // Load the session library for managing user sessions
        $this->load->library('session'); 
    }

    // Method to handle user registration
    public function register() {
        // Set validation rules for the registration form
        $this->form_validation->set_rules('username', 'Username', 'trim|required|is_unique[users.username]');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[users.email]');

        // Check if the form validation has passed
        if ($this->form_validation->run() === FALSE) {
            // Validation failed, show the errors
            $this->load->view('register');
        } else {
            // Validation succeeded, proceed with registration 
            $data = array(
                'username' => $this->input->post('username'),
                'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
                'email' => $this->input->post('email')
            );

            // Call the model method to create a new user in the database
            $this->user_model->create_user($data);

            // Redirect to a success page or login page
            redirect('auth/login');
        }
    }

    public function login() {
        // Render the login form view
        $this->load->view('login');
    }

    
    // Method to handle user logout
    public function logout() {
        // Destroy the current user session
        $this->user_model->destroy_session();
        redirect('auth/login');
    }
}
