<?php

    require("IAccountService.php");
    require("Database.php");

    class AccountService extends Database implements IAccountService {

        public function create(Account $account) {

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

        public function read(){

            $db = $this->connect();
            if ($db == null) {
                return null;
            }

            $sql = "SELECT * FROM account";
            $stmt = $db->query($sql);
            $accounts = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            $db = null;
            $stmt = null;

            return $accounts;


        }

        public function update(Account $account) {
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