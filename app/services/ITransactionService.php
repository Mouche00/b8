<?php

interface ITransactionService {
    public function create(Transaction $transaction);
    public function read();
    public function delete($id);

}


?>