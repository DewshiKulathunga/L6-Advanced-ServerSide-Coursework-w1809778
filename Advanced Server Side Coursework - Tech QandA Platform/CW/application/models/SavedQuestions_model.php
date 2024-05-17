<?php
// Define the SavedQuestions_model class which extends the CI_Model class
class SavedQuestions_model extends CI_Model {

    // Function to save a question
    public function save_question($user_id, $question_id) {
        // Check if the question is already saved by the user
        if ($this->is_question_saved($user_id, $question_id)) {
            return false;
        }

        // Prepare data to insert into the 'saved_questions' table
        $data = array(
            'user_id' => $user_id,
            'question_id' => $question_id
        );
        $this->db->insert('saved_questions', $data);
        return true;
    }

    // Function to check if a question is already saved by the user
    public function is_question_saved($user_id, $question_id) {
        // Query to check if the question is saved by the user
        $this->db->where('user_id', $user_id);
        $this->db->where('question_id', $question_id);
        $query = $this->db->get('saved_questions');

        // Return true if the query returns any rows, indicating the question is already saved
        return $query->num_rows() > 0;
    }

    // Function to get all saved questions for a user
    public function get_saved_questions($user_id) {
        // Select questions data for the saved questions and filter
        $this->db->select('questions.*');
        $this->db->from('questions');
        $this->db->join('saved_questions', 'questions.question_id = saved_questions.question_id');
        $this->db->where('saved_questions.user_id', $user_id);

        $query = $this->db->get();
        return $query->result();
    }
}
