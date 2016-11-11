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
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @var string
     */
    private $condition;


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
     * Set condition
     *
     * @param string $condition
     *
     * @return TourLocation
     */
    public function setCondition($condition)
    {
        $this->condition = $condition;

        return $this;
    }

    /**
     * Get condition
     *
     * @return string
     */
    public function getCondition()
    {
        return $this->condition;
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
}
