<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// Define the Tag_model class which extends the CI_Model class
class Tag_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        // Load the database library for database operations
        $this->load->database();
        // Load the URL helper for URL-related functions
        $this->load->helper('url');

    }

    // Method to get all tags from the database
    public function get_all_tags() {
        // Select all columns from the 'tags' table
        $this->db->select('*');
        $this->db->from('tags');
        $query = $this->db->get();
        return $query->result_array();
    }

    // Method to get questions associated with a specific tag
    public function get_questions_by_tag($tag_id) {
        // Select questions from the 'questions' table based on the given tag ID and filter
        $this->db->select('questions.*');
        $this->db->from('questions');
        $this->db->join('question_tags', 'question_tags.question_id = questions.question_id');
        $this->db->where('question_tags.tag_id', $tag_id);
        $query = $this->db->get();
        return $query->result_array();
    }
}
?>
