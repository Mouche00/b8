<?php

    require("../config/config.php");

    require(APPROOT . "app/models/User.php");
    require(APPROOT . "app/models/Address.php");
    require(APPROOT . "app/models/Role.php");
    require(APPROOT . "app/models/Datatable.php");
    require(APPROOT . "app/services/UserService.php");
    require(APPROOT . "app/services/RoleService.php");

    $userService = new UserService();
    $roleService = new RoleService();

    if($_SERVER['REQUEST_METHOD'] == 'POST') {

    // ---------  ADD --------- //
        
        if(isset($_POST['add'])) {

            $addressId = uniqid(mt_rand(), true);
            $city = $_POST['city'];
            $district = $_POST['district'];
            $street = $_POST['street'];
            $postalCode = $_POST['postal-code'];
            $email = $_POST['email'];
            $telephone = $_POST['telephone'];

            // ---------  USER PROPS --------- //

            $userId = uniqid(mt_rand(), true);
            $username = $_POST['username'];
            $password = password_hash($_POST['pw'], PASSWORD_BCRYPT);
            $nationality = $_POST['nationality'];
            $gendre = $_POST['gendre'];
            $agencyId = $_POST['agency'];

            // ---------  ROLE PROPS --------- //

            $roles = explode(',', $_POST['checkboxes']);

            $address = new Address($addressId, $city, $district, $street, $postalCode, $mail, $telephone);
            $user = new User($userId, $username, $password, $nationality, $gendre, $address, $agencyId);

            try{
                $userService->create($user);
                
                foreach($roles as $roleId):
                    $id = uniqid(mt_rand(), true);
                    $role = new Role($id, $userId, $roleId);
                    $roleService->create($role);
                endforeach;

            } catch (PDOException $e){
                die("Error: " . $e->getMessage());
            }

    // ---------  EDIT --------- //


        } else if(isset($_POST['edit'])) {

            
            $addressId = $_POST['address-id'];
            $city = $_POST['city'];
            $district = $_POST['district'];
            $street = $_POST['street'];
            $postalCode = $_POST['postal-code'];
            $email = $_POST['email'];
            $telephone = $_POST['telephone'];

            // ---------  USER PROPS --------- //

            $userId = $_POST['user-id'];
            $username = $_POST['username'];
            $password = password_hash($_POST['pw'], PASSWORD_BCRYPT);
            $nationality = $_POST['nationality'];
            $gendre = $_POST['gendre'];
            $agencyId = $_POST['agency'];

            // ---------  ROLE PROPS --------- //

            $roles = explode(',', $_POST['checkboxes']);

            $address = new Address($addressId, $city, $district, $street, $postalCode, $mail, $telephone);
            $user = new User($userId, $username, $password, $nationality, $gendre, $address, $agencyId);

            try{
                
                $userService->update($user);
            
                $roleService->delete($userId);
                foreach($roles as $roleId):
                    $id = uniqid(mt_rand(), true);
                    $role = new Role($id, $userId, $roleId);
                    $roleService->create($role);
                endforeach;

            } catch (PDOException $e){
                die("Error: " . $e->getMessage());
            }

    // ---------  DISPLAY --------- //

        } else {

            // Reading value
            $draw = $_POST['draw'];
            $row = $_POST['start'];
            $rowPerPage = $_POST['length']; // Rows display per page
            $columnIndex = $_POST['order'][0]['column']; // Column index
            $columnName = $_POST['columns'][$columnIndex]['data']; // Column name
            $columnSortOrder = $_POST['order'][0]['dir']; // asc or desc
            $searchValue = $_POST['search']['value']; // Search value

            $datatable = new Datatable();

            $datatable->draw = $draw;
            $datatable->row = $row;
            $datatable->rowPerPage = $rowPerPage;
            $datatable->columnName = $columnName;
            $datatable->columnSortOrder = $columnSortOrder;
            $datatable->searchValue = $searchValue;

            $response = $userService->read($datatable);

            echo json_encode($response);

        }
    }

    // ---------  DELETE --------- //

    if($_SERVER['REQUEST_METHOD'] == 'GET') {

        if (isset($_GET['delete'])) {
    
            if(isset($_GET['id'])) {
    
                $id = $_GET['id'];
    
                $userService->delete($id);
            }
    
        } else if (isset($_GET['edit'])) {
                
            if(isset($_GET['id'])) {
    
                $id = $_GET['id'];
                $data = $userService->search($id);
    
                echo json_encode($data);
    
            }
    
        } else if (isset($_GET['get'])) {
    
            $data = $roleService->read();
            echo json_encode($data);
    
    
        }
    
    }

?>