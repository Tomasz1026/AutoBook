<?php
require_once "data_base_connections/conn.php";

   session_start();
   if(!isset($_SESSION['user_logged']))
   {
       header("Location: index.php");
       exit();

   }
   if(isset($_SESSION['car_id']))
    {
        header("Location: cartable.php");
        exit();
    } 
?>


<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Nazwa pojazdu</title>
    
    <link rel="stylesheet" href="../style/new_car.css">
    
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
    <div id="service_list_elementt">
        <form id="select_car" action="data_base_connections/new_car.php" method="post">
            <div class="cancel_button" id="cancel">Anuluj</div><br><br>
            <div id="select_car">
            <label for="mark">Marka </label><br>
            <select name="mark"> 
            <option>Audi</option>
            <option >Lexus</option>
            <option >Mercedes</option>
            <option >Toyota</option>
            <option >Mitsubishi</option>
            </select></br>
            <label for="model">Model </label><br>
            <select name="model"> 
            <option>A4</option>
            <option >LS500</option>
            <option >Klasa C</option>
            <option >Yaris</option>
            <option >Lancer</option>
            </select></br>
            <label for="gen">Generacja </label><br>
            <select name="gen"> 
            <option>B8</option>
            <option >II</option>
            <option >W204</option>
            <option >II</option>
            <option >VIII</option>
            </select></br>
            <label for="vin">VIN </label><br>
            <input type="text" name="vin"></br>
            <label for="rej">Rejestracja </label><br>
            <input type="text" name="rej"></br>
            <label for="year">Rok </label><br>
            <select name="year"> 
            <option>2015</option>
            <option >2006</option>
            <option >2008</option>
            <option >2007</option>
            <option >2010</option>
            </select></br>
            <input type="submit" value="Dodaj">
           
        </form>
        </div>
        <form id="richer_descriptionn" action="data_base_connections/update_services.php" method="post">
            <div class="description_button" id="new">Nowy</div>
            <div class="description_button" id="add">
                <img src="../img/addSign.svg" height="25px">
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
            <div class="description_button" id="save">Zapisz</div>
            <input id="id" name="id" style="display: none;">
            <input id="submit_form" style="display: none;" type="submit">
        </form>
    </div>
    <footer>
        <span>Tomasz Kaczmarek & Aleksander Słojewski 2021 &copy;</span>
    </footer>
    <script type ="text/javascript" src="../js/add_scripts.js"></script>
</body>
</html>