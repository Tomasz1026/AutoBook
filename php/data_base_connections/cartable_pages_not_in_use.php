<?php 
    session_start();

    if(isset($_GET['page_number'])) {
        
        $page_number = 10 * ($_GET['page_number']-1);
        $id = $_SESSION['id'];
        $_SESSION['actual_page'] = $_GET['page_number'];
        $_SESSION['cartable_query'] = "SELECT * FROM car WHERE client_id=$id LIMIT 10 OFFSET $page_number";

        header('Location: ../cartable.php');
        exit();
    } else {
        header('Location: ../cartable.php');
        exit();
    }

?>