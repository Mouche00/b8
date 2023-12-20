<?php

    class Transaction {
        private $id;
        private $type;
        private $amount;
        private $accountId;

        public function __construct($id, $type, $amount, $accountId){
            $this->id = $id;
            $this->type = $type;
            $this->amount = $amount;
            $this->accountId = $accountId;
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