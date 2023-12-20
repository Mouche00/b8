<?php

    class Bank {
        private $id;
        private $name;
        private $logo;

        public function __construct($id, $name, $logo){
            $this->id = $id;
            $this->name = $name;
            $this->logo = $logo;
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