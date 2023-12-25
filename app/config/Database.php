<?php

    class Database {

        public function connect() {
            try {
                $dsn = "mysql:host=" . HOST . ";dbname=" . DB;
                return new PDO($dsn, USER, PASS);
            } catch(PDOException $e) {
                die("Error: " . $e->getCode());
            }
        }
    }

?>