<?php

    class Datatable {
        private $draw;
        private $row;
        private $rowPerPage;
        private $columnName;
        private $columnSortOrder;
        private $searchValue;

        function __construct(){
            
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