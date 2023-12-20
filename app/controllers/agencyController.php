<?php

    require_once(__DIR__ . "/../services/BankService.php");
    require_once(__DIR__ . "/../models/Bank.php");
    require_once(__DIR__ . "/../models/Datatable.php");

    $service = new BankService();

    if($_SERVER['REQUEST_METHOD'] == 'POST') {

    // ---------  ADD --------- //
        
        if(isset($_POST['add'])) {

            $valid_extensions = array('jpeg', 'jpg', 'png');
            $path = __DIR__ . "/../../public/uploads/";

            $img = $_FILES['logo']['name'];
            $tmp = $_FILES['logo']['tmp_name'];

            $ext = strtolower(pathinfo($img, PATHINFO_EXTENSION));

            $logo = rand(1000,1000000).$img;

            if(in_array($ext, $valid_extensions)) { 
                $path = $path.strtolower($logo); 
                if(move_uploaded_file($tmp,$path)) {
                    echo "Upload Failed";
                } else {
                    echo "Upload Successful";
                }
            }

            
            $id = uniqid(mt_rand(), true);
            $name = $_POST['name'];
            $logo = strtolower($logo);

            $bank = new Bank($id, $name, $logo);

            try{
                $service->create($bank);
            } catch (PDOException $e){
                die("Error: " . $e->getMessage());
            }

    // ---------  EDIT --------- //


        } else if(isset($_POST['edit'])) {

            
            $valid_extensions = array('jpeg', 'jpg', 'png');
            $path = __DIR__ . "/../../public/uploads/";

            $img = $_FILES['logo']['name'];
            $tmp = $_FILES['logo']['tmp_name'];

            $ext = strtolower(pathinfo($img, PATHINFO_EXTENSION));

            $logo = rand(1000,1000000).$img;

            if(in_array($ext, $valid_extensions)) { 
                $path = $path.strtolower($logo); 
                if(move_uploaded_file($tmp,$path)) {
                    echo "Upload Failed";
                } else {
                    echo "Upload Successful";
                }
            }

            $id = $_POST['id'];
            $name = $_POST['name'];
            $logo = strtolower($logo);

            $bank = new Bank($id, $name, $logo);

            try{
                $service->update($bank);
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

            $response = $service->read($datatable);

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

        }

    }

?>