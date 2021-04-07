<?php
    session_start();

    if(isset($_SESSION['user_logged']))
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
    <title>AutoBook - Logowanie</title>
    
    <link rel="stylesheet" href="../style/new_account.css">
    
    <script src="../js/jquery.js"></script>
</head>
<body>
    <header>
        <img id="logo" src="../img/logo.svg">
        <span>AutoBook</span>
    </header>
    <div id="main">
        <span id="gradient"></span>
        <div id="spacing"></div>
        <form action="data_base_connections/register.php" method="post">
            <br>
            <div id="name_input"> 
                <label for="imie">Imię</label>
                <br>
                <input type="text" id="imie" name="name" required>
            </div>
            <br>
            <div id="surname_input"> 
                <label for="nazwisko">Nazwisko</label>
                <br>
                <input type="text" id="nazwisko" name="surname" required>
            </div>
            <br>
            <div id="email_input"> 
                <label for="email">E-Mail:</label>
                <br>
                <input type="text" id="email" name="email" required>
            </div>
            <br>
            <div id="pass_input">
                <label for="haslo">Hasło:</label>
                <br>
                <input type="password" id="haslo" name="password_1" required>
                <img class="eye_svg" src="../img/eye.svg">
            </div>
            <div id="pass_input">
                <label for="phaslo">Powtórz hasło:</label>
                <br>
                <input type="password" id="phaslo" name="password_2" required>
                <img class="eye_svg" src="../img/eye.svg">
                <?php 
                    if(isset($_SESSION['register_error']))
                    {
                        echo $_SESSION['register_error'];
                    }
                    else{
                        echo "<br><br>";
                    }
                ?>
            </div>
            <div id="form_help">
                <a href="passHelp.php">Pomoc</a>
            </div>
            <br>
            <input type="submit" value="Zarejestruj">
        </form>
    </div>

    <footer>
        <span>Tomasz Kaczmarek & Aleksander Słojewski 2021 &copy;</span>
    </footer>
    <script type ="text/javascript" src="../js/script.js"></script>
</body>
</html>