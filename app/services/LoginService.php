<?php

    require("ILoginService.php");
    

    class LoginService extends Database implements ILoginService {

        public function login($username, $password){

            $db = $this->connect();

            $data = [];

            try {
                $sql = "SELECT id, username, password FROM user
                WHERE username = :username AND deleted = '0'";

                $stmt = $db->prepare($sql);
                $stmt->bindParam(":username", $username);
                $stmt->execute();
                $currentUser = $stmt->fetch(PDO::FETCH_ASSOC);

                array_push($data, $currentUser);

                
            } catch (PDOException $e) {
                die("Error: " . $e->getMessage());
            }

            $id = $currentUser['id'];

            try {
                $sql = "SELECT role.name FROM user
                JOIN roleOfUser ON user.id = roleOfUser.user_id
                JOIN role ON roleOfUser.role_id = role.name
                JOIN address ON user.address_id = address.id
                WHERE user.id = :id AND deleted = '0'";

                $stmt = $db->prepare($sql);
                $stmt->bindParam(":id", $id);
                $stmt->execute();
                $roles = $stmt->fetchAll(PDO::FETCH_ASSOC);

                array_push($data, $roles);
                
            } catch (PDOException $e) {
                die("Error: " . $e->getMessage());
            }

            return $data;

        }

        public function logout(){

            session_unset();
            session_destroy();

            header("Location: ../../login.php");

        }

    }

?>