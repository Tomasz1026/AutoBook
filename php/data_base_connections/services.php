<?php 
    
    if(isset($_POST['vin']))
    {
        session_start();


        $_SESSION['vin'] = $_POST["vin"];
    
        header('Location: ../add.php');
    } else {
        header('Location: ../index.php');
    }
   
?>