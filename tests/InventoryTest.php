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
        // protected function tearDown()
        // {
        //     Task::deleteAll();
        // }

        function testSave()
        {
            //Arrange
            $description = "Bob Ross";
            $test_item = new Inventory($description);
            //Act
            $executed = $test_item->save();
            // Assert
            $this->assertTrue($executed, "Item not successfully saved to database");
        }
    }

?>
