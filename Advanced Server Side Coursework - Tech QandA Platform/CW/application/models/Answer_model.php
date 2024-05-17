<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// Define the Answer_model class which extends the CI_Model class
class Answer_model extends CI_Model {

    // Method to add a new answer to the database
    public function add_answer($data) {
        $this->db->insert('answers', $data);
    }

    // Method to retrieve answers for a specific question
    public function get_answers($question_id) {
        // Select answers along with the username of the user who posted the answer and Filter answers by the question ID
        $this->db->select('answers.*, users.username');
        $this->db->from('answers');
        $this->db->join('users', 'users.user_id = answers.user_id', 'left');
        $this->db->where('answers.question_id', $question_id);
        return $this->db->get()->result_array();
    }

}