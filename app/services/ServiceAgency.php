<?php

    require("IServiceAgency.php");
    

class ServiceAgency extends Database implements IServiceAgency
{

    public function create(Agency $agency)
    {

        $db = $this->connect();

        
        $agencyId = $agency->id;
        $longitude = $agency->longitude;
        $latitude = $agency->latitude;
        $bankId = $agency->bankId;

        $addressId = $agency->address->id;
        $city = $agency->address->city;
        $district = $agency->address->district;
        $street = $agency->address->street;
        $postalCode = $agency->address->postalCode;
        $email = $agency->address->email;
        $telephone = $agency->address->phone;

        try {

            $sql = "INSERT INTO address VALUES (:id, :city, :district, :street, :postal_code, :email, :telephone)";

            $stmt = $db->prepare($sql);

            $stmt->bindParam(":id", $addressId);
            $stmt->bindParam(":city", $city);
            $stmt->bindParam(":district", $district);
            $stmt->bindParam(":street", $street);
            $stmt->bindParam(":postal_code", $postalCode);
            $stmt->bindParam(":email", $email);
            $stmt->bindParam(":telephone", $telephone);

            $stmt->execute();

            $sql = "INSERT INTO agency VALUES (:id, :longitude, :latitude, :bank_id, :address_id)";
            $stmt = $db->prepare($sql); 

            $stmt->bindParam(":id", $agencyId);
            $stmt->bindParam(":longitude", $longitude);
            $stmt->bindParam(":latitude", $latitude);
            $stmt->bindParam(":bank_id", $bankId);
            $stmt->bindParam(":address_id", $addressId);

            $stmt->execute();
        } catch (PDOException $e){
            die("Error: ". $e->getMessage());
        }
    }

    public function update(Agency $agency)
    {
        $db = $this->connect();
        
        $agencyId = $agency->id;
        $longitude = $agency->longitude;
        $latitude = $agency->latitude;
        $bankId = $agency->bankId;

        $addressId = $agency->address->id;
        $city = $agency->address->city;
        $district = $agency->address->district;
        $street = $agency->address->street;
        $postalCode = $agency->address->postalCode;
        $email = $agency->address->email;
        $telephone = $agency->address->phone;

        try {
            $sql = "UPDATE address SET city = :city, district = :district, street = :street, postal_code = :postal_code, email = :email, telephone = :telephone WHERE id = :id";

            $stmt = $db->prepare($sql);

            $stmt->bindParam(":id", $addressId);
            $stmt->bindParam(":city", $city);
            $stmt->bindParam(":district", $district);
            $stmt->bindParam(":street", $street);
            $stmt->bindParam(":postal_code", $postalCode);
            $stmt->bindParam(":email", $email);
            $stmt->bindParam(":telephone", $telephone);

            $sql = "UPDATE agency SET longitude = :longitude, latitude = :latitude, bank_id = :bank_id WHERE id = :id";
            $stmt = $db->prepare($sql);

            $stmt->bindParam(":longitude", $longitude);
            $stmt->bindParam(":latitude", $latitude);
            $stmt->bindParam(":bank_id", $bankId);
            $stmt->bindParam(":id", $agencyId);

            $stmt->execute();
        } catch (PDOException $e) {
            die("Error: " . $e->getMessage());
        }
    }

    public function read()
    {
        $db = $this->connect();

        $searchArray = array();
        $searchQuery = " ";


        $draw = $datatable->draw;
        $row = $datatable->row;
        $rowPerPage = $datatable->rowPerPage;
        $columnName = $datatable->columnName;
        $columnSortOrder = $datatable->columnSortOrder;
        $searchValue = $datatable->searchValue;

        if($searchValue != ''){
            $searchQuery = " AND (id LIKE :id OR 
                    longitude LIKE :longitude OR 
                    latitude LIKE :latitude) ";
            $searchArray = array( 
                    'id'=>"%$searchValue%",
                    'longitude'=>"%$searchValue%",
                    'latitude'=>"%$searchValue%"
            );
        }

        try {
            $stmt = $db->prepare("SELECT COUNT(*) AS allcount FROM agency ");
            $stmt->execute();
            $records = $stmt->fetch();
            $totalRecords = $records['allcount'];
        
            $stmt = $db->prepare("SELECT COUNT(*) AS allcount FROM agency WHERE 1 ".$searchQuery);
            $stmt->execute($searchArray);
            $records = $stmt->fetch();
            $totalRecordwithFilter = $records['allcount'];

            $stmt = $db->prepare("SELECT * FROM agency WHERE 1 ".$searchQuery." ORDER BY ".$columnName." ".$columnSortOrder." LIMIT :limit,:offset");

            foreach ($searchArray as $key=>$search) {
                $stmt->bindValue(':'.$key, $search,PDO::PARAM_STR);
            }
            
            $stmt->bindValue(':limit', (int)$row, PDO::PARAM_INT);
            $stmt->bindValue(':offset', (int)$rowPerPage, PDO::PARAM_INT);
            $stmt->execute();
            $records = $stmt->fetchAll();

        } catch (PDOException $e){
            die("Error: " . $e->getMessage());
        }

        $data = array();

        foreach ($records as $row) {
            $data[] = array(
                "id"=>$row['id'],
                "longitude"=>$row['longitude'],
                "latitude"=>$row['latitude'],
                "bank_id"=>$row['bank_id'],
                "address_id"=>$row['address_id']
            );
        }

        // Response
        $response = array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordwithFilter,
            "aaData" => $data
        );

        return $response;
    }

    public function delete($agencyId)
    {
        $db = $this->connect();

        try {
            $sql = "DELETE FROM agency WHERE id = :id";

            $stmt = $db->prepare($sql);
            $stmt->bindParam(":id", $id);

            $stmt->execute();

            $sql = "DELETE FROM address
                    JOIN agency ON agency.address_id = address.id
                    WHERE agency.id = :id";

            $stmt = $db->prepare($sql);
            $stmt->bindParam(":id", $id);

            $stmt->execute();
        } catch (PDOException $e) {
            die("Error: " . $e->getMessage());
        }
    }
}

?>