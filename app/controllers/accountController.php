<?php

require("../config/config.php");

require(APPROOT . "app/models/Account.php");
require(APPROOT . "app/models/CheckingAccount.php");
require(APPROOT . "app/models/Datatable.php");
// require(APPROOT . "app/config/Database.php");
require(APPROOT . "app/services/AccountService.php");
require(APPROOT . "app/services/UserService.php");

$accountService = new AccountService();
$userService = new UserService();

    if($_SERVER['REQUEST_METHOD'] == 'POST') {

    // ---------  ADD --------- //
        
        if(isset($_POST['add'])) {
          
            $id = uniqid(mt_rand(), true);
            $rib = $_POST['rib'];
            $currency = $_POST['currency'];
            $balance = $_POST['balance'];
            $userId = $_POST['user_id'];

            $checkingAccount = new CheckingAccount($id, $rib, $currency, $balance, $userId);

            print_r($checkingAccount);

            try{
                $accountService->create($checkingAccount);
            } catch (PDOException $e){
                die("Error: " . $e->getMessage());
            }

    // ---------  EDIT --------- //


        } else if(isset($_POST['edit'])) {

            
            $id = $_POST['id'];
            $rib = $_POST['rib'];
            $currency = $_POST['currency'];
            $balance = $_POST['balance'];
            $userId = $_POST['user_id'];

            $checkingAccount = new CheckingAccount($id, $rib, $currency, $balance, $userId);

            try{
                $accountService->create($checkingAccount);
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

            $response = $accountService->read($datatable);

            echo json_encode($response);

        }
    }

    // ---------  DELETE --------- //

    if($_SERVER['REQUEST_METHOD'] == 'GET') {

        if(isset($_GET['delete'])) {

            if(isset($_GET['id'])) {

                $id = $_GET['id'];
                $service->delete($id);

            }

        } else if (isset($_GET['edit'])) {
            
            if(isset($_GET['id'])) {

                $id = $_GET['id'];
                $data = $service->search($id);

                echo json_encode($data);

            }

        } else if (isset($_GET['get'])) {
    
            $data = $userService->display();
            echo json_encode($data);
    
    
        }

    }

?>