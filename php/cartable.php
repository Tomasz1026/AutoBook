<?php
    require_once "data_base_connections/conn.php";

    session_start();
    if(!(isset($_SESSION['user_logged']) && $_SESSION['user_logged']==true))
    {
        header("Location: index.php");
        exit();
    }
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AutoBook - Samochody</title>
    <link rel="stylesheet" href="../style/cartable.css">

    <script src="../js/jquery.js"></script>

</head>
<body style="background: white;">
    <header>
        <img id="logo" src="../img/logo.svg">
        <span>AutoBook</span>
        <img class="profile" id="profile_image" src="../img/profile.svg" >
            
        
    </header>
    <span class="profile" id="list">
                        <div><span>Mój profil</span></div>
                        <div><span>Podsumowanie</span></div>
                        <div><span>Ustawienia</span></div>
                        <div onclick="location.href = 'data_base_connections/logout.php';"><span style="color: red;">Wyloguj</span></div>
                </span>
    <div id="spacing"></div>
    <div id="main" >
        <div id="service_list_element">
            <div class="description_button" id="add">Nowy</div>
            <div id="search_button"><img src="../img/lupa.svg" width="30px"></div>
            <input type="text" id="search_text">
            <div id="search_filter">Filtr</div>
            <div id="service_table">
                <div id="table_header">
                    <div id="table_header_make">Marka</div>
                    <div id="table_header_model">Model</div>
                    <div id="table_header_gen">Generacja</div>
                    <div id="table_header_vin">VIN</div>
                    <div id="table_header_rej">Rejestracja</div>
                    <div id="table_header_year">Rok</div>
                </div>
                <?php 
                    $connection = @new mysqli($host, $db_user, $db_pass, $db_name);
                            
                    if($connection->connect_errno!=0)//connect error id: 0 - everything fine, >0 - something went wrong
                    {
                        echo "ERROR: ".$connection->connect_errno." Description: ".$connection->connect_error;//Show error number in browser. Disable 'Desccription' later
                    } else {
                        $id = $_SESSION['id'];
                        $sql_query_cars = "SELECT * FROM car WHERE client_id=$id"; //Create query string

                        if($result = @$connection->query($sql_query_cars)) //Send query to database. If everything goes fine return value true and save data to result variable
                        {
                            $num_of_cars = $result->num_rows;//Number of rows = number of user in this case
                                    
                            if($num_of_cars > 0)//If user exists save data to new variable and close (delete) variable result
                            {
                                while($row = $result->fetch_assoc())
                                {
                                    echo "<div class='row'><div id='make'>".$row['mark']."</div><div id='model'>".$row['model']."</div><div id='gen'>".$row['generation']."</div><div id='vin'>".$row['vin']."</div><div id='reg'>".$row['registration']."</div><div id='year'>".$row['year']."</div></div>";
                                }
                                        
                                $result->close();
                                //$_SESSION['number_of_rows'] = $num_of_cars;
                                        
                                //header('Location: main.php');//Open page
                            } else {
                                echo "<div class='row' style='text-align: center;'>Nie ma jeszcze żadnych pojazdów w twoim warsztacie</div>";
                            }
                        }
                        $connection->close();
                    }      
                ?>
        </div>
    </div>
</div>
    <footer>
        <span>Tomasz Kaczmarek & Aleksander Słojewski 2021 &copy;</span>
    </footer>
    <form action="data_base_connections/services.php" method="post" id="hidden_form">
    <input type="text" name="vin">
    <input type="submit">
    </form>
    <script src="../js/cartable_script.js"></script>
</body>
</html>