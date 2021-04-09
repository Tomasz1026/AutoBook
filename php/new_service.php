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
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/cartable.css">
    <script src="../js/jquery.js"></script>
    <title>AutoBook - Nowy</title>
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
    <div id="main">
        <?php 
            $connection = @new mysqli($host, $db_user, $db_pass, $db_name);
                            
            if($connection->connect_errno!=0)//connect error id: 0 - everything fine, >0 - something went wrong
            {
                echo "ERROR: ".$connection->connect_errno." Description: ".$connection->connect_error;//Show error number in browser. Disable 'Desccription' later
            } else {
                $user_id = $_SESSION['id'];
                $sql_query_marks = "SELECT id, title FROM make"; //Create query string
                //echo $_SESSION['cartable_query'];
                if($result = @$connection->query($sql_query_marks)) //Send query to database. If everything goes fine return value true and save data to result variable
                {
                        echo "<select id='marks_list'><option value='0'></option>";
                                
                        while($row = $result->fetch_assoc())
                        {
                            echo "<option value='".$row['id']."'>".$row['title']."</option>";
                        }
                           
                        echo "</select>";
                        
                        $result->free_result();
                        //$_SESSION['number_of_rows'] = $num_of_cars;
                        $sql_query_models = "SELECT id, make_id, title FROM model";
                        if($result = @$connection->query($sql_query_models)) //Send query to database. If everything goes fine return value true and save data to result variable
                        {
                                echo "<select id='models_list'><option id='0' value='0'></option>";
                                        
                                while($row = $result->fetch_assoc())
                                {
                                    echo "<option id='".$row['make_id']."' value='".$row['id']."'>".$row['title']."</option>";
                                }
                                   
                                echo "</select>";
                                
                                $result->free_result();
                                //$_SESSION['number_of_rows'] = $num_of_cars;
                                                
                                //header('Location: main.php');//Open page
                        }           
                        //header('Location: main.php');//Open page
                }
                $connection->close();  
            }      
        ?>
    </div>
    <?php 
        /*echo '<pre>';
            var_dump($_SESSION);
        echo '</pre>';*/
    ?>
    <footer>
        <span>Tomasz Kaczmarek & Aleksander Słojewski 2021 &copy;</span>
    </footer>
    <?php
        if(isset($_SESSION['error_alert'])) {
            echo '<script>$("script").last().before("<div id=error_alert><div><span onclick='."$('#error_alert').remove();".'>&times;</span><p>'.$_SESSION['error_alert'].'</p></div></div>")</script>';
            unset($_SESSION['error_alert']);
        }
    ?>
    <script src="../js/new_service_script.js"></script>
</body>
</html>