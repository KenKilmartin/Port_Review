<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

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
     * @ORM\OneToMany(targetEntity = "App\Entity\Review",mappedBy = "port")
     * @Assert\Length (
     *     min = 5,
     *     max = 50,
     *     minMessage = "The port's name must be at least 5 characters long",
     *     maxMessage = "The port's name cannot be longer than 50 characters"
     *     )
     *
     */
    private $port;
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
    private $ingrediants;
    /**
     * this is a number that is the price range
     * @ORM\Column(type ="integer")
     */
    private $priceRange;

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
     * @ORM\Column(type ="integer")
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
    public function getPort()
    {
        return $this->port;
    }

    /**
     * @param mixed $port
     */
    public function setPort($port)
    {
        $this->port = $port;
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
    public function getIngrediants()
    {
        return $this->ingrediants;
    }

    /**
     * @param mixed $ingrediants
     */
    public function setIngrediants($ingrediants)
    {
        $this->ingrediants = $ingrediants;
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

}
