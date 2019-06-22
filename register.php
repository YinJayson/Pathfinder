<html>
    <head>
        <style>
            body {
                background-color: #333;
            }
            .color {
                background-color: #eee;
            }
            .center {
                margin: auto;
                width: 25%;
                border: 3px solid #eee;
                text-align: center;
                font-family: Arial, sans-serif;
                padding: 5rem;
            }
            a, button {
                background-color: red; /* Green */
                border: none;
                color: white;
                padding: .75rem .75rem;
                text-align: center;
                text-decoration: none;
                display: inline-block;
                font-size: 1rem;
            }
        </style>
    </head>
    <body>
        <div class="center color">
            <?php 
            session_start();
                if (isset($_SESSION['ERROR'])) {
                    echo '<div>'.$_SESSION['ERROR'].'</div>';
                    unset($_SESSION['ERROR']);
                }
                if (isset($_SESSION['LOG_OUT'])) {
                    echo '<div><strong>'.$_SESSION['LOG_OUT'].'</strong></div></br>';
                    unset($_SESSION['LOG_OUT']);
                }
            ?>
            <strong>Registration!</strong><br><br>
            <form action="./registerprocess.php" method="post">
            <strong>First Name:</strong> <input type="text" name="first_name"><br><br>
                <strong>Last Name:</strong> <input type="text" name="last_name"><br><br>
                <strong>Username:</strong> <input type="text" name="username"><br><br>
                <strong>E-mail:</strong> <input type="text" name="email"><br><br>
                <strong>Password:</strong> <input type="password" name="password"><br><br>
                <a href="./login.php">Go to Login</a>
                <button type="submit">Register</button>
            </form>
        </div>
    </body>
</html>