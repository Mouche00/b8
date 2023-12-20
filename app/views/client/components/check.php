<?php 

    session_start();

    if (!isset($_SESSION["username"])){
        header("Location: ../login.php");
    }

    foreach($_SESSION["roles"] as $role):
            
        if (!in_array("client", $role)) {
            header("Location: ../login.php");
        }

    endforeach;

?>