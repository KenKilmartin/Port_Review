<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Form\FormTypeInterface;


/**
 * @ORM\Entity(repositoryClass="App\Repository\PortRepository")
 */
class Port
{
    /**
     * auto incremented id
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;
    /**
     * this is the name of the port it should restrict the limit
     * @Assert\Length (min = 10,max = 250)
     * @ORM\Column(type ="string")
     */
    private $portName;

    /**
     * this is for the Photo of image
     * @ORM\Column(type ="string")
     */
    private $photo;
    /**
     * This is a brief description
     * @Assert\Length (min = 10,max = 250)
     * @ORM\Column(type ="string")
     */
    private $description;
    /**
     * this is a list of ingredients
     * @ORM\Column(type ="string")
     */
    private $ingredients;
    /**
     * this is a number that is the price range
     * @ORM\Column(type ="integer")
     */
    private $priceRange;


    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Review", mappedBy="port")
     */
    private $productReviews;

    public function __construct()
    {
        $this->productReviews = new ArrayCollection();
    }

    /**
     * @return mixed
     */
    public function getReviewedBy()
    {
        return $this->reviewedBy;
    }

    /**
     * @param mixed $reviewedBy
     */
    public function setReviewedBy($reviewedBy): void
    {
        $this->reviewedBy = $reviewedBy;
    }
    /**
     * this has been reviewed by
     * @ORM\Column(type ="string")
     *
     */
    private $reviewedBy;



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
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getPortName()
    {
        return $this->portName;
    }

    /**
     * @param mixed $portName
     */
    public function setPortName($portName)
    {
        $this->portName = $portName;
    }

    /**
     * @return mixed
     */
    public function getPhoto()
    {
        return $this->photo;
    }

    /**
     * @param mixed $photo
     */
    public function setPhoto($photo)
    {
        $this->photo = $photo;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getIngredients()
    {
        return $this->ingredients;
    }

    /**
     * @param mixed $ingredients
     */
    public function setIngredients($ingredients)
    {
        $this->ingredients = $ingredients;
    }

    /**
     * @return mixed
     */
    public function getPriceRange()
    {
        return $this->priceRange;
    }

    /**
     * @param mixed $priceRange
     */
    public function setPriceRange($priceRange)
    {
        $this->priceRange = $priceRange;
    }

    public function __toString()
    {
        // TODO: Implement __toString() method.
        return "{$this->id} {$this->description}";
    }

    /**
     * @return mixed
     */
    public function getProductReviews()
    {
        return $this->productReviews;
    }

    /**
     * @param mixed $productReviews
     */
    public function setProductReviews($productReviews): void
    {
        $this->productReviews = $productReviews;
    }

}
