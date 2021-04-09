<?php
 require_once "data_base_connections/conn.php";

    session_start();
    if(!isset($_SESSION['user_logged']))
    {
        header("Location: index.php");
        exit();

    }
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Nazwa pojazdu</title>
    
    <link rel="stylesheet" href="../style/add.css">
    
    <script src="../js/jquery.js"></script>
</head>
<body>
    <header>
        <img id="logo" src="../img/logo.svg">
        <span>AutoBook</span>
        <img id="profile_image" src="../img/profile.svg">
    </header>
    <span class="list" id="profile_list">
        <div><span>Mój profil</span></div>
        <div><span>Podsumowanie</span></div>
        <div><span>Ustawienia</span></div>
        <div onclick="location.href = 'data_base_connections/logout.php';">
            <span style="color: red;">Wyloguj</span>
        </div>
    </span>
    <div id="main">
        <div id="service_list_element">
        <div id="search_button">
            <img src="../img/lupa.svg" width="30px">
        </div>
            <input type="text" id="search_text">
            <div id="search_filter">Filtry</div>
            <div id="service_table">
                <div id="table_header">
                    <div id="table_header_date">Data</div>
                    <div id="table_header_mileage">Przebieg</div>
                    <div id="table_header_description">Opis</div>
                </div>
                <?php 
                    $connection = @new mysqli($host, $db_user, $db_pass, $db_name);
                            
                    if($connection->connect_errno!=0)//connect error id: 0 - everything fine, >0 - something went wrong
                    {
                        echo "ERROR: ".$connection->connect_errno." Description: ".$connection->connect_error;//Show error number in browser. Disable 'Desccription' later
                    } else {
                        $car_id = $_GET['car_id'];

                        $sql_query_car_exists = "SELECT id AS car_exists FROM car WHERE id='$car_id'";
                        $sql_query_cars = "SELECT * FROM service WHERE car_id='$car_id'"; //Create query string
                        
                        if($result_car_exists = @$connection->query($sql_query_car_exists)) //Send query to database. If everything goes fine return value true and save data to result variable
                        {

                            if($result_car_exists->num_rows > 0) 
                            {
                                $result_car_exists->free_result();
                                if($result = @$connection->query($sql_query_cars)) //Send query to database. If everything goes fine return value true and save data to result variable
                                {
                                    //echo $result;

                                   // $num_of_cars = $result->num_rows;//Number of rows = number of user in this case
                                            
                                    if($result->num_rows > 0)//If user exists save data to new variable and close (delete) variable result
                                    {
                                        while($row = $result->fetch_assoc())
                                        {
                                            echo "<div class='row' id='".$row['id']."'><div id='date'>".date_format(date_create($row['date']), "d-m-Y")."</div><div id='mileage'>".$row['mileage']."</div><div id='short_desc'></div><div id='description'>".$row['description']."</div></div>";
                                        }
                                       
                                        /*echo '<pre>';
                                            var_dump($_SESSION);
                                        echo '</pre>';*/
    
                                        $result->free_result();
                                        //$_SESSION['number_of_rows'] = $num_of_cars;
                                                
                                        //header('Location: main.php');//Open page
                                    } else {
                                        echo "<div class='row' id='none' style='text-align: center;'>Samochód nie był jeszcze serwisowany w twoim warsztacie</div>";
                                    }
                                }
                            } else {
                                //display error tab in cartable
                                header('Location: cartable.php');
                            }
                        } else {
                            header('Location: cartable.php');
                        }

                        $connection->close();
                    }
                ?>
            </div>

        </div>
        <form id="richer_description" action="data_base_connections/update_services.php" method="post">
            <div class="description_button" id="new">Nowy</div>
            <div class="description_button" id="add">
                <img src="../img/addSign.svg" height="25px">
                <!--
                <span class="list" id="add_text">
                <div class="category">
                    <div class="sub_list">
                        <span>Spłuczki</span>
                        <span>Kanalizy</span>
                        <div class="category">
                            <div class="sub_list">
                                <span>chuj</span>
                                <span>penis</span>
                            </div>
                            <span>Niczego</span>
                        </div>
                    </div>
                    <span>Wymiana</span>
                </div>
                <div class="category">
                    <div class="sub_list">
                        <span>Hamulców</span>
                        <span>Klocków hamulcowych</span>
                        <span>Wycieraczek</span>
                    </div>
                    <span>Naprawa</span>
                </div>
                <div class="category">sratatata</div>
                -->
                <?php
                     echo $_SESSION['menu']; //quick add-text to description menu
                ?>
            </div>
            <div id="table_header_2">
                <input name="date" type="date" id="date_input">
                <div id="passive_date"></div>
                <span>Przebieg</span>
                <input name="mileage" type="number" id="mileage_input">
                <div id="passive_mileage"></div>
                <span>km</span>
            </div>
            <textarea name="description"></textarea>
            <div id="passive_textarea"></div>
            <div class="description_button" id="edit">Edytuj</div>
            <div class="description_button" id="save">Zapisz</div>
            <input id="id" name="id" style="display: none;">
            <input id="submit_form" style="display: none;" type="submit">
        </form>
    </div>
    
    <footer>
        <span>Tomasz Kaczmarek & Aleksander Słojewski 2021 &copy;</span>
    </footer>
    <?php
        if(isset($_SESSION['error_alert'])) {
            echo '<script>$("script").last().before("<div id=error_alert><div><span onclick='."$('#error_alert').remove();".'>&times;</span><p>'.$_SESSION['error_alert'].'</p></div></div>")</script>';
            unset($_SESSION['error_alert']);
        }
    ?>
    <script type ="text/javascript" src="../js/add_scripts.js"></script>
</body>
</html>