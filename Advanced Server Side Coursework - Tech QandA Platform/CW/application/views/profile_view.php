<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
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
            margin: 0px;
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
        ul {
            list-style-type: none;
            padding: 0;
        }
        li {
            background-color: #f9f9f9;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-bottom: 20px;
            padding-right: 60px; 
            padding: 20px;
            position: relative; 
            transition: box-shadow 0.3s ease;
        }
        li:hover {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        h2 {
            margin-top: 40px;
        }
        p {
            margin-top: 10px;
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
        .delete-button {
            padding: 10px 20px;
            border-radius: 5px;
            border: none;
            color: #fff;
            cursor: pointer;
            font-size: 16px;
            display: inline-flex;
            align-items: center;
            position: absolute; 
            top: 10px; 
            right: 10px; 
        }
        .delete-button {
            background-color: #dc3545;
        }
        .delete-button:hover {
            background-color: #c82333;
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
        .update-form {
            margin-top: 50px;
            margin-bottom: 30px;
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 20px;
            background-color: #f9f9f9;
        }
        .update-form label {
            display: block;
            margin-bottom: 10px;
            font-weight: bold;
        }
        .update-form input[type="text"],
        .update-form input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 3px;
            box-sizing: border-box;
        }
        .update-form button {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        .update-form button:hover {
            background-color: #0056b3;
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

            <h1>User Profile</h1>

            <h2>User Details</h2>
            <p>Username: <?php echo $user['username']; ?></p>
            <p>Email: <?php echo $user['email']; ?></p>

            <h2>Questions Posted</h2>
            <ul>
                <?php foreach ($questions as $question): ?>
                    <li>
                        <?php echo $question['title']; ?>
                        <a href="<?php echo site_url('profileController/deleteQuestion/'.$question['question_id']); ?>" class="delete-button">Delete</a>
                    </li>
                <?php endforeach; ?>
            </ul>

            <h2>Answers Posted</h2>
            <ul>
                <?php foreach ($answers as $answer): ?>
                    <li>
                        <?php echo $answer['content']; ?>
                        <a href="<?php echo site_url('profileController/deleteAnswer/'.$answer['answer_id']); ?>" class="delete-button">Delete</a>
                    </li>
                <?php endforeach; ?>
            </ul>
            

            <div class="update-form">
                <h2>Update Username and Password</h2>
                <form action="<?php echo site_url('profileController/updateUser'); ?>" method="post">
                    <label for="new_username">New Username:</label>
                    <input type="text" id="new_username" name="new_username" required>
                    <label for="new_password">New Password:</label>
                    <input type="password" id="new_password" name="new_password" required>
                    <button type="submit">Update</button>
                </form>
            </div>
            <button class="back-button" onclick="window.history.back()">Back</button>
        
        </div>
    </div>
</body>
</html>
