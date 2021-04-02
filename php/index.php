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
    
    <link rel="stylesheet" href="../style/style.css">
    
    <script src="../js/jquery.js"></script>
</head>
<body>
    <header>
        <img id="logo" src="../img/logo.svg">
        <span>AutoBook</span>
        <a id="register" href="register.php">Zarejestruj się</a>
    </header>
    <div id="main" >
        <span id="gradient"></span>
        <div id="spacing"></div>
        <form action="data_base_connections/login.php" method="post">
            <br>
            <div id="email_input"> 
                <label for="email">E-Mail:</label><br>
                <input type="text" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" id="email" name="email" required>
            </div>
            <br>
            <div id="pass_input">
                <label for="haslo">Hasło:</label><br>
                <input type="password" id="haslo" name="password" required>
                <img class="eye_svg" src="../img/eye.svg">
                <?php
                    if(isset($_SESSION['login_error']))
                    {
                        echo $_SESSION['login_error'];
                    }
                ?>
            </div>
            <div id="form_help">
                
                <a href="data_base_connections/passHelp.php">Nie pamiętam hasła</a>
            </div>
            <input type="submit" value="Zaloguj">
        </form>
    </div>
    <?php 
        /*echo '<pre>';
            var_dump($_SESSION);
        echo '</pre>';*/
    ?>
    <footer>
        <span>Tomasz Kaczmarek & Aleksander Słojewski 2021 &copy;</span>
    </footer>
    <script type ="text/javascript" src="../js/script.js"></script>
</body>
</html>