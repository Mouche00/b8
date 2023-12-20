<?php

    interface IUserService {
        function create(User $user);
        function update(User $user);
        function delete($id);
        function read();
    }

?>