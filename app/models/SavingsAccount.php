<?php

    class SavingsAccount extends Account {

        public function __construct($id, $rib, $currency, $balance, $userId) {
            parent::__construct($id, $rib, $currency, $balance, $userId);
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