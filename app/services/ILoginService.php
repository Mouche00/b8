<?php

    interface ILoginService {
        function login($username, $password);
        function logout();
    }

?>