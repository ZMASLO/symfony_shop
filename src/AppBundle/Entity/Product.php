<?php
/**
 * Created by PhpStorm.
 * User: Sylwa
 * Date: 12.08.2016
 * Time: 13:53
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="product")
 */

class Product
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string")
     */
    private $title;

    /**
     * @ORM\Column(length=4095)
     */
    private $description;

    /**
     * @ORM\Column(type="float")
     */
    private $price;

    /**
     * @ORM\Column(type="float")
     */
    private $old_price = 0;

    /**
     * @ORM\Column(type="boolean")
     */
    private $recomended;

    /**
     * @ORM\Column(type="string")
     * @Assert\NotBlank(message="Proszę przesłać plik w formacie *.jpg")
     * @Assert\File(mimeTypes={ "image/jpeg" })
     */
     private $photo;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set title
     *
     * @param string $title
     *
     * @return Product
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Product
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set price
     *
     * @param integer $price
     *
     * @return Product
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return integer
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set oldPrice
     *
     * @param integer $oldPrice
     *
     * @return Product
     */
    public function setOldPrice($oldPrice)
    {
        $this->old_price = $oldPrice;

        return $this;
    }

    /**
     * Get oldPrice
     *
     * @return integer
     */
    public function getOldPrice()
    {
        return $this->old_price;
    }

    /**
     * Set recomended
     *
     * @param integer $recomended
     *
     * @return Product
     */
    public function setRecomended($recomended)
    {
        $this->recomended = $recomended;

        return $this;
    }

    /**
     * Get recomended
     *
     * @return integer
     */
    public function getRecomended()
    {
        return $this->recomended;
    }

    /**
     * Set photo
     *
     * @param string $photo
     *
     * @return Product
     */
    public function setPhoto($photo)
    {
        $this->photo = $photo;

        return $this;
    }

    /**
     * Get photo
     *
     * @return string
     */
    public function getPhoto()
    {
        return $this->photo;
    }
}
