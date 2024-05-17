<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>User Login</title>
    <!-- Include Backbone.js library -->
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.5.2/jquery.min.js"></script>
    <script type="text/javascript" src="https://ajax.cdnjs.com/ajax/libs/underscore.js/1.1.4/underscore-min.js"></script>
    <script type="text/javascript" src="https://ajax.cdnjs.com/ajax/libs/backbone.js/0.3.3/backbone-min.js"></script>
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
        .login-container {
            background-color: #ffffff;
            border-radius: 8px;
            padding: 30px;
            box-shadow: 0px 10px 20px rgba(0,0,0,0.1);
            width: 350px;
            color: #000036;
        }
        .login-container h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #000036;
        }
        .login-container label {
            display: block;
            margin-bottom: 10px;
            color: #000036;
        }
        .login-container input[type="text"],
        .login-container input[type="password"] {
            width: calc(100% - 20px);
            padding: 12px;
            border-radius: 6px;
            border: 1px solid #ccc;
            box-sizing: border-box;
            margin-bottom: 15px;
            color: #000036;
        }
        .login-container button {
            width: 100%;
            padding: 12px;
            border: none;
            background-color: #0070b8;
            color: #fff;
            border-radius: 6px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        .login-container button:hover {
            background-color: #005c91;
        }

        .register-link {
            margin-top: 12px;
        }
        
        .error {
            color: red;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h2>User Login</h2>
        <div id="message" class="error"></div>
        <form id="loginForm">
            <label for="username">Username</label>
            <input type="text" class="form-style" placeholder="Username" id="username" name="username" required>
            
            <label for="password">Password</label>
            <input type="password" class="form-style" placeholder="Password" id="password" name="password" required>
            
            <button type="submit">Login</button>
        </form>
        <div class="register-link">
            Don't have an account? <?php echo anchor('auth/register', 'Register here'); ?>
        </div>
    </div>

    <script>
        var LoginModel = Backbone.Model.extend({
            defaults: {
                username: '',
                password: ''
            }
        });

        var LoginView = Backbone.View.extend({
            el: "#loginForm",
            events: {
                'submit': 'saveUser'
            },

            initialize: function(){
                this.model = new LoginModel();
            },

            saveUser: function(event){
                event.preventDefault();
                var username = this.$('#username').val();
                var password = this.$('#password').val();

                this.model.set({username: username, password: password});

                $.ajax({
                    url: 'http://localhost/CW/index.php/AuthRequest/login',
                    type: 'POST',
                    data: this.model.toJSON(),

                    success: function(response) {
                        console.log('Request successful');
                        window.location.href = 'http://localhost/CW/index.php/dashboard/index';
                    },
                    error: function(xhr, status, error) {
                        console.error('Error saving data:', error);
                        var message = 'Invalid Email or Password';
                        $('#message').text(message).css('color', 'red').show();
                    }
                });
            },
        });

        var loginView = new LoginView();
    </script>
</body>
</html>
