<?php
    class Inventory
    {
        private $item_name;
        private $id;

        function __constructor($item_name, $id = null)
        {
            $this->item_name = $item_name;
            $this->id = $id;
        }

        function setItem($new_item_name)
        {
            $this->item_name = (string) $new_item_name;
        }

        function getItem()
        {
            return $this->item_name;
        }

        function getId()
        {
            return $this->id;
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
            $returned_items = $GLOBALS['DB']->query("SELECT * FROM items;");
            $items = array();
            foreach($returned_items as $item) {
                $item_name = $item['item_name'];
                $id = $item['id'];
                $new_item = new Inventory($item_name, $id);
                array_push($items, $new_item);
            }
            return $items;
        }

        static function deleteAll()
        {
            $executed = $GLOBALS['DB']->exec("DELETE FROM items;");
            if ($executed) {
               return true;
            } else {
               return false;
            }
        }

        static function find($search_id)
        {
            $returned_items = $GLOBALS['DB']->prepare("SELECT * FROM items WHERE id = :id");
            $returned_items->bindParam(':id', $search_id, PDO::PARAM_STR);
            $returned_items->execute();
            foreach ($returned_items as $item) {
               $item_name = $item['item_name'];
               $item_id = $item['id'];
               if ($item_id == $search_id) {
                  $found_item = new Inventory($item_name, $item_id);
               }
            }
            return $found_item;
        }
    }
?>
