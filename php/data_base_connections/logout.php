<?php
    session_start();

    require_once "conn.php";//If this file doesn't exist, server stops executing this php file and throw error

        $connection = new mysqli($host, $db_user, $db_pass, $db_name);//Connection with database. Need data from conn.php

        if($connection->connect_errno!=0)//connect error id: 0 - everything fine, >0 - something went wrong
        {
            $_SESSION['error_alert'] = "Błąd ID ".$connection->connect_errno." Opis: ".$connection->connect_error;
            //echo "ERROR: ".$connection->connect_errno." Description: ".$connection->connect_error;//Show error number in browser. Disable 'Description' later
        } else {

            $user_id = $_SESSION['id'];

            if(@$connection->query("UPDATE users SET last_login_date=NOW() WHERE id='$user_id'"))//Send query to database. If everything goes fine return value true and save data to result variable
            {
                
            } else {
                echo "error";
                //header('Location: ../index.php');   
            }

            $connection->close();
        }

    session_unset();
    session_destroy();

    header("Location: ../index.php");
    exit();

?>