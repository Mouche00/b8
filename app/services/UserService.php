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

                $sql = "INSERT INTO user VALUES (:id, :username, :password, :nationality, :gendre, :address_id, :agency_id, '0')";

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

                $sql = "DELETE FROM address
                        JOIN user ON user.address_id = address.id
                        WHERE user.id = :id";

                $stmt = $db->prepare($sql);
                $stmt->bindParam(":id", $id);

                $stmt->execute();
            } catch (PDOException $e) {
                die("Error: " . $e->getMessage());
            }

        }

        public function read(Datatable $datatable){
            
            $db = $this->connect();

            $searchArray = array();
            $searchQuery = " ";


            $draw = $datatable->draw;
            $row = $datatable->row;
            $rowPerPage = $datatable->rowPerPage;
            $columnName = $datatable->columnName;
            $columnSortOrder = $datatable->columnSortOrder;
            $searchValue = $datatable->searchValue;

            if($searchValue != ''){
                $searchQuery = " AND (user.id LIKE :id OR 
                    username LIKE :username OR
                    nationality LIKE :nationality OR
                    gendre LIKE :gendre OR
                    role.name LIKE :role) ";
                $searchArray = array( 
                        'id'=>"%$searchValue%",
                        'username'=>"%$searchValue%",
                        'nationality'=>"%$searchValue%",
                        'gendre'=>"%$searchValue%",
                        'role'=>"%$searchValue%"
                );
            }
    
            try {
                $stmt = $db->prepare("SELECT COUNT(*) AS allcount FROM user ");
                $stmt->execute();
                $records = $stmt->fetch();
                $totalRecords = $records['allcount'];
            
                $stmt = $db->prepare("SELECT COUNT(*) AS allcount FROM user WHERE 1 ".$searchQuery);
                $stmt->execute($searchArray);
                $records = $stmt->fetch();
                $totalRecordwithFilter = $records['allcount'];

                $stmt = $db->prepare("SELECT user.id, user.username, user.nationality, user.gendre, role.name FROM user
                JOIN roleOfUser ON user.id = roleOfUser.user_id
                JOIN role ON roleOfUser.role_id = role.name
                WHERE 1 ".$searchQuery." ORDER BY ".$columnName." ".$columnSortOrder." LIMIT :limit,:offset");

                foreach ($searchArray as $key=>$search) {
                    $stmt->bindValue(':'.$key, $search,PDO::PARAM_STR);
                }

                $stmt->bindValue(':limit', (int)$row, PDO::PARAM_INT);
                $stmt->bindValue(':offset', (int)$rowPerPage, PDO::PARAM_INT);
                $stmt->execute();
                $records = $stmt->fetchAll();

            } catch (PDOException $e){
                die("Error: " . $e->getMessage());
            }

            $data = array();

            foreach ($records as $row) {
                $data[] = array(
                    "id"=>$row['id'],
                    "username"=>$row['username'],
                    "nationality"=>$row['nationality'],
                    "gendre"=>$row['gendre'],
                    "role"=>$row['name'],
                );
            }

            // Response
            $response = array(
                "draw" => intval($draw),
                "iTotalRecords" => $totalRecords,
                "iTotalDisplayRecords" => $totalRecordwithFilter,
                "aaData" => $data
            );

            return $response;
        }

        public function search($id){
            $db = $this->connect();

            try {
                $sql = "SELECT user.id AS userId, user.username, user.nationality, user.gendre, user.agency_id,
                        address.id AS addressId, address.city, address.district, address.street, address.postal_code, address.email, address.telephone FROM user
                        JOIN address ON user.address_id = address.id
                        WHERE user.id = :id";

                $stmt = $db->prepare($sql);
                $stmt->bindParam(":id", $id);

                $stmt->execute();

                return $stmt->fetch(PDO::FETCH_ASSOC);

            } catch (PDOException $e) {
                die("Error: " . $e->getMessage());
            }
        }

    }

?>