<?php

    require("../config/config.php");

    require(APPROOT . "app/models/Agency.php");
    require(APPROOT . "app/models/Datatable.php");
    // require(APPROOT . "app/config/Database.php");
    require(APPROOT . "app/services/ServiceAgency.php");
    require(APPROOT . "app/services/BankService.php");

    $agencyService = new ServiceAgency();

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

            $agencyId = uniqid(mt_rand(), true);
            $longitude = $_POST['longitude'];
            $latitude = $_POST['latitude'];
            $bank_id = $_POST['bank_id'];

            $address = new Address($addressId, $city, $district, $street, $postalCode, $mail, $telephone);
            $agency = new Agency($agencyId, $longitude, $latitude, $bank_id, $address);

            try{
                $agencyService->create($agency);

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

            $agencyId = $_POST['agency-id'];
            $longitude = $_POST['longitude'];
            $latitude = $_POST['latitude'];
            $bank_id = $_POST['bank_id'];

            $address = new Address($addressId, $city, $district, $street, $postalCode, $mail, $telephone);
            $agency = new Agency($agencyId, $longitude, $latitude, $bank_id, $address);

            try{
                $agencyService->update($agency);

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

            $response = $agencyService->read($datatable);

            echo json_encode($response);

        }
    }

    // ---------  DELETE --------- //

    if($_SERVER['REQUEST_METHOD'] == 'GET') {

        if (isset($_GET['delete'])) {
    
            if(isset($_GET['id'])) {
    
                $id = $_GET['id'];
    
                $agencyService->delete($id);
            }
    
        } else if (isset($_GET['edit'])) {
                
            if(isset($_GET['id'])) {
    
                $id = $_GET['id'];
                $data = $agencyService->search($id);
    
                echo json_encode($data);
    
            }
    
        } else if (isset($_GET['get'])) {

            $bankService = new BankService();
    
            $data = $bankService->read();
            echo json_encode($data);
    
    
        }
    
    }

?>