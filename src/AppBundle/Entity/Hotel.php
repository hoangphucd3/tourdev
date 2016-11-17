<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Hotel
 *
 * @ORM\Table(name="khach_san")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\HotelRepository")
 */
class Hotel
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="ten", type="string")
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="slug", type="string")
     */
    private $slug;

    /**
     * @var string
     *
     * @ORM\Column(name="moTa", type="string", nullable=true)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="diaChi", type="string")
     */
    private $address;

    /**
     * @var string
     *
     * @ORM\Column(name="soDT", type="string")
     */
    private $phoneNumber;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\TourHotel", mappedBy="hotel", cascade={"persist"}, orphanRemoval=true)
     */
    private $tours;

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->tours = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Hotel
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Hotel
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
     * Set address
     *
     * @param string $address
     *
     * @return Hotel
     */
    public function setAddress($address)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Get address
     *
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Set phoneNumber
     *
     * @param array $phoneNumber
     *
     * @return Hotel
     */
    public function setPhoneNumber($phoneNumber)
    {
        $this->phoneNumber = $phoneNumber;

        return $this;
    }

    /**
     * Get phoneNumber
     *
     * @return array
     */
    public function getPhoneNumber()
    {
        return $this->phoneNumber;
    }

    /**
     * Add tour
     *
     * @param \AppBundle\Entity\TourHotel $tour
     *
     * @return Hotel
     */
    public function addTour(\AppBundle\Entity\TourHotel $tour)
    {
        $this->tours[] = $tour;

        return $this;
    }

    /**
     * Remove tour
     *
     * @param \AppBundle\Entity\TourHotel $tour
     */
    public function removeTour(\AppBundle\Entity\TourHotel $tour)
    {
        $this->tours->removeElement($tour);
    }

    /**
     * Get tours
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTours()
    {
        return $this->tours;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->getName();
    }

    /**
     * Set slug
     *
     * @param string $slug
     * @return Hotel
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get slug
     *
     * @return string 
     */
    public function getSlug()
    {
        return $this->slug;
    }
}
