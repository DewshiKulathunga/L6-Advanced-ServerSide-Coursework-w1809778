<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// Define the User_model class which extends the CI_Model class
class User_model extends CI_Model {
    
    public function __construct() {
        parent::__construct();
        // Load the database library for database operations
        $this->load->database();
    }
    
    // Method to create a new user in the databas by inserting data to users tabel
    public function create_user($data) {
        $this->db->insert('users', $data);
    }
    
    // Method to get a user from the database by username
    public function get_user_by_username($username) {
        return $this->db->get_where('users', array('username' => $username))->row();
    }
    
    // Method to create a user session
    public function create_session($user_id) {
        $session_data = array(
            'user_id' => $user_id,
            'logged_in' => TRUE
        );
        $this->session->set_userdata($session_data);
    }
    
    // Method to destroy the current user session
    public function destroy_session() {
        $this->session->sess_destroy();
    }
}
