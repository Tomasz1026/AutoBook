<?php
    if(isset($_POST['email']) && isset( $_POST['password']))
    {
        session_start();

        require_once "conn.php";//If this file doesn't exist, server stops executing this php file and throw error

        $connection = new mysqli($host, $db_user, $db_pass, $db_name);//Connection with database. Need data from conn.php

        if($connection->connect_errno!=0)//connect error id: 0 - everything fine, >0 - something went wrong
        {
            echo "ERROR: ".$connection->connect_errno." Description: ".$connection->connect_error;//Show error number in browser. Disable 'Description' later
        } else {
            $email = $_POST['email'];
            $password = $_POST['password'];

            $email = htmlentities($email, ENT_QUOTES, "UTF-8");
            $password = htmlentities($password, ENT_QUOTES, "UTF-8");

            //$sql_query_login = "SELECT * FROM users WHERE email='$email' AND password='$password'";//Create query string

            if($result = @$connection->query(
                sprintf("SELECT * FROM users WHERE email='%s' AND password='%s'",
                mysqli_real_escape_string($connection, $email),
                mysqli_real_escape_string($connection, $password))))//Send query to database. If everything goes fine return value true and save data to result variable
            {
                $num_of_usr = $result->num_rows;//Number of rows = number of user in this case

                if($num_of_usr > 0)//If user exists save data to new variable and close (delete) variable result
                {
                    $row = $result->fetch_assoc();
                    
                    $result->free_result();
                    
                    unset($_SESSION['login_error']);//Delete variable from SESSION
                    
                    $_SESSION['user_logged'] = true;
                    $_SESSION['name'] = $row['name'];
                    $_SESSION['menu'] = $row['preference'];
                    $_SESSION['id'] = $row['id'];
                    //$id = $row['id'];
                    
                   // $_SESSION['cartable_query'] = "SELECT * FROM car WHERE client_id=$id LIMIT 10 OFFSET 0";
                    
                    

                    header('Location: ../cartable.php?error=1');//Open page
                } else {
                    //Throw error when login or/and password are wrong or doesn't exist;
                    $_SESSION['login_error'] = "<br><span style='color: red; font-size:15px'>Nieprawidłowe dane logowania</span>";
                    header('Location: ../index.php');
                }
            }

            $connection->close();
        }
    } else {
        header('Location: ../index.php');
    }
?>