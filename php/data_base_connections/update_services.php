<?php

session_start();

if(isset($_POST['date']) && isset($_POST['mileage']) && isset($_POST['description']) && isset($_POST['id']))
{
    require_once "conn.php";//If this file doesn't exist, server stops executing this php file and throw error

    $connection = new mysqli($host, $db_user, $db_pass, $db_name);//Connection with database. Need data from conn.php

    if($connection->connect_errno!=0)//connect error id: 0 - everything fine, >0 - something went wrong
    {
        $_SESSION['error_alert'] = "Błąd ID ".$connection->connect_errno." Opis: ".$connection->connect_error;
        //echo "ERROR: ".$connection->connect_errno." Description: ".$connection->connect_error;//Show error number in browser. Disable 'Description' later
    } else {
        $date = $_POST['date'];
        $mileage = $_POST['mileage'];
        $description = $_POST['description'];
        $description = htmlentities($description, ENT_QUOTES, "UTF-8");
        $id = $_POST['id'];

        //$sql_query_login = "UPDATE service SET date='$date', mileage='$mileage', description='$description' WHERE id=$id";//Create update query string

        if(@$connection->query(
            sprintf("UPDATE service SET date='%s', mileage='%s', description='%s' WHERE id='%s'",
            mysqli_real_escape_string($connection, $date),
            mysqli_real_escape_string($connection, $mileage),
            mysqli_real_escape_string($connection, $description),
            mysqli_real_escape_string($connection, $id)))) //Send update query to database. If everything goes fine return value true
        {
            $_SESSION['data_base_update'] = "";//Show some sort of alert "Aktualizacja bazy danych zakończyła się sukcesem"
            
        } else {
            
            $_SESSION['data_base_update'] = "<br><span style='color: red; font-size:15px'>Nieprawidłowe dane logowania</span>";
            //Show some sort of alert "Aktualizacja bazy danych zakończyła się byciem smutną i zjebaną bazą danych, ja jebie jak można być bazą danych, ja tego nie rozumiem >:("
        }
        
        $connection->close();
        
        header('Location: ../add.php');
    }
} else {
    echo $_POST['date'].", ".$_POST['mileage'].", ".$_POST['description'];
}
?>