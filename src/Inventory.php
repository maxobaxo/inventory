<?php
    class Inventory {
        private $item_name;

        function __constructor($item_name)
        {
            $this->item_name = $item_name;
        }

        function save()
        {
            $executed = $GLOBALS['DB']->exec("INSERT INTO items (item_name) VALUES ('{$this->getItem()}');");
            if ($executed) {
                $this->id = $GLOBALS['DB']->lastInsertId();
                return true;
            } else {
                return false;
            }
        }

        static function getAll()
        {

        }

        static function deleteAll()
        {

        }

        static function find()
        {

        }

        function getItem()
        {
            return $this->item_name;
        }

    }
?>
