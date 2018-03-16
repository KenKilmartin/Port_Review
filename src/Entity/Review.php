<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ReviewRepository")
 */
class Review
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;
    /**
     * this is for ports name
     * @ORM\Column(type ="string")
     */
    private $portReview;
    /**
     * this is the actual review
     * @Assert\Length (min = 10,max = 250)
     * @ORM\Column(type ="string")
     */
    private $review;

    /**
     * this is for Location of purchase
     * @ORM\Column(type ="string")
     */
    private $placeOfPurchase;
    /**
     * this is for the Price paid
     * @ORM\Column(type ="float")
     */
    private $pricePaid;
    /**
     * this is for the num of stars
     * @ORM\Column(type ="integer")
     */
    private $numOfStars;
    /**
     * this is for User
     * @ORM\Column(type ="string")
     */
    private $user;
    /**
     * this is for the Date of purchase
     * @ORM\Column(type ="date")
     */
    private $date;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Port", inversedBy="productReview")
     * @ORM\JoinColumn(nullable=true)
     */
    private $port;

    public function getPort(): Category
    {
        return $this->port;
    }

    public function setPort(Category $port)
    {
        $this->port = $port;
    }








    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getReview()
    {
        return $this->review;
    }

    /**
     * @param mixed $review
     */
    public function setReview($review): void
    {
        $this->review = $review;
    }

    /**
     * @return mixed
     */
    public function getPortReview()
    {
        return $this->portReview;
    }

    /**
     * @param mixed $portReview
     */
    public function setPortReview($portReview): void
    {
        $this->portReview = $portReview;
    }

    /**
     * @return mixed
     */
    public function getPlaceOfPurchase()
    {
        return $this->placeOfPurchase;
    }

    /**
     * @param mixed $placeOfPurchase
     */
    public function setPlaceOfPurchase($placeOfPurchase): void
    {
        $this->placeOfPurchase = $placeOfPurchase;
    }

    /**
     * @return mixed
     */
    public function getPricePaid()
    {
        return $this->pricePaid;
    }

    /**
     * @param mixed $pricePaid
     */
    public function setPricePaid($pricePaid): void
    {
        $this->pricePaid = $pricePaid;
    }

    /**
     * @return mixed
     */
    public function getNumOfStars()
    {
        return $this->numOfStars;
    }

    /**
     * @param mixed $numOfStars
     */
    public function setNumOfStars($numOfStars): void
    {
        $this->numOfStars = $numOfStars;
    }

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param mixed $user
     */
    public function setUser($user): void
    {
        $this->user = $user;
    }

    /**
     * @return mixed
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param mixed $date
     */
    public function setDate($date): void
    {
        $this->date = $date;
    }


}
