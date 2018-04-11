<?php
/**
 * Created by PhpStorm.
 * User: Ken
 * Date: 09/04/2018
 * Time: 23:32
 */

namespace App\Tests\Entity;

use App\Entity\User;
use PHPUnit\Framework\TestCase;



class UserEntityTest extends TestCase
{

    /**
     * this test roles
     */
    public function testSetRoles()
    {
        // Arrange
        $user = new User();
        $roles = ["admin","user"];
        $wrong=["not user"]; //to check if test unit works
        // Act
        $user->setRoles($roles);
        // Assert
        $this->assertEquals($user->getRoles(), $roles);
    }

    /**
     * this test username
     */
    public function testSetUsername()
    {
        // Arrange
        $user = new User();
        $username = "ken";
        $wrong="not ken"; //to check if test unit works
        // Act
        $user->setUsername($username);
        // Assert
        $this->assertEquals($user->getUsername(), $username);
    }

    /**
     * this tests Password
     */
    public function testSetPassword()
    {
        // Arrange
        $user = new User();
        $password = "password";
        $wrong="kfkdkf"; //to check if test unit works
        // Act
        $user->setPassword($password);
        // Assert
        $this->assertEquals($user->getPassword(), $password);
    }

    /**
     * this tests the set Id
     */
    public function testSetId()
    {
        // Arrange
        $user = new User();
        $id = 1;
        $wrong=2;
        // Act
        $user->setId($id);
        // Assert
        $this->assertEquals($user->getId(), $id);
    }

    /**
     * this sets the review
     */
//    public function testSetReviews()
//    {
//        // Arrange
//        $user = new User();
//        $reviews = ['this is a review','story'];
//        $wrong=['this is wong','so wrong'];
//        // Act
//        $user->setReviews($reviews);
//        // Assert
//        $this->assertEquals($user->getId(), $reviews);
//    }

//    public function testGetReviews()
//    {
//        // Arrange
//        $user = new User();
//        $reviews = ['this is a review','story'];
//        $wrong= ['I cant believe this isnt'];
//        // Act
//        $user->getReviews($reviews);
//        // Assert
//        $this->assertEquals($user->getReviews(), $reviews);
//    }







}