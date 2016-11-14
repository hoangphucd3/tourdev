<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TourService
 *
 * @ORM\Table(name="tour_service")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\TourServiceRepository")
 */
class TourService
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
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Tour", inversedBy="services")
     * @ORM\JoinColumn(name="tour_id", referencedColumnName="id")
     */
    private $tour;

    /**
     * @var Service
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Service", inversedBy="tours")
     * @ORM\JoinColumn(name="service_id", referencedColumnName="id")
     */
    private $service;

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
     * Set tour
     *
     * @param \AppBundle\Entity\Tour $tour
     *
     * @return TourService
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
     * Set service
     *
     * @param \AppBundle\Entity\Service $service
     *
     * @return TourService
     */
    public function setService(\AppBundle\Entity\Service $service = null)
    {
        $this->service = $service;

        return $this;
    }

    /**
     * Get service
     *
     * @return \AppBundle\Entity\Service
     */
    public function getService()
    {
        return $this->service;
    }
}
