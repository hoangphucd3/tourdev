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
     * @var time
     *
     * @ORM\Column(name="thoiGianLuuTru", type="time")
     */
    private $guestStay;

    /**
     * @var int
     *
     * @ORM\Column(name="giaPhong", type="bigint")
     */
    private $roomPrice;

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
     * @return TourHotel
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
     * Set roomPrice
     *
     * @param integer $roomPrice
     *
     * @return TourHotel
     */
    public function setRoomPrice($roomPrice)
    {
        $this->roomPrice = $roomPrice;

        return $this;
    }

    /**
     * Get roomPrice
     *
     * @return integer
     */
    public function getRoomPrice()
    {
        return $this->roomPrice;
    }

    /**
     * Set condition
     *
     * @param string $condition
     *
     * @return TourHotel
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
     * @return TourHotel
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
     * Set hotel
     *
     * @param \AppBundle\Entity\Hotel $hotel
     *
     * @return TourHotel
     */
    public function setHotel(\AppBundle\Entity\Hotel $hotel = null)
    {
        $this->hotel = $hotel;

        return $this;
    }

    /**
     * Get hotel
     *
     * @return \AppBundle\Entity\Hotel
     */
    public function getHotel()
    {
        return $this->hotel;
    }
}
