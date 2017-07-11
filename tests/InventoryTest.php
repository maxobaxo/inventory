<?php
    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Inventory.php";
    $server = 'mysql:host=localhost:8889;dbname=inventory_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class Inventory_Test extends PHPUnit_Framework_TestCase
    {
        protected function tearDown()
        {
            Inventory::deleteAll();
        }

        function testGetId()
        {
            //Arrange
            $item_name = "lemurs";
            $test_item = new Inventory($item_name);
            $test_item->save();

            //Act
            $result = $test_item->getId();

            //Assert
            $this->assertTrue(is_numeric($result));
        }

        function testFind()
        {
            //Arrange
            $test_item_name = "Monkey Bread";
            $test_item_name_2 = "Coffee";
            $test_item = new Inventory($test_item_name);
            $test_item->save();
            $test_item_2 = new Inventory($test_item_name_2);
            $test_item_2->save();

            //Act
            $id = $test_item->getId();
            $result = Inventory::find($id);

            //Assert
            $this->assertEquals($test_item, $result);
        }

        function testSave()
        {
            //Arrange
            $test_item_name = "Bob Ross";
            $test_item = new Inventory($test_item_name);

            //Act
            $executed = $test_item->save();

            // Assert
            $this->assertTrue($executed, "Item not successfully saved to database");
        }

        function testGetAll()
        {
            //Arrange
            $test_item_name = "Bob Ross";
            $test_item_name_2 = "Shania Twain";
            $test_item = new Inventory($test_item_name);
            $test_item->save();
            $test_item_2 = new Inventory($test_item_name_2);
            $test_item_2->save();

            //Act
            $result = Inventory::getAll();

            // Assert
            $this->assertEquals([$test_item, $test_item_2], $result);
        }

        function testDeleteAll()
        {
            //Arrange
            $item_name = "1912 Louisville Slugger";
            $item_name_2 = "Ricky Ricardo's Microphone";
            $test_item = new Inventory($item_name);
            $test_item->save();
            $test_item_2 = new Inventory($item_name_2);
            $test_item_2->save();

            //Act
            Inventory::deleteAll();

            //Assert
            $result = Inventory::getAll();
            $this->assertEquals([], $result);
        }
    }

?>
