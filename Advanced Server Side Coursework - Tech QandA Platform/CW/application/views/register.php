<!DOCTYPE html>
<html>
<head>
    <title>User Registration</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #000036;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .registration-container {
            background-color: #ffffff;
            border-radius: 10px;
            padding: 30px;
            box-shadow: 0px 10px 20px rgba(0,0,0,0.1);
            width: 350px;
            color: #000036;
        }
        .registration-container h2 {
            text-align: center;
            margin-bottom: 30px;
            color: #000036;
        }
        .form-group {
            margin-bottom: 20px;
        }
        label {
            display: block;
            margin-bottom: 8px;
            color: #000036;
        }
        input[type="text"],
        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 12px;
            border-radius: 6px;
            border: 1px solid #ccc;
            box-sizing: border-box;
            color: #000036;
        }
        button {
            width: 100%;
            padding: 12px;
            border: none;
            background-color: #0070b8;
            color: #fff;
            border-radius: 6px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        button:hover {
            background-color: #005c91;
        }
        .error {
            color: red;
            margin-bottom: 10px;
        }

        .login-link {
            margin-top: 12px;
        }
    </style>
</head>
<body>
    <div class="registration-container">
        <h2>User Registration</h2>
        <?php echo validation_errors('<div class="error">', '</div>'); ?>
        <?php echo form_open('auth/register'); ?>
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" name="username" value="<?php echo set_value('username'); ?>">
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" value="<?php echo set_value('email'); ?>">
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password">
            </div>
            <button type="submit">Register</button>
        <?php echo form_close(); ?>
        <div class="login-link">
            Already have an account? <a href="http://localhost/CW/index.php/Auth/login">Log in</a>
        </div>
    </div>
</body>
</html>
