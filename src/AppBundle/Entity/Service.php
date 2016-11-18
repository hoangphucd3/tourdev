<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Service
 *
 * @ORM\Table(name="dich_vu")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ServiceRepository")
 */
class Service
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
     * @ORM\Column(name="icon", type="string", nullable=true)
     */
    private $icon;

    /**
     * @var TourService
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\TourService", mappedBy="service", cascade={"persist"}, orphanRemoval=true)
     */
    private $tours;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->tours = new ArrayCollection();
    }

    /**
     * Add tour
     *
     * @param TourService $tour
     * @return $this
     */
    public function addTour(TourService $tour)
    {
        $this->tours[] = $tour;

        return $this;
    }

    /**
     * Remove tour
     *
     * @param TourService $tour
     */
    public function removeTour(TourService $tour)
    {
        $this->tours->removeElement($tour);
    }

    /**
     * Get tours
     *
     * @return TourService|ArrayCollection
     */
    public function getTours()
    {
        return $this->tours;
    }

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
     * Set name
     *
     * @param string $name
     *
     * @return Service
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
     * Set icon
     *
     * @param string $icon
     *
     * @return Service
     */
    public function setIcon($icon)
    {
        $this->icon = $icon;

        return $this;
    }

    /**
     * Get icon
     *
     * @return string
     */
    public function getIcon()
    {
        return $this->icon;
    }
}
