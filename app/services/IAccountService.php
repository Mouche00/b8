<?php

interface IAccountService {
    public function create(CheckingAccount $account);
    public function update(CheckingAccount $account);
    public function read(Datatable $datatable);
    public function delete($id);

}


?>