<?php

    require("IRoleService.php");
    // require("Database.php");

    class RoleService extends Database implements IRoleService {

        public function create(Role $role){

            $db = $this->connect();

            $id = $role->id;
            $userId = $role->userId;
            $roleId = $role->roleId;

            try {
                $sql = "INSERT INTO roleOfUser VALUES (:id, :role, :user)";
                $stmt = $db->prepare($sql);

                $stmt->bindParam(":id", $id);
                $stmt->bindParam(":user", $userId);
                $stmt->bindParam(":role", $roleId);
                
                $stmt->execute();
            } catch (PDOException $e) {
                die("Error: " . $e->getMessage());
            }

        }

        public function delete($id) {

            $db = $this->connect();

            try {
                $sql = "DELETE FROM roleOfUser WHERE user_id = :id";
                $stmt = $db->prepare($sql);
                $stmt->bindParam(":id", $id);
                $stmt->execute();
            } catch (PDOException $e) {
                die("Error: " . $e->getMessage());
            }
        }

        public function read(){

            $db = $this->connect();
            if ($db == null) {
                return null;
            }

            $sql = "SELECT * FROM role";
            $stmt = $db->query($sql);
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            $db = null;
            $stmt = null;

            return $data;


        }

    }

?>