<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// Define the ProfileModel class which extends the CI_Model class
class ProfileModel extends CI_Model {
    // Function to get user details by user ID
    public function getUserById($user_id) {
        // Query to fetch user details from the 'users' table
        $query = $this->db->get_where('users', array('user_id' => $user_id));
        return $query->row_array();
    }

    // Function to get questions asked by a user
    public function getQuestionsByUser($user_id) {
        // Select all columns from the 'questions' table where the user_id matches
        $this->db->select('*');
        $this->db->from('questions');
        $this->db->where('user_id', $user_id);
        $query = $this->db->get();
        return $query->result_array();
    }

    // Function to get answers given by a user
    public function getAnswersByUser($user_id) {
        // Select all columns from the 'answers' table where the user_id matches
        $this->db->select('*');
        $this->db->from('answers');
        $this->db->where('user_id', $user_id);
        $query = $this->db->get();
        return $query->result_array();
    }

    // Function to delete a question and its associated data
    public function deleteQuestion($question_id) {
        // Delete associated question tags
        $this->db->where('question_id', $question_id);
        $this->db->delete('question_tags');

        // Delete associated answers and votes
        $this->deleteAnswersAndVotes($question_id);

        // Delete saved questions
        $this->db->where('question_id', $question_id);
        $this->db->delete('saved_questions');

        // Delete the question itself
        $this->db->where('question_id', $question_id);
        $this->db->delete('questions');
    }

    // function to delete answers and associated votes
    private function deleteAnswersAndVotes($question_id) {
        // Fetch associated answer IDs
        $this->db->select('answer_id');
        $this->db->where('question_id', $question_id);
        $query = $this->db->get('answers');
        $answer_ids = $query->result_array();

        // Delete associated votes
        foreach ($answer_ids as $answer) {
            $this->db->where('answer_id', $answer['answer_id']);
            $this->db->delete('votes');
        }

        // Delete associated answers
        $this->db->where('question_id', $question_id);
        $this->db->delete('answers');
    }

    // Function to delete an answer and its associated votes
    public function deleteAnswer($answer_id) {

        // Delete the votes records for the answer
        $this->db->where('answer_id', $answer_id);
        $this->db->delete('votes');

        // Delete the answer record
        $this->db->where('answer_id', $answer_id);
        $this->db->delete('answers');
    }

    // Function to update user's username and password
    public function updateUser($user_id, $new_username, $new_password) {
        // Prepare data for updating username and password
        $data = array(
            'username' => $new_username,
            'password' => password_hash($new_password, PASSWORD_DEFAULT) // Hash the password before storing
        );
        // Update the 'users' table with the new username and password
        $this->db->where('user_id', $user_id);
        $this->db->update('users', $data);
    }
    
}
?>
