<?php

session_start();

if(isset($_POST['name']) && isset($_POST['surname']) && isset($_POST['password_1']) && isset($_POST['password_2']))
{
    require_once "conn.php";//If this file doesn't exist, server stops executing this php file and throw error

    $connection = new mysqli($host, $db_user, $db_pass, $db_name);//Connection with database. Need data from conn.php

    if($connection->connect_errno!=0)//connect error id: 0 - everything fine, >0 - something went wrong
    {
        echo "ERROR: ".$connection->connect_errno." Description: ".$connection->connect_error;//Show error number in browser. Disable 'Description' later
    } else {
        $name = $_POST['name'];
        $surname = $_POST['surname'];
        $password_1 = $_POST['password_1'];
        $password_2 = $_POST['password_2'];
        $email = $_POST['email'];
        $date = date("Y-m-d H:i:s");
        if (!empty($_SERVER['HTTP_CLIENT_IP']))   
           {
             $ip_address = $_SERVER['HTTP_CLIENT_IP'];
           }
           //whether ip is from proxy
           elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))  
            {
              $ip_address = $_SERVER['HTTP_X_FORWARDED_FOR'];
            }
          //whether ip is from remote address
            else
            {
              $ip_address = $_SERVER['REMOTE_ADDR'];
            }
            $preference = '<span class="list" id="add_text"><div class="category"><div    class="sub_list"><span>Spłuczki</span><span>Kanalizy</span><div class="category"><div class="sub_list"><span>chuj</span><span>penis</span><div class="category"><div class="sub_list"><span>chuj</span><span>penis</span><div class="category"><div class="sub_list"><span>chuj</span><span>penis</span></div><span>Niczego</span></div></div><span>Niczego</span></div></div><span>Niczego</span></div></div><span>Wymiana</span></div><div class="category"><div class="sub_list"><span>Hamulców</span><span>Klocków hamulcowych</span><span>Wycieraczek</span></div><span>Naprawa</span></div><div class="category">sratatata</div>';

            if(trim($_POST['password_1'])=='' || trim($_POST['password_2'])=='')
            {
              $_SESSION['register_error'] = "<br><span style='color: red; font-size:15px'>Hasła nie mogą być puste.</span>";
            }
            else if($_POST['password_1'] == $_POST['password_2'])
            {
              $_SESSION['register_error'] = "";
              $sql_query_login = "INSERT INTO users (`id`, `name`, `surname`, `password`, `email`, `joining_date`, `last_login_date`, `ip_address`, `role`, `preference`) VALUES (NULL, '$name', '$surname', '$password_1', '$email', '$date', '$date', '$ip_address', 'k', '$preference')"; //wstawia nowego usera do db
            }        
            else
            {
              $_SESSION['register_error'] = "<br><span style='color: red; font-size:15px'>Hasła się nie zgadzają.</span>";//blad gdy hasla sie nie zgadzaja

            }
        if(@$connection->query($sql_query_login)) //Send update query to database. If everything goes fine return value true
        {
            $_SESSION['data_base_update'] = "";//Show some sort of alert "Aktualizacja bazy danych zakończyła się sukcesem" 
        } else {
            
            $_SESSION['data_base_update'] = "<br><span style='color: red; font-size:15px'>Nieprawidłowe dane logowania</span>";
            //Show smoe sort of alert "Aktualizacja bazy danych zakończyła się byciem smutną i zjebaną bazą danych, ja jebie jak można być bazą danych, ja tego nie rozumiem >:("
        }
        
        $connection->close();
        
        header('Location: ../register.php');
    }
} else {
    echo $_POST['name'].", ".$_POST['surname'].", ".$_POST['password_1'].", ".$_POST['password_2'].", ".$_POST['email'];
}
?>