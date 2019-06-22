<?php
    if (!empty($_POST)) {
        session_start();
        $conn = "mysql:host=127.0.0.1;port=3306;dbname=meatlab";
        try {
            $db = new PDO($conn, "root", "", [
                PDO::ATTR_PERSISTENT => true
                ]);
            $statement = $db->prepare("INSERT INTO posts (poster_name, title, body) VALUES (?,?,?)");
            if ($statement->execute([$_SESSION['ID'], $_POST['title'], $_POST['body']])) {
                $_SESSION['SUCCESS_MESSAGE'] = 'Congratulations, ' + $_SESSION['ID'] + '. You have successfully made a post.';
                // This has to match to an actual file location on your server
                header('Location: http://localhost:8080/pathfinder/landing.php');
            }
        } catch (PDOException $e) {
            $_SESSION['ERROR'] = 'Failed to create a post!';
            // This has to match to an actual file location on your server
            header('Location: http://localhost:8080/pathfinder/landing.php');
        }
    }
?>