<?php
 require_once "conn.php";

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
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Nazwa pojazdu</title>
    
    <link rel="stylesheet" href="../style/add.css">
    
    <script src="../js/jquery.js"></script>

</head>
<body>
    <header>
        <img id="logo" src="../img/logo.svg">
        <span>AutoBook</span>
        <img id="profile" src="../img/profile.svg">
    </header>
    <div id="main">
        <div id="service_list_element">
            <div id="search_button"><img src="../img/lupa.svg" width="30px"></div>
            <input type="text" id="search_text">
            <div id="search_filter">Filtr</div>
            <div id="service_table">
                <div id="table_header">
                    <div id="table_header_date">Data</div>
                    <div id="table_header_mileage">Przebieg</div>
                    <div id="table_header_description">Opis</div>
                </div>
                <div class="row">
                    <div id="date">10-05-2019</div>
                    <div id="mileage">56.490</div>
                    <div id="description">Przykład</div>
                </div>
                <?php 
                     $connection = @new mysqli($host, $db_user, $db_pass, $db_name);
                            
                     if($connection->connect_errno!=0)//connect error id: 0 - everything fine, >0 - something went wrong
                     {
                         echo "ERROR: ".$connection->connect_errno." Description: ".$connection->connect_error;//Show error number in browser. Disable 'Desccription' later
                     } else {
                         $vin = $_SESSION['vin'];
                         //echo $vin;
                         $sql_query_cars = "SELECT * FROM service WHERE vin='$vin'"; //Create query string
 
                         if($result = @$connection->query($sql_query_cars)) //Send query to database. If everything goes fine return value true and save data to result variable
                         {
                             $num_of_cars = $result->num_rows;//Number of rows = number of user in this case
                                     //echo $result;
                             if($num_of_cars > 0)//If user exists save data to new variable and close (delete) variable result
                             {
                                 while($row = $result->fetch_assoc())
                                 {
                                     echo "<div class='row'><div id='date'>".date_format(date_create($row['date']), "d-m-Y")."</div><div id='mileage'>".$row['mileage']."</div><div id='description'>".$row['description']."</div></div>";
                                 }
                                         
                                 $result->close();
                                 //$_SESSION['number_of_rows'] = $num_of_cars;
                                         
                                 //header('Location: main.php');//Open page
                             } else {
                                 echo "<div class='row' style='text-align: center;'>Samochód nie był jeszcze serwisowany w twoim warsztacie</div>";
                             }
                         }
 
                         $connection->close();
                     } 
                    
                ?>
            </div>
        </div>
        <form id="richer_description">
            <div class="description_button" id="new">Nowy</div>
            <div class="description_button" id="add">
                <img src="../img/addSign.svg" height="25px">
                <span id="list">
                    <div class="category">
                        <div class="sub_list">
                            <span>Spłuczki</span>
                            <span>Kanalizy</span>
                            <div class="category">
                                <div class="sub_list">
                                    <span>chuj</span>
                                    <span>penis</span>
                                    <div class="category">
                                        <div class="sub_list">
                                            <span>chuj</span>
                                            <span>penis</span>
                                            <div class="category">
                                                <div class="sub_list">
                                                    <span>chuj</span>
                                                    <span>penis</span>
                                                </div>
                                                <span>Niczego</span>
                                            </div>
                                        </div>
                                        <span>Niczego</span>
                                    </div>
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
                </span>
            </div>
            <div id="table_header">
                <input type="date" id="date_input">
                <div id="passive_date">26-10-2020</div>
                <span>Przebieg</span>
                <input type="number" id="mileage_input">
                <div id="passive_mileage">100.500.540</div>
                <span>km</span>
            </div>
            <textarea></textarea>
            <div id="passive_textarea">AAAAAAAAAAAAA kurwaaaaaa</div>
            <div class="description_button" id="edit">Edytuj</div>
            <div class="description_button" id="save">Zapisz</div>
        </div>
    </form>
    <footer>
        <span>Tomasz Kaczmarek & Aleksander Słojewski 2021 &copy;</span>
    </footer>
    <script type ="text/javascript" src="../js/add_scripts.js"></script>
</body>
</html>