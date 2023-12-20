<?php

interface IServiceAtm
{
    public function create(Atm $atm);
    public function update(Atm $atm);
    public function read();
    public function delete($atmId);
}

?>