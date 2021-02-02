<?php
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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Strona główna - Autobook</title>
</head>
<body>
    <p>test</p>
    <a href="logout.php">Wyloguj</a>
</body>
</html>