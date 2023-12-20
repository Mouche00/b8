<?php

    session_start();
    require("../config/config.php");

    require(APPROOT . "app/models/User.php");
    require(APPROOT . "app/services/LoginService.php");

    $service = new LoginService();

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {


        $username = $_POST['username'];
        $password = $_POST['password'];

        $currentUser = $service->login($username, $password);
        
        if ($currentUser && password_verify($password, $currentUser[0]['password'])) {

            $_SESSION['username'] = $currentUser[0]['username'];
            $_SESSION['roles'] = $currentUser[1];

            foreach($_SESSION['roles'] as $role):
                
                if (in_array("admin", $role) || in_array("sub", $role)) {
                    header("Location: " . URLROOT . "public/admin/bank.php");
                } else if (in_array("client", $role)) {
                    header("Location: " . URLROOT . "public/client/account.php");
                } else {
                    die("Error");
                }
            endforeach;

        }
        
    } else if (isset($_GET['logout'])) {

        session_unset();
        session_destroy();

        header("Location: " . URLROOT . "public/login.php");

    }

?>