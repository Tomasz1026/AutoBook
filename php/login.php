<?php

    session_start();

    require_once "conn.php";//If this file doesn't exist, server stops executing this php file and throw error

    $connection = new mysqli($host, $db_user, $db_pass, $db_name);//Connection with database. Need data from conn.php

    if($connection->connect_errno!=0)//connect error id: 0 - everything fine, >0 - something went wrong
    {
        echo "ERROR: ".$connection->connect_errno." Description: ".$connection->connect_error;//Show error number in browser. Disable 'Desccription' later
    } else {
        $login = "maciej@tonn.com";//$_POST['login'];
        $password = "arbuzy123";//$_POST['password'];

        $sql_query = "SELECT * FROM uzytkownicy WHERE email='$login' AND password='$password'";//Create query string

        if($result = @$connection->query($sql_query)) //Send query to database. If everything goes fine return value true and save data to result variable
        {
            $num_of_usr = $result->num_rows;//Number of rows = number of user in this case

            if($num_of_usr > 0)//If user exists save data to new variable and close (delete) variable result
            {
                $row = $result->fetch_assoc();
                
                $result->close();
                
                $_SESSION['login'] = $row['login'];
                $_SESSION['name'] = $row['name'];
                $_SESSION['pass'] = $row['password'];
                

                //header('Location: main.php');
            } else {
                //Throw error when login or/and password are wrong or doesn't exist;
                $_SESSION['login_error'] = "<span style='color: red'>Nieprawidłowe dane logowania</span>";
                header('Location: index.php');
            }
        }

        $connection->close();
    }


?>