<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TourHotel
 *
 * @ORM\Table(name="tour_khachsan")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\TourHotelRepository")
 */
class TourHotel
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
     * @var Tour
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Tour", inversedBy="hotels")
     * @ORM\JoinColumn(name="tour_id", referencedColumnName="id", onDelete="CASCADE")
     */
    private $tour;

    /**
     * @var Hotel
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Hotel", inversedBy="tours")
     * @ORM\JoinColumn(name="hotel_id", referencedColumnName="id", onDelete="CASCADE")
     */
    private $hotel;

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
     * Set tour
     *
     * @param Tour $tour
     *
     * @return TourHotel
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
     * Set hotel
     *
     * @param Hotel $hotel
     *
     * @return TourHotel
     */
    public function setHotel(Hotel $hotel = null)
    {
        $this->hotel = $hotel;

        return $this;
    }

    /**
     * Get hotel
     *
     * @return Hotel
     */
    public function getHotel()
    {
        return $this->hotel;
    }
}
