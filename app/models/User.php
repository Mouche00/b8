<?php

    class User {
        private $id;
        private $username;
        private $password;
        private $nationality;
        private $gendre;
        private Address $address;
        private $agencyId;

        public function __construct($id, $username, $password, $nationality, $gendre, Address $address, $agencyId){
            $this->id = $id;
            $this->username = $username;
            $this->password = $password;
            $this->nationality = $nationality;
            $this->gendre = $gendre;
            $this->address = $address;
            $this->agencyId = $agencyId;
        }

        public function __get($property) {
            if (property_exists($this, $property)) {
              return $this->$property;
            }
        }
        
        public function __set($property, $value) {
            if (property_exists($this, $property)) {
                $this->$property = $value;
            }
        }
    }

?>