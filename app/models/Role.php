<?php

    class Role {
        private $id;
        private $userId;
        private $roleId;

        public function __construct($id, $userId, $roleId){
            $this->id = $id;
            $this->userId = $userId;
            $this->roleId = $roleId;
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