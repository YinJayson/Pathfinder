<?php
    session_start();
    $_SESSION['LOG_OUT'] = 'You have successfully logged out!';
    if(isset($_SESSION['ID']))
        unset($_SESSION['ID']);
    header('Location: http://localhost:8080/pathfinder/login.php');
?>