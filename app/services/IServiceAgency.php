<?php

interface IServiceAgency
{
    public function create(Agency $agency);
    public function update(Agency $agency);
    public function read();
    public function delete($agencyId);
}

?>