<?php
 require_once "data_base_connections/conn.php";

    session_start();
    if(!isset($_SESSION['user_logged']))
    {
        header("Location: index.php");
        exit();
    } else if(!isset($_SESSION['car_id'])) {
        header("Location: cartable.php");
        exit();
    }
?>

<div id="search_button"><img src="../img/lupa.svg" width="30px"></div>
            <input type="text" id="search_text">
            <div id="search_filter">Filtr</div>
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
                        $car_id = $_SESSION['car_id'];

                        $sql_query_cars = "SELECT * FROM service WHERE car_id='$car_id'"; //Create query string
                        
                        if($result = @$connection->query($sql_query_cars)) //Send query to database. If everything goes fine return value true and save data to result variable
                        {
                            $num_of_cars = $result->num_rows;//Number of rows = number of user in this case
                                     
                            if($num_of_cars > 0)//If user exists save data to new variable and close (delete) variable result
                            {
                                while($row = $result->fetch_assoc())
                                {
                                     echo "<div class='row' id='".$row['id']."'><div id='date'>".date_format(date_create($row['date']), "d-m-Y")."</div><div id='mileage'>".$row['mileage']."</div><div id='short_desc'></div><div id='description'>".$row['description']."</div></div>";
                                }
                                   
                                $result->close();
                                //$_SESSION['number_of_rows'] = $num_of_cars;
                                         
                                //header('Location: main.php');//Open page
                            } else {
                                 echo "<div class='row' id='none' style='text-align: center;'>Samochód nie był jeszcze serwisowany w twoim warsztacie</div>";
                            }
                        }
 
                        $connection->close();
                    }
                ?>
            </div>
