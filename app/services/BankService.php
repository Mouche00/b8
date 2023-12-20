<?php

    require("IBankService.php");
    require("Database.php");

    class BankService extends Database implements IBankService {

        public function create(Bank $bank){

            $db = $this->connect();

            $id = $bank->id;
            $name = $bank->name;
            $logo = $bank->logo;

            try {
                $sql = "INSERT INTO bank VALUES (:id, :name, :logo)";
                $stmt = $db->prepare($sql); 

                $stmt->bindParam(":id", $id);
                $stmt->bindParam(":name", $name);
                $stmt->bindParam(":logo", $logo);

                $stmt->execute();
            } catch (PDOException $e){
                die("Error: ". $e->getMessage());
            }

        }

        public function update(Bank $bank){

            $db = $this->connect();

            $id = $bank->id;
            $name = $bank->name;
            $logo = $bank->logo;

            try {
                $sql = "UPDATE bank SET name = :name, logo = :logo WHERE id = :id";
                $stmt = $db->prepare($sql);

                $stmt->bindParam(":name", $name);
                $stmt->bindParam(":logo", $logo);
                $stmt->bindParam(":id", $id);

                $stmt->execute();
            } catch (PDOException $e){
                    die("Error: " . $e->getMessage());
                
            }

        }

        public function delete($id){

            $db = $this->connect();

            try {
                $sql = "DELETE FROM bank WHERE id = :id";
                $stmt = $db->prepare($sql);
                $stmt->bindParam(":id", $id);
                $stmt->execute();
            } catch (PDOException $e){
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
                $searchQuery = " AND (id LIKE :id OR 
                        name LIKE :name) ";
                $searchArray = array( 
                        'id'=>"%$searchValue%",
                        'name'=>"%$searchValue%"
                );
            }
    
            try {
                $stmt = $db->prepare("SELECT COUNT(*) AS allcount FROM bank ");
                $stmt->execute();
                $records = $stmt->fetch();
                $totalRecords = $records['allcount'];
            
                $stmt = $db->prepare("SELECT COUNT(*) AS allcount FROM bank WHERE 1 ".$searchQuery);
                $stmt->execute($searchArray);
                $records = $stmt->fetch();
                $totalRecordwithFilter = $records['allcount'];

                $stmt = $db->prepare("SELECT * FROM bank WHERE 1 ".$searchQuery." ORDER BY ".$columnName." ".$columnSortOrder." LIMIT :limit,:offset");

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
                    "name"=>$row['name'],
                    "logo"=>$row['logo']
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

    }
?>