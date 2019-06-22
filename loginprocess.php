<?php
    session_start();
    if (!empty($_POST['username'] && !empty($_POST['password']))) {
        $hash = password_hash($_POST['password'], PASSWORD_BCRYPT);
        $conn = "mysql:host=127.0.0.1;port=3306;dbname=meatlab";
        try{
            $db = new PDO($conn, "root", "", [
                PDO::ATTR_PERSISTENT => true
                ]);
            $username = $_POST['username'];
            $statement = $db->prepare("SELECT * FROM `users` WHERE username = '$username'");
            $statement->execute();
            $result = $statement->fetchAll(PDO::FETCH_OBJ);
            foreach ($result as $user) {
                if($user->username == $_POST['username'] && password_verify($_POST['password'], $user->password)) {
                    $_SESSION['ID'] = $_POST['username'];
                    $_SESSION['SUCCESS_MESSAGE'] = "Successfully logged in as " + $_SESSION['ID'] + "!";
                    header('Location: http://localhost:8080/pathfinder/landing.php');
                    }
                else
                {
                    $_SESSION['ERROR'] = 'Failed to login!';
                    header('Location: http://localhost:8080/pathfinder/login.php');
                }
            }
        } catch (PDOException $e) {
            echo 'Something went wrong in the login process';
        }
        $db = null;
    }
    else
    {
        $_SESSION['ERROR'] = "Please complete the form.";
        header('Location: http://localhost:8080/pathfinder/login.php');
    }
?>