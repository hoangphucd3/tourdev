<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TourTransportation
 *
 * @ORM\Table(name="tour_transportation")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\TourTransportationRepository")
 */
class TourTransportation
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
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Tour", inversedBy="transportations")
     * @ORM\JoinColumn(name="tour_id", referencedColumnName="id", onDelete="CASCADE")
     */
    private $tour;

    /**
     * @var Transportation
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Transportation", inversedBy="tours")
     * @ORM\JoinColumn(name="transportation_id", referencedColumnName="id", onDelete="CASCADE")
     */
    private $transportation;

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
     * @param \AppBundle\Entity\Tour $tour
     *
     * @return TourTransportation
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
     * Set transportation
     *
     * @param \AppBundle\Entity\Transportation $transportation
     *
     * @return TourTransportation
     */
    public function setTransportation(\AppBundle\Entity\Transportation $transportation = null)
    {
        $this->transportation = $transportation;

        return $this;
    }

    /**
     * Get transportation
     *
     * @return \AppBundle\Entity\Transportation
     */
    public function getTransportation()
    {
        return $this->transportation;
    }
}
