<?php 
    
    if(isset($_POST['car_id']))
    {
        session_start();

        $_SESSION['car_id'] = $_POST["car_id"];
    
        header('Location: ../add.php');
    } else {
        header('Location: ../cartable.php');
    }
   
?>