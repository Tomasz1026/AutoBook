<?php 
    session_start();

    $_SESSION['vin'] = $_POST["vin"];

    header('Location: add.php');
   
?>