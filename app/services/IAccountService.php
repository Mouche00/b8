<?php

interface IAccountService {
    public function create(Account $account);
    public function update(Account $account);
    public function read();
    public function delete($id);

}


?>