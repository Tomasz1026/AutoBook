<?php

session_start();

if(isset($_POST['mark']) && isset($_POST['model']) && isset($_POST['gen']) && isset($_POST['vin']) && isset($_POST['rej']))
{
    require_once "conn.php";//If this file doesn't exist, server stops executing this php file and throw error

    $connection = new mysqli($host, $db_user, $db_pass, $db_name);//Connection with database. Need data from conn.php

    if($connection->connect_errno!=0)//connect error id: 0 - everything fine, >0 - something went wrong
    {
        echo "ERROR: ".$connection->connect_errno." Description: ".$connection->connect_error;//Show error number in browser. Disable 'Description' later
    } else {
        $mark = $_POST['mark'];
        $model = $_POST['model'];
        $gen = $_POST['gen'];
        $vin = $_POST['vin'];
        $rej = $_POST['rej'];
        $year = $_POST['year'];
        $id = $_SESSION['id'];
        

              $_SESSION['register_error'] = "";
              $sql_query_login = "INSERT INTO car (`id`, `client_id`, `mark`, `model`, `generation`, `vin`, `registration`, `year`) VALUES (NULL, '$id', '$mark', '$model', '$gen', '$vin', '$rej', '$year')"; //wstawia nowego carsa do db
        if(@$connection->query($sql_query_login)) //Send update query to database. If everything goes fine return value true
        {
            $_SESSION['data_base_update'] = "";//Show some sort of alert "Aktualizacja bazy danych zakończyła się sukcesem" 
        } else {
            
            $_SESSION['data_base_update'] = "<br><span style='color: red; font-size:15px'>Nieprawidłowe dane logowania</span>";
            //Show smoe sort of alert "Aktualizacja bazy danych zakończyła się byciem smutną i zjebaną bazą danych, ja jebie jak można być bazą danych, ja tego nie rozumiem >:("
        }
        
        $connection->close();
        
        header('Location: ../new_car.php');
    }
} else {
    echo $_POST['mark'].", ".$_POST['model'].", ".$_POST['gen'].", ".$_POST['vin'].", ".$_POST['rej'];
}
?>