<?php
    session_start();

    unset($_SESSION['user_logged'], 
        $_SESSION['email'],
        $_SESSION['name'],
        $_SESSION['password'],
        $_SESSION['menu'],
        $_SESSION['id']
    );
    
    if(isset($_SESSION['car_id'])) 
    {
        unset($_SESSION['car_id']);
    }


    header("Location: ../index.php");
    exit();

?>