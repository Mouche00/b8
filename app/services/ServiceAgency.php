<?php

    require("IServiceAgency.php");
    require("Database.php");

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
        
    }

    public function delete($agencyId)
    {
        
    }
}

?>