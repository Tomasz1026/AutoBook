<?php
    session_start();

    $_SESSION['user_logged'] = false;

    header("Location: ../index.php");
    exit();

?>