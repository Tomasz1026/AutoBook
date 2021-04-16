<?php
    require_once "data_base_connections/conn.php";

    session_start();
    if(empty($_SESSION['user_logged']))
    {
        header("Location: index.php");
        exit();
    } else if(!empty($_SESSION['car_id'])) {
        unset($_SESSION['car_id']);
    }
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/cartable1.css">
    <script src="../js/jquery.js"></script>
    <title>AutoBook - Samochody</title>
</head>
<body>
    <header>
        <img id="logo" src="../img/logo.svg">
        <span>AutoBook</span>
        <img class="profile" id="profile_image" src="../img/profile.svg" >
        <span class="profile" id="list">
            <div><span>Mój profil</span></div>
            <hr></hr>
            <div><span>Podsumowanie</span></div>
            <hr></hr>
            <div><span>Ustawienia</span></div>
            <hr></hr>
            <div onclick="location.href='data_base_connections/logout.php';"><span style="color: red;">Wyloguj</span></div>
        </span>
    </header>
    <div id="spacing"></div>
    <div id="main">
        <form id="service_list_element" action='cartable.php' method='get' onsubmit="test()">
            <div class="description_button" id="add">Nowy</div>
            <div id="search_button"><img src="../img/lupa.svg" width="30px"></div>
            <?php
                echo "<input type='text' name='search_text' id='search_text' value=";
                
                $search_query = "";
                $filter_elements = [];

                $filter_array = array('mark' => array("Marka", "car.mark "),
                'model' => array("Model", "car.model "),
                'gen' => array("Generacja", "car.generation "),
                'vin' => array("VIN", "car.vin "),
                'reg' => array("Rejestracja", "car.registration "),
                'year' => array("Rok", "car.year "),
                'last' => array("Ostatni serwis", "(SELECT service.date FROM service WHERE car.id=service.car_id LIMIT 1) "));

                $new_array = "";

                if(isset($_GET['search_text']) && strlen($_GET['search_text'])>0) {
                    echo htmlentities($_GET['search_text'], ENT_QUOTES, "UTF-8");

                    $search_query = " AND (";

                    if(!empty($_GET['filter'])) {
                      
                        $filter_elements = explode(".", $_GET['filter']);

                        //echo implode('.',$filter_elements);

                        //echo implode('/',array_diff_assoc($filter_elements, $filter_array));

                        foreach($filter_elements as $index => $index_value) {
                            if(!array_key_exists($index_value, $filter_array)) {
                                header("Location: cartable.php?page=1&sort_by=last&sort_type=DESC");
                                exit();
                            }

                            $search_query .= $filter_array[$index_value][1]."LIKE '%".$_GET['search_text']."%'";
                            
                            if($index != count($filter_elements)-1) {
                                $search_query .= " OR ";
                            }

                            $new_array .= $index_value.".";
                        }
                        
                    } else {
                        foreach($filter_array as $index => $index_value) {
                            $search_query .= $index_value[1]."LIKE '%".$_GET['search_text']."%'";
                            
                            if($index != "last") {
                                $search_query .= " OR ";
                            }
                        }
                    }

                    $search_query .= ")";
                }else if (!empty($_GET['filter'])) {
                    header("Location: cartable.php?page=1&sort_by=last&sort_type=DESC");
                    exit();
                }
                
                echo ">";
            ?>
            <div id="search_filter">Filtry</div>
            <span class="filter" id='list'>
                <?php
                    foreach($filter_array as $index => $index_value) {
                        echo "<span name=".$index.">".$index_value[0];

                        if(array_search($index, $filter_elements) != "") {
                            echo "<img src='../img/check.svg' style='margin-left: 10px;' height='10px'>";
                        }
                        echo "</span><hr></hr>";
                    }

                    echo "<span id='filter_accept'>Zastosuj filtry</span>";
                ?>
            </span>
            <div id="service_table">
                <div id='table_header'>
                    <?php

                        if(!empty($_GET['sort_by']) && !empty($_GET['sort_type'])) {
                            if((!array_key_exists($_GET['sort_by'], $filter_array)) || ($_GET['sort_type'] != "DESC" && $_GET['sort_type'] != "ASC")) {
                                header("Location: cartable.php?page=1&sort_by=last&sort_type=DESC");
                                exit();
                            }
                        } else {
                            header("Location: cartable.php?page=1&sort_by=last&sort_type=DESC");
                            exit();
                        }
                        
                        foreach($filter_array as $x => $x_value) {
                            echo "<div id='table_header_$x' name='$x'>".$x_value[0];
                                
                            if($x == $_GET['sort_by']) {
                                $sorting = $filter_array[$_GET['sort_by']][1];
                                if($_GET['sort_type'] == "DESC") {
                                    echo "<img class='down' src='../img/arrow.svg'>";
                                } else {
                                    echo "<img class='up' src='../img/arrow.svg'>";
                                }
                                $sorting .= $_GET['sort_type'];
                            }
                            echo "</div>";
                        }
                    ?>
                </div>
                <?php
                    $connection = @new mysqli($host, $db_user, $db_pass, $db_name);

                    if($connection->connect_errno!=0) {//connect error id: 0 - everything fine, >0 - something went wrong
                        //echo "ERROR: ".$connection->connect_errno." Description: ".$connection->connect_error;//Show error number in browser. Disable 'Desccription' later
                        $_SESSION['error_alert'] = "Błąd ID ".$connection->connect_errno." Opis: ".$connection->connect_error;
                    } else {

                        $user_id = $_SESSION['id'];

                        if($result = @$connection->query("SELECT COUNT(id) AS number_of_pages FROM car WHERE client_id=".$user_id.$search_query)) {
                            //echo "d";
                            $num = $result->fetch_assoc();
                            $num = ceil($num['number_of_pages']/10);
                            $result->free_result();
                        } else {
                            $num = 1;
                        }

                        if($num == 0) {
                            $num = 1;
                        }
                        //echo $search_query."<br><br>";
                        $sorting = htmlentities($sorting, ENT_QUOTES, "UTF-8");
                        //echo $_GET['filter'];
                        if(isset($_GET['page'])) {
                            $active_page = $_GET['page'];
                            if($active_page < 1) {header("Location: cartable.php?page=1&sort_by=last&sort_type=DESC");}
                            else if($active_page > $num) {header('Location: cartable.php?page='.$num.'&sort_by=last&sort_type=DESC');}
                            $page_number = 10 * ($active_page-1);
                            //$page_number = htmlentities($page_number, ENT_QUOTES, "UTF-8");

                            $sql_query_cars = sprintf("SELECT car.*,(SELECT service.date FROM service WHERE car.id=service.car_id LIMIT 1) AS date FROM car WHERE car.client_id=%s %s ORDER BY %s LIMIT 10 OFFSET %s",  $user_id, $search_query, $sorting, $page_number);
                        } else {
                            $active_page = 1;
                            //$page_number = htmlentities($page_number, ENT_QUOTES, "UTF-8");

                            $sql_query_cars = sprintf("SELECT car.*,(SELECT service.date FROM service WHERE car.id=service.car_id LIMIT 1) AS date FROM car WHERE car.client_id=%s %s ORDER BY %s LIMIT 10 OFFSET 0", $user_id, $search_query, $sorting);
                        }
                        //echo $sql_query_cars;

                        if($result = $connection->query($sql_query_cars)) //Send query to database. If everything goes fine return value true and save data to result variable
                        {
                            //echo "a";
                            $num_of_cars = $result->num_rows;//Number of rows = number of user in this case

                            if($num_of_cars > 0)//If user exists save data to new variable and close (delete) variable result
                            {
                                while($row = $result->fetch_assoc())
                                {
                                    echo "<div class='row' id=".$row['id']."><div id='mark'>".$row['mark']."</div><div id='model'>".$row['model']."</div><div id='gen'>".$row['generation']."</div><div id='vin'>".$row['vin']."</div><div id='reg'>".$row['registration']."</div><div id='year'>".$row['year']."</div><div id='last'>".$row['date']."</div></div>";
                                }
                                
                                $result->free_result();

                            } else {
                                echo "<div class='row' style='text-align: center;'>Nie ma jeszcze żadnych pojazdów w twoim warsztacie</div>";
                            }
                        }
                ?>
            </div>
            <div id="page_count">
            <?php 
                 
                if($active_page > 1) {
                    echo "<img class='arrow' id='left' src='../img/arrow.svg'>";
                } else {
                    echo "<img id='left'>";
                }
               
                echo '<input name="page" type="number" min=1 max='.$num.' value='.$active_page.' required> z <span>'.$num.'</span>';
                
                if($active_page < $num) {
                    echo "<img class='arrow' id='right' src='../img/arrow.svg'>";
                } else {
                    echo "<img id='right'>";
                }
                 
                $connection->close();
                
                $new_array = substr($new_array, 0 , -1);

                echo '<input type="checkbox" name="sort_by" value='.$_GET['sort_by'].' checked>';
                echo '<input type="checkbox" name="sort_type" value='.$_GET['sort_type'].' checked>';
            
                echo '<input type="checkbox" name="filter" value="'.$new_array.'" checked>';
                echo '<input type="submit">';
            }
            ?>
            </div>
        </form>
    </div>
    </div>
    <form action="add.php" method="get" id="hidden_form">
        <input type="number" name="car_id">
        <input type="submit">
    </form>
    <?php
        if(isset($_SESSION['error_alert'])) {
            echo '<script>$("script").last().before("<div id=error_alert><div><span onclick='."$('#error_alert').remove();".'>&times;</span><p>'.$_SESSION['error_alert'].'</p></div></div>")</script>';
            unset($_SESSION['error_alert']);
        }
    ?>
    <script src="../js/cartable_script.js"></script>
    <footer>
        <span>Tomasz Kaczmarek & Aleksander Słojewski 2021 &copy;</span>
    </footer>
</body>
</html>