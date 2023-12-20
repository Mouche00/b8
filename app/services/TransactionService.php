<?php

require("ITransactionService.php");
require("Database.php");

class TransactionService extends Database implements ITransactionService {

    public function create(Transaction $transaction){
        $db=$this->connect();
        if($db==null){
            return null;
       }

       $id = $transaction->id;
       $type = $transaction->type;
       $amount = $transaction->balance;
       $accountId = $transaction->accountId;

       
        try {
            $sql = "INSERT INTO transaction VALUES (:id, :type, :amount, :account_id)";
            $stmt = $db->prepare($sql);

            $stmt->bindParam(":id", $id);
            $stmt->bindParam(":type", $type);
            $stmt->bindParam(":amount", $amount);
            $stmt->bindParam(":account_id", $accountId); 
            $stmt->execute();
        } catch (PDOException $e) {
            die("Error: " . $e->getMessage());
        }
        $db=null;
        $stmt=null;
    }

    public function read(){
            $db=$this->connect();
            if($db==null){
                return null;
            }

            try {
                $sql = "SELECT transaction.*, user.username FROM transaction
                        JOIN account ON transaction.accountId = account.id
                        JOIN users ON account.id = users.id";

                $query = $db->query($sql);
                $data = $query->fetchAll(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                die("Error: " . $e->getMessage());
            }
        
           $query = null;
           $db=null;
           return $data;
    }
    
    public function delete($id){


        $db = $this->connect();

        if($db == null) {
            return null;
        }
    
        try {
            $sql = "DELETE FROM transaction WHERE id = :id";
            $stmt = $db->prepare($sql);
            $stmt->bindParam(":id", $id);
            $stmt->execute();
        } catch (PDOException $e) {
            die("Error: " . $e->getMessage());
        }
    
        $stmt = null;
        $db = null;

    }






}





?>