<?php

    class Agency {
        private $id;
        private $longitude;
        private $latitude;
        private $bankId;
        private Address $address;

        public function __construct($id, $longitude, $latitude, $bankId, Address $address){
            $this->id = $id;
            $this->longitude = $longitude;
            $this->latitude = $latitude;
            $this->bankId = $bankId;
            $this->address = $address;
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