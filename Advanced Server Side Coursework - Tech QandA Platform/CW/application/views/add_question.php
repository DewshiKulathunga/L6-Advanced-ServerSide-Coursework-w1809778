<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Question</title>
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
            max-width: 800px;
            margin: auto;
            padding: 20px;
            margin-top: 15px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        form {
            margin-bottom: 20px;
        }
        input[type="text"],
        textarea {
            padding: 10px;
            width: 100%;
            border-radius: 5px;
            border: 1px solid #ccc;
            margin-bottom: 10px;
            font-size: 16px;
            box-sizing: border-box; 
        }
        button[type="submit"] {
            padding: 10px 20px;
            border-radius: 5px;
            border: none;
            background-color: #28a745;
            color: #fff;
            cursor: pointer;
            font-size: 16px;
            float: right; 
        }
        button[type="submit"]:hover {
            background-color: #218838;
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
            margin-top: 10px; 
        }
        .back-button:hover {
            background-color: #218838;
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
            <h2>Add Question</h2>
            <form action="<?php echo site_url('dashboard/save_question'); ?>" method="post">
                <label for="title">Title:</label><br>
                <input type="text" id="title" name="title" required><br>
                <label for="content">Content:</label><br>
                <textarea id="content" name="content" required></textarea><br>
                <label for="tags">Tags:</label>
                <input type="text" name="tags" required><br>
                <button type="submit">Submit</button>
            </form>
            <button class="back-button" onclick="window.history.back()">Back</button>
        </div>
    </div>
</body>
</html>
