<?php

    class Atm {
        private $id;
        private $longitude;
        private $latitude;
        private $bankId;
        private $addressId;

        public function __construct($id, $longitude, $latitude, $bankId, $addressId){
            $this->id = $id;
            $this->longitude = $longitude;
            $this->latitude = $latitude;
            $this->bankId = $bankId;
            $this->addressId = $addressId;
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