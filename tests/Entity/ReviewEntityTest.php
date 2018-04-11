<?php
/**
 * Created by PhpStorm.
 * User: Ken
 * Date: 09/04/2018
 * Time: 23:20
 */

namespace App\Tests\Entity;
use App\Entity\Port;
use App\Entity\User ;
use App\Entity\Review;
use PHPUnit\Framework\TestCase;


class ReviewEntityTest extends TestCase
{

    public function testSetReview()
    {
        $review = new Review();
        $review1 = 'Ruby';
        $wrong = 'vodka';
        // Act
        $review->setReview($review1);
        // Assert
        $this->assertEquals($review->getReview(), $review1);
    }

//        public function testSetUser()
//    {
//        $user1 = new User();
//        $user = ["admin","2"];;
//        $wrong = ["notAdmin","3"];
//        // Act
//        $user1->setUser($user);
//        // Assert
//        $this->assertEquals($user1->getUser(), $user);
//
//    }

//    public function testSetPort()
//    {
//        $port1 = new Port();
//        $port1 ->setPortName('Ruby');
//        $wrong = 'Ruby';
//        // Act
//        $port2 = new Port($port1);
//
//        // Assert
//        $this->assertEquals($port2->getPort(), $wrong);
//
//    }
    public function testSetDate()
    {
        // Arrange
        $review = new Review();
        $date ="10-10-18";
        $wrong="11.11-18"; //to check if test unit works
        // Act
        $review->setDate($date);
        // Assert
        $this->assertEquals($review->getDate(), $date);
    }

    public function testSetPricePaid()
    {
        // Arrange
        $review = new Review();
        $price = 22;
        $wrong= 23; //to check if test unit works
        // Act
        $review->setPricePaid($price);
        // Assert
        $this->assertEquals($review->getPricePaid(), $price);
    }
    public function testSetPlaceOfPurchase()
    {
        // Arrange
        $review = new Review();
        $placeOfPurchase = 'tesco';
        $wrong= 'ITB'; //to check if test unit works
        // Act
        $review->setPlaceOfPurchase($placeOfPurchase);
        // Assert
        $this->assertEquals($review->getPlaceOfPurchase(), $placeOfPurchase);
    }

    public function testSetNumOfStars()
    {
        // Arrange
        $review = new Review();
        $numOfStars = 2.5;
        $wrong= 6; //to check if test unit works
        // Act
        $review->setNumOfStars($numOfStars);
        // Assert
        $this->assertEquals($review->getNumOfStars(), $numOfStars);
    }
    public function testDoesUserWantToMakePublic()
    {
        // Arrange
        $review = new Review();
        $doesUserWantToMakePublic = 0;
        $wrong= 1; //to check if test unit works
        // Act
        $review->setDoesUserWantToMakePublic($doesUserWantToMakePublic);
        // Assert
        $this->assertEquals($review->getDoesUserWantToMakePublic(), $doesUserWantToMakePublic);
    }
    public function testSetId()
    {
        // Arrange
        $review = new Review();
        $id = 1;
        $wrong=2;
        // Act
        $review->setId($id);
        // Assert
        $this->assertEquals($review->getId(), $id);
    }



}