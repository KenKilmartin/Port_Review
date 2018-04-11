<?php



namespace App\Tests\Entity;

use App\Entity\Port;
use PHPUnit\Framework\TestCase;

class PortEntityTest extends TestCase
{

    public function testToString()
    {
        // Arrange
        $port = new Port();

        // Act

        // Assert
        $this->assertEquals($port->__toString(), null);
    }

    public function testSetId()
    {
        // Arrange
        $port = new Port();
        $id = 2;
        $wrongingredients=3; //to check if test unit works
        // Act
        $port->setId($id);
        // Assert
        $this->assertEquals($port->getId(), $id);
    }
//    public function testSetProductReviews()
//    {
//        $port = new Port();
//        $productReviews =2;
//
//        $port->setProductReviews($productReviews);
//        $this->assertEquals($port->getId(), $productReviews);
//    }

}