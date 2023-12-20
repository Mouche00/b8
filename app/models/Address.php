<?php

    class Address {
        private $id;
        private $city;
        private $district;
        private $street;
        private $postalCode;
        private $email;
        private $telephone;
        private $timestamp;

        public function __construct($id, $city, $district, $street, $postalCode, $email, $telephone, $timestamp){
            $this->id = $id;
            $this->city = $city;
            $this->district = $district;
            $this->street = $street;
            $this->postal_code = $postalCode;
            $this->email = $email;
            $this->telephone = $telephone;
            $this->timestamp = $timestamp;
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