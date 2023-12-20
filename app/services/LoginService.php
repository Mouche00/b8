<?php

    require("ILoginService.php");
    require("Database.php");

    class LoginService extends Database implements ILoginService {

        public function login($username, $password){

            $db = $this->connect();

            try {
                $sql = "SELECT id, username, password FROM user
                WHERE username = :username AND deleted = 0";

                $stmt = $db->prepare($sql);
                $stmt->bindParam(":username", $username);
                $stmt->execute();
                $currentUser = $stmt->fetch(PDO::FETCH_ASSOC);
                
            } catch (PDOException $e) {
                die("Error: " . $e->getMessage());
            }

            if ($currentUser && password_verify($password, $currentUser['password'])) {

                $id = $currentUser['id'];
                $_SESSION['id'] = $id;
                $_SESSION['username'] = $currentUser['username'];


                try {
                    $sql = "SELECT role.name AS role FROM user
                    JOIN roleOfUser ON user.id = roleOfUser.user_id
                    JOIN role ON roleOfUser.role_id = role.name
                    JOIN address ON user.address_id = address.id
                    WHERE deleted = 0";
    
                    $stmt = $db->prepare($sql);
                    $stmt->bindParam(":username", $username);
                    $stmt->execute();
                    $currentUser = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    
                } catch (PDOException $e) {
                    die("Error: " . $e->getMessage());
                }


                $roles = $user->getRoles($id);
                $_SESSION['roles'] = $roles;

                foreach($roles as $role):
                
                    if (in_array("admin", $role) || in_array("sub", $role)) {
                        header("Location: ../../admin/bank.php");
                    } else if (in_array("client", $role)) {
                        header("Location: ../../client/account.php");
                    } else {
                        die("Error");
                    }
                endforeach;
            }

        }

        public function logout(){

        }

    }

?>