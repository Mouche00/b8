<?php

    require("IUserService.php");
    require("Database.php");

    class UserService extends Database implements IUserService {

        public function create(User $user){

            $db = $this->connect();

            $userId = $user->id;
            $username = $user->username;
            $password = $user->password;
            $nationality = $user->nationality;
            $gendre = $user->gendre;
            $agencyId = $user->agencyId;

            $addressId = $user->address->id;
            $city = $user->address->city;
            $district = $user->address->district;
            $street = $user->address->street;
            $postalCode = $user->address->postalCode;
            $email = $user->address->email;
            $telephone = $user->address->telephone;

            try {
                $sql = "INSERT INTO address VALUES (:id, :city, :district, :street, :postal_code, :email, :telephone)";

                $stmt = $db->prepare($sql);

                $stmt->bindParam(":id", $addressId);
                $stmt->bindParam(":city", $city);
                $stmt->bindParam(":district", $district);
                $stmt->bindParam(":street", $street);
                $stmt->bindParam(":postal_code", $postalCode);
                $stmt->bindParam(":email", $email);
                $stmt->bindParam(":telephone", $telephone);

                $stmt->execute();

                $sql = "INSERT INTO user VALUES (:id, :username, :password, :nationality, :gendre, :address_id, :agency_id)";

                $stmt = $db->prepare($sql);

                $stmt->bindParam(":id", $userId);
                $stmt->bindParam(":username", $username);
                $stmt->bindParam(":password", $password);
                $stmt->bindParam(":nationality", $nationality);
                $stmt->bindParam(":gendre", $gendre);
                $stmt->bindParam(":address_id", $addressId);
                $stmt->bindParam(":agency_id", $agencyId);

                $stmt->execute();
            } catch (PDOException $e) {
                die("Error: " . $e->getMessage());
            }

        }

        public function update(User $user){

            $db = $this->connect();

            $userId = $user->id;
            $username = $user->username;
            $password = $user->password;
            $nationality = $user->nationality;
            $gendre = $user->gendre;
            $agencyId = $user->agencyId;

            $addressId = $user->address->id;
            $city = $user->address->city;
            $district = $user->address->district;
            $street = $user->address->street;
            $postalCode = $user->address->postalCode;
            $email = $user->address->email;
            $telephone = $user->address->telephone;

            try {
                $sql = "UPDATE address SET city = :city, district = :district, street = :street, postal_code = :postal_code, email = :email, telephone = :telephone WHERE id = :id";

                $stmt = $db->prepare($sql);

                $stmt->bindParam(":id", $addressId);
                $stmt->bindParam(":city", $city);
                $stmt->bindParam(":district", $district);
                $stmt->bindParam(":street", $street);
                $stmt->bindParam(":postal_code", $postalCode);
                $stmt->bindParam(":email", $email);
                $stmt->bindParam(":telephone", $telephone);

                $stmt->execute();

                $sql = "UPDATE user SET username = :username, password = :password, nationality = :nationality, gendre = :gendre, agency_id = :agency_id WHERE id = :id";

                $stmt = $db->prepare($sql);

                $stmt->bindParam(":id", $userId);
                $stmt->bindParam(":username", $username);
                $stmt->bindParam(":password", $password);
                $stmt->bindParam(":nationality", $nationality);
                $stmt->bindParam(":gendre", $gendre);
                $stmt->bindParam(":address_id", $addressId);
                $stmt->bindParam(":agency_id", $agencyId);

                $stmt->execute();
            } catch (PDOException $e) {
                die("Error: " . $e->getMessage());
            }

        }

        public function delete($id){
            $db = $this->connect();

            try {
                $sql = "DELETE FROM user WHERE id = :id";

                $stmt = $db->prepare($sql);
                $stmt->bindParam(":id", $id);

                $stmt->execute();
            } catch (PDOException $e) {
                die("Error: " . $e->getMessage());
            }

        }

        public function read(){
            $db = $this->connect();

            try {
                $sql = "SELECT user.id, user.username, user.agency_id, address.email, role.name AS role FROM user
                JOIN roleOfUser ON user.id = roleOfUser.user_id
                JOIN role ON roleOfUser.role_id = role.name
                JOIN address ON user.address_id = address.id
                WHERE deleted = 0";

                $data = $db->query($sql);

                return $data->fetchAll(PDO::FETCH_ASSOC);
                
            } catch (PDOException $e) {
                die("Error: " . $e->getMessage());
            }

        }

    }

?>