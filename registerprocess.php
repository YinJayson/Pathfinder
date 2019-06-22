<?php
    session_start();
    if (!empty($_POST['first_name']) &&
        !empty($_POST['last_name']) &&
        !empty($_POST['username']) &&
        !empty($_POST['email']) &&
        !empty($_POST['password'])) {
        $hash = password_hash($_POST['password'], PASSWORD_BCRYPT);
        $conn = "mysql:host=127.0.0.1;port=3306;dbname=meatlab";
        try {
            $db = new PDO($conn, "root", "", [
                PDO::ATTR_PERSISTENT => true
                ]);
            $statement = $db->prepare("INSERT INTO users (first_name, last_name, username, email, password) VALUES (?,?,?,?,?)");
            if ($statement->execute([$_POST['first_name'], $_POST['last_name'], $_POST['username'], $_POST['email'], $hash])) {
                $_SESSION['SUCCESS_MESSAGE'] = 'Congratulations, '.$_POST['username'].'. You have successfully created a new account.';
                $_SESSION['ID'] = $_POST['username'];
                // This has to match to an actual file location on your server
                header('Location: http://localhost:8080/pathfinder/landing.php');
            }
        } catch (PDOException $e) {
            $_SESSION['ERROR'] = 'Failed to create a new account!';
            // This has to match to an actual file location on your server
            header('Location: http://localhost:8080/pathfinder/register.php');
        }
    }
    else
    {
        $_SESSION['ERROR'] = "Please complete the form.";
        header('Location: http://localhost:8080/pathfinder/register.php');
    }
?>