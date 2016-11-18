<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TourService
 *
 * @ORM\Table(name="tour_dichvu")
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
     * @return TourService
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
     * Set service
     *
     * @param Service $service
     *
     * @return TourService
     */
    public function setService(Service $service = null)
    {
        $this->service = $service;

        return $this;
    }

    /**
     * Get service
     *
     * @return Service
     */
    public function getService()
    {
        return $this->service;
    }
}
