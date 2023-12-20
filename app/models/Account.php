<?php

    abstract class Account {
        private $id;
        private $rib;
        private $currency;
        private $balance;
        private $userId;

        function __construct($id, $rib, $currency, $balance, $userId){
            $this->id = $id;
            $this->rib = $rib;
            $this->currency = $currency;
            $this->balance = $balance;
            $this->userId = $userId;
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