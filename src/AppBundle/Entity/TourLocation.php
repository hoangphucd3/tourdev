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
     * @var int
     *
     * @ORM\Column(name="thuTu", type="integer", nullable=true)
     */
    private $position;

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
     * @return integer
     */
    public function getId()
    {
        return $this->id;
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

    /**
     * Set tour
     *
     * @param Tour $tour
     *
     * @return TourLocation
     */
    public function setTour(Tour $tour = null)
    {
        $this->tour = $tour;

        return $this;
    }

    /**
     * Get tour
     *
     * @return Tour
     */
    public function getTour()
    {
        return $this->tour;
    }

    /**
     * Set location
     *
     * @param Location $location
     *
     * @return TourLocation
     */
    public function setLocation(Location $location = null)
    {
        $this->location = $location;

        return $this;
    }

    /**
     * Get location
     *
     * @return Location
     */
    public function getLocation()
    {
        return $this->location;
    }

    public function getLocationId()
    {
        return $this->getLocation()->getId() . '';
    }
}
