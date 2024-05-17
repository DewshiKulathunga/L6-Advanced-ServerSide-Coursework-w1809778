<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// Define the Question_model class which extends the CI_Model class
class Question_model extends CI_Model {

    // Method to fetch the top questions from the database with a limit
    public function get_top_questions($limit) {
        // Select all columns from the questions table and Order by creation date in descending order
        $this->db->select('*');
        $this->db->from('questions');
        $this->db->order_by('created_at', 'DESC');
        $this->db->limit($limit);
        $query = $this->db->get();
        return $query->result_array();
    }

    // Method to fetch all questions along with user names from the database
    public function get_questions() {
        // Fetch questions along with user names from the database
        $this->db->select('questions.*, users.username as user_name');
        $this->db->from('questions');
        $this->db->join('users', 'users.user_id = questions.user_id', 'left');
        $this->db->order_by('created_at', 'DESC');
        $query = $this->db->get();
        return $query->result_array();
    }

    // Method to search questions based on a keyword
    public function search_questions($keyword) {
        // Search questions based on keyword and retrieve user name and tags
        $this->db->select('questions.*, users.username as user_name, GROUP_CONCAT(tags.tag_name) as tag_names');
        $this->db->from('questions');
        $this->db->join('users', 'users.user_id = questions.user_id', 'left');
        $this->db->join('question_tags', 'question_tags.question_id = questions.question_id', 'left');
        $this->db->join('tags', 'tags.tag_id = question_tags.tag_id', 'left');
        $this->db->group_by('questions.question_id'); // Group by question ID to avoid duplicate rows
        $this->db->group_start();
        // Filter based on the keyword in the title or tags
        $this->db->like('title', $keyword);
        $this->db->or_like('tags.tag_name', $keyword); // Search within tags
        $this->db->group_end();
        $query = $this->db->get();
        $result = $query->result_array();
    
        // Check if result is empty or not an array
        if (empty($result) || !is_array($result)) {
            return array();
        }
    
        // Process each question to split and organize tags
        foreach ($result as &$question) {
            if ($question['tag_names']) {
                $tags = explode(',', $question['tag_names']);
                $question['tags'] = $tags;
            } else {
                $question['tags'] = array(); // Set an empty array if no tags found
            }
            unset($question['tag_names']); // Remove the temporary tag_names field
        }
    
        return $result;
    }
    
    // Method to add a new question to the database
    public function add_question($data) {
        // Extract tags from the data array
        $tags = explode(',', $data['tags']);
        unset($data['tags']);
    
        // Insert question into the database
        $this->db->insert('questions', $data);
        // Get the ID of the inserted question
        $question_id = $this->db->insert_id(); 
    
        // Insert tags into the tags table if they don't exist already
        foreach ($tags as $tag) {
            $tag = trim($tag);
            // Check if the tag already exists
            $tag_exists = $this->db->get_where('tags', array('tag_name' => $tag))->row_array();
            if (!$tag_exists) {
                // Insert new tag
                $this->db->insert('tags', array('tag_name' => $tag));
                $tag_id = $this->db->insert_id();
            } else {
                $tag_id = $tag_exists['tag_id'];
            }
    
            // Link tag to the question
            $this->db->insert('question_tags', array(
                'question_id' => $question_id,
                'tag_id' => $tag_id
            ));
        }
    
        return $question_id; // Return the ID of the inserted question
    }

    // Method to fetch details of a specific question including username
    public function get_question($question_id) {
        // Select question details and username and Filter by question ID
        $this->db->select('questions.*, users.username');
        $this->db->from('questions');
        $this->db->join('users', 'users.user_id = questions.user_id', 'left');
        $this->db->where('questions.question_id', $question_id);
        $query = $this->db->get();
    
        // Check if the query has a result
        if ($query->num_rows() > 0) {
            // Return the first
            return $query->row_array();
        } else {
            // Return false if no question found
            return false;
        }
    }

    // Method to upvote an answer
    public function upvote_answer($answer_id, $question_id) {
        $user_id = $this->session->userdata('user_id');
    
        // Check if the user has already voted on this answer
        $existing_vote = $this->db->get_where('votes', [
            'user_id' => $user_id,
            'answer_id' => $answer_id,
            'question_id' => $question_id,
        ])->row();
    
        if ($existing_vote) {
            // User has voted, check the vote type
            if ($existing_vote->vote_type == 'upvote') {
                // User already upvoted, ignore
            } else {
                // User has downvoted, update the vote to upvote
                $this->db->where([
                    'user_id' => $user_id,
                    'answer_id' => $answer_id,
                    'question_id' => $question_id,
                ])->update('votes', ['vote_type' => 'upvote']);
            }
        } else {
            // User hasn't voted, add an upvote
            $this->db->insert('votes', [
                'user_id' => $user_id,
                'answer_id' => $answer_id,
                'question_id' => $question_id,
                'vote_type' => 'upvote',
            ]);
        }
    }
    
    // Method to downvote an answer
    public function downvote_answer($answer_id, $question_id) {
        $user_id = $this->session->userdata('user_id');
    
        // Check if the user has already voted on this answer
        $existing_vote = $this->db->get_where('votes', [
            'user_id' => $user_id,
            'answer_id' => $answer_id,
            'question_id' => $question_id,
        ])->row();
    
        if ($existing_vote) {
            // User has voted, check the vote type
            if ($existing_vote->vote_type == 'downvote') {
                // User already downvoted, ignore
            } else {
                // User has upvoted, update the vote to downvote
                $this->db->where([
                    'user_id' => $user_id,
                    'answer_id' => $answer_id,
                    'question_id' => $question_id,
                ])->update('votes', ['vote_type' => 'downvote']);
            }
        } else {
            // User hasn't voted, add a downvote
            $this->db->insert('votes', [
                'user_id' => $user_id,
                'answer_id' => $answer_id,
                'question_id' => $question_id,
                'vote_type' => 'downvote',
            ]);
        }
    }
}
?>
