<?php

    require("IAccountService.php");
    

    class AccountService extends Database implements IAccountService {

        public function create(CheckingAccount $account) {

            $db=$this->connect();
            if ($db == null) {
                return null;
            }
            
            $id = $account->id;
            $balance = $account->balance;
            $rib = $account->rib;
            $currency = $account->currency;
            $userId = $account->userId;

            try {
                $sql = "INSERT INTO account VALUES (:id, :rib, :currency, :balance, :user_id)";
                $stmt = $db->prepare($sql); 

                $stmt->bindParam(":id", $id);
                $stmt->bindParam(":rib", $rib);
                $stmt->bindParam(":currency", $currency);
                $stmt->bindParam(":balance", $balance);
                $stmt->bindParam(":user_id", $userId);

                $stmt->execute();
            } catch (PDOException $e){
                die("Error: ". $e->getMessage());
            }

            $db = null;
            $stmt = null;

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
                        rib LIKE :rib OR 
                        currency LIKE :currency OR 
                        balance LIKE :balance OR 
                        user_id LIKE :user_id) ";
                $searchArray = array( 
                        'id'=>"%$searchValue%",
                        'rib'=>"%$searchValue%",
                        'currency'=>"%$searchValue%",
                        'balance'=>"%$searchValue%",
                        'user_id'=>"%$searchValue%"
                );
            }
    
            try {
                $stmt = $db->prepare("SELECT COUNT(*) AS allcount FROM account");
                $stmt->execute();
                $records = $stmt->fetch();
                $totalRecords = $records['allcount'];
            
                $stmt = $db->prepare("SELECT COUNT(*) AS allcount FROM account WHERE 1 ".$searchQuery);
                $stmt->execute($searchArray);
                $records = $stmt->fetch();
                $totalRecordwithFilter = $records['allcount'];

                $stmt = $db->prepare("SELECT * FROM account WHERE 1 ".$searchQuery." ORDER BY ".$columnName." ".$columnSortOrder." LIMIT :limit,:offset");

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
                    "rib"=>$row['rib'],
                    "currency"=>$row['currency'],
                    "balance"=>$row['balance'],
                    "user_id"=>$row['user_id']
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

        public function update(CheckingAccount $account) {
            $db = $this->connect();
            if ($db == null) {
                return null;
            }
            
            $id = $account->id;
            $balance = $account->balance;
            $rib = $account->rib;
            $currency = $account->currency;

            try {
                $sql = "UPDATE account SET rib = :rib, currency = :currency, balance = :balance WHERE id = :id";
                $stmt = $db->prepare($sql);

                $stmt->bindParam(":rib", $rib);
                $stmt->bindParam(":currency", $currency);
                $stmt->bindParam(":balance", $balance);
                $stmt->bindParam(":id", $id);

                $stmt->execute();
            } catch (PDOException $e){
                    die("Error: " . $e->getMessage());
                
            }

            $db = null;
            $stmt = null;

        }

        public function delete($id) {

            $db = $this->connect();

            if ($db == null) {
                return null;
            }

            $sql = "DELETE FROM account WHERE id = :id";

            $stmt = $db->prepare($sql);
            $stmt->bindParam(":id", $id);

            $db = null;
            $stmt = null;

        }












        


        

    }






?>