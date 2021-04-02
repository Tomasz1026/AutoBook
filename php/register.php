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
        <a id="register" href="index.php">Zaloguj</a>
    </header>
    <div id="main">
        <span id="gradient"></span>
        <div id="spacing"></div>
        <form action="login.php" method="post">
            <br>
            <div id="name_input"> 
                <label for="imie">Imię</label>
                <br>
                <input type="text" id="imie" name="name">
            </div>
            <br>
            <div id="surname_input"> 
                <label for="nazwisko">Nazwisko</label>
                <br>
                <input type="text" id="nazwisko" name="surname">
            </div>
            <br>
            <div id="email_input"> 
                <label for="email">E-Mail:</label>
                <br>
                <input type="text" id="email" name="email">
            </div>
            <br>
            <div id="pass_input">
                <label for="haslo">Hasło:</label>
                <br>
                <input type="password" id="haslo" name="password">
                <img class="eye_svg" src="../img/eye.svg">
            </div>
            <div id="pass_input">
                <label for="phaslo">Powtórz hasło:</label>
                <br>
                <input type="password" id="phaslo" name="password1">
                <img class="eye_svg" src="../img/eye.svg">
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