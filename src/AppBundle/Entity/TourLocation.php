<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TourLocation
 *
 * @ORM\Table(name="tour_diadiem")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\TourLocationRepository")
 */
class TourLocation
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
     * @var time
     *
     * @ORM\Column(name="thoiGianLuuTru", type="time")
     */
    private $guestStay;

    /**
     * @var Tour
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Tour", inversedBy="locations")
     * @ORM\JoinColumn(name="tour_id", referencedColumnName="id")
     */
    private $tour;

    /**
     * @var Location
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Location", inversedBy="tours")
     * @ORM\JoinColumn(name="location_id", referencedColumnName="id")
     */
    private $location;

    /**
     * @var int
     *
     * @ORM\Column(name="thuTu", type="integer")
     */
    private $position;


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
     * Set guestStay
     *
     * @param \DateTime $guestStay
     *
     * @return TourLocation
     */
    public function setGuestStay($guestStay)
    {
        $this->guestStay = $guestStay;

        return $this;
    }

    /**
     * Get guestStay
     *
     * @return \DateTime
     */
    public function getGuestStay()
    {
        return $this->guestStay;
    }

    /**
     * Set tour
     *
     * @param \AppBundle\Entity\Tour $tour
     *
     * @return TourLocation
     */
    public function setTour(\AppBundle\Entity\Tour $tour = null)
    {
        $this->tour = $tour;

        return $this;
    }

    /**
     * Get tour
     *
     * @return \AppBundle\Entity\Tour
     */
    public function getTour()
    {
        return $this->tour;
    }

    /**
     * Set location
     *
     * @param \AppBundle\Entity\Location $location
     *
     * @return TourLocation
     */
    public function setLocation(\AppBundle\Entity\Location $location = null)
    {
        $this->location = $location;

        return $this;
    }

    /**
     * Get location
     *
     * @return \AppBundle\Entity\Location
     */
    public function getLocation()
    {
        return $this->location;
    }

    public function getLocationId()
    {
        return $this->getLocation()->getId();
    }

    public function __toString()
    {
        return $this->getId() . '';
    }

    /**
     * Set position
     *
     * @param integer $position
     *
     * @return TourLocation
     */
    public function setPosition($position)
    {
        $this->position = $position;

        return $this;
    }

    /**
     * Get position
     *
     * @return integer
     */
    public function getPosition()
    {
        return $this->position;
    }
}
