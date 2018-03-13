<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PortRepository")
 */
class Port
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type ="string")
     */
    private $name;
    /**
     * @ORM\Column(type ="string")
     */
    private $photo;
    /**
     * @ORM\Column(type ="string")
     */
    private $description;
    /**
     * @ORM\Column(type ="string")
     */
    private $ingrediants;
    /**
     * @ORM\Column(type ="string")
     */
    private $priceRange;

//    /**
//     * Port constructor.
//     * @param $id
//     * @param $name
//     * @param $photo
//     * @param $description
//     * @param $ingrediants
//     * @param $priceRange
//     */
//    public function __construct($id, $name, $photo, $description, $ingrediants, $priceRange)
//    {
//        $this->id = $id;
//        $this->name = $name;
//        $this->photo = $photo;
//        $this->description = $description;
//        $this->ingrediants = $ingrediants;
//        $this->priceRange = $priceRange;
//    }

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
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
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
