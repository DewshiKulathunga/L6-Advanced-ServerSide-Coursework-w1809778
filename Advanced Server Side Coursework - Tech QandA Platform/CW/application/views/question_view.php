<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Question View</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f8f9fa;
            color: #333;
        }
        header {
            background-color: #000036;
            color: #fff;
            padding: 20px;
            text-align: center;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        h1 {
            margin: 0;
        }
        .taskbar {
            width: 100%;
            background-color: #006994;
            padding: 10px 0;
            display: flex;
            justify-content: space-around;
            align-items: center;
            text-align: center;
            transition: background-color 0.3s ease;
        }
        .taskbar a {
            text-decoration: none;
            color: #fff;
            padding: 10px 20px;
            border-radius: 5px;
            transition: background-color 0.3s ease;
            width: 120px;
            height: 30px;
        }

        .taskbar a:nth-child(1) {
            margin-left: 180px; 
        }

        .taskbar a:nth-child(2) {
            margin-left: 30px; 
        }

        .taskbar a:nth-child(3) {
            margin-left: 25px; 
        }

        .taskbar a:not(:nth-child(1)) {
            margin-right: 30px; 
        }
        
        .taskbar a:hover {
            background-color: #0056b3;
        }
        .taskbar a.button {
            background-color: #007bff;
            border: 1px solid #007bff;
        }
        .taskbar a.button:hover {
            background-color: #0056b3;
            border: 1px solid #0056b3;
        }
        .container {
            max-width: 900px;
            margin: auto;
            padding: 20px;
            margin-top: 15px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        h2 {
            margin-top: 0;
        }
        ul {
            list-style-type: none;
            padding: 0;
        }
        .answer {
            background-color: #f9f9f9;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-bottom: 20px;
            padding: 20px;
            transition: box-shadow 0.3s ease;
        }
        .answer:hover {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .submit-answer-form {
            text-align: center;
            margin-top: 20px;
        }
        .submit-answer-form textarea {
            width: calc(100% - 22px);
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
            margin-bottom: 10px;
        }
        .submit-answer-form button {
            padding: 10px 40px;
            border-radius: 5px;
            border: none;
            background-color: #28a745;
            color: #fff;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }
        .submit-answer-form button:hover {
            background-color: #218838;
        }
        .vote-buttons {
            margin-top: 10px;
        }
        .vote-buttons a {
            display: inline-block;
            padding: 5px 10px;
            border-radius: 5px;
            background-color: #007bff;
            color: #fff;
            text-decoration: none;
            margin-right: 10px;
        }
        .vote-buttons a:hover {
            background-color: #0056b3;
        }
        .upvote-icon,
        .downvote-icon {
            width: 20px;
            vertical-align: middle;
            margin-right: 5px;
        }
        .save-button {
            margin-left: 10px;
        }
        .bookmark-icon {
            width: 20px;
            vertical-align: middle;
        }
        /* Sidebar styles */
        .sidebar {
            width: 250px;
            background-color: #343a40;
            color: #fff;
            position: fixed;
            top: 154px; 
            bottom: 0;
            left: 0;
            padding-top: 20px;
            z-index: 1;
            overflow-y: auto; 
        }
        .sidebar a {
            display: block;
            padding: 10px;
            color: #fff;
            text-decoration: none;
        }
        .sidebar a:hover {
            background-color: #495057;
        }
        .content {
            margin-left: 250px;
            padding: 20px;
            margin-top: 100px; 
            margin-bottom: 20px; 
            overflow-y: auto; 
            position: fixed; 
            top: 120px; 
            left: 0;
            right: 0;
            bottom: 0;
        }
        .back-button {
            padding: 10px 20px;
            border-radius: 5px;
            border: none;
            background-color: #28a745;
            color: #fff;
            cursor: pointer;
            font-size: 16px;
            display: inline-flex;
            align-items: center;
        }
        .back-button:hover {
            background-color: #218838;
        }
        .question-details {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .asked-by {
            text-align: right;
        }
        .answered-by {
            text-align: right;
            margin-top: 10px; 
        }
    </style>
</head>
<body>
    <header>
        <h1>Tech Q&A platform</h1>
    </header>

    <div class="taskbar">
        <a href="<?php echo site_url('dashboard'); ?>" class="button">Home</a>
        <a href="<?php echo site_url('dashboard/add_question'); ?>" class="button">Add Question</a>
        <a href="<?php echo site_url('profileController/index'); ?>" class="button">Profile</a>
        <a href="<?php echo site_url('aboutUs/index'); ?>" class="button">About Us</a>
    </div>

    <!-- Sidebar -->
    <div class="sidebar">
        <a href="<?php echo site_url('dashboard'); ?>">Dashboard</a>
        <a href="<?php echo site_url('dashboard/questions'); ?>">All Questions</a>
        <a href="<?php echo site_url('tag/list_tags'); ?>">All Tags</a>
        <a href="<?php echo site_url('savedQuestions/index'); ?>">Saved Questions</a>
        <a href="<?php echo site_url('auth/logout'); ?>">Logout</a>
    </div>

    <!-- Page content -->
    <div class="content">
        <div class="container">
            <!-- Display Question Details with Save Button -->
            <div class="question-details">
                <h2>
                    <?php echo $question['title']; ?>
                    <a href="<?php echo site_url('SavedQuestions/save/' . $question['question_id']); ?>" class="save-button">
                        <img src="<?php echo base_url('assets/images/bookmark.png'); ?>" alt="Save" class="bookmark-icon">
                    </a>
                </h2>
                <span class="asked-by">Asked by: <?php echo isset($question['username']) ? $question['username'] : 'Unknown'; ?></span>
            </div>
            <p><?php echo $question['content']; ?></p>

            <!-- Display Answers -->
            <h3>Answers:</h3>
            <ul>
                <?php foreach ($answers as $answer): ?>
                    <div class="answer">
                        <p><?php echo $answer['content']; ?></p>
                        <div class="answered-by">
                            <p>Answered by: <?php echo isset($answer['username']) ? $answer['username'] : 'Unknown'; ?></p>
                        </div>
                        <!-- Vote buttons -->
                        <div class="vote-buttons">
                            <!-- Upvote button -->
                            <a href="<?php echo site_url('question/upvote_answer/' . $answer['answer_id'] . '/' . $answer['question_id']); ?>">
                                <img src="<?php echo base_url('assets/images/like.png'); ?>" alt="Upvote" class="upvote-icon">
                                Upvote
                                <span class="vote-count">
                                    <?php 
                                        // Calculate upvote count dynamically
                                        $upvote_count = $this->db->where([
                                            'answer_id' => $answer['answer_id'],
                                            'vote_type' => 'upvote'
                                        ])->count_all_results('votes');
                                        echo $upvote_count;
                                    ?>
                                </span>
                            </a>
                            <!-- Downvote button -->
                            <a href="<?php echo site_url('question/downvote_answer/' . $answer['answer_id'] . '/' . $answer['question_id']); ?>">
                                <img src="<?php echo base_url('assets/images/dislike.png'); ?>" alt="Downvote" class="downvote-icon">
                                Downvote
                                <span class="vote-count">
                                    <?php 
                                        // Calculate downvote count dynamically
                                        $downvote_count = $this->db->where([
                                            'answer_id' => $answer['answer_id'],
                                            'vote_type' => 'downvote'
                                        ])->count_all_results('votes');
                                        echo $downvote_count;
                                    ?>
                                </span>
                            </a>
                        </div>
                    </div>
                <?php endforeach;?>
            </ul>

            <!-- Form for Submitting Answers -->
            <div class="submit-answer-form">
                <form method="post" action="<?php echo site_url('question/submit_answer/' . $question['question_id']); ?>">
                    <textarea name="answer_content" required placeholder="Your Answer"></textarea>
                    <br>
                    <button type="submit">Submit Answer</button>
                </form>
            </div>
            <button class="back-button" onclick="window.history.back()">Back</button>
        </div>
    </div>
</body>
</html>
