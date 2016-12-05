<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Transportation
 *
 * @ORM\Table(name="transportation")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\TransportationRepository")
 */
class Transportation
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
     * @ORM\Column(name="loaiPT", type="string")
     */
    private $type;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\TourTransportation", mappedBy="transportation", cascade={"persist"}, orphanRemoval=true)
     */
    private $tours;

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
     * Set type
     *
     * @param string $type
     *
     * @return Transportation
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->tours = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add tour
     *
     * @param \AppBundle\Entity\TourTransportation $tour
     *
     * @return Transportation
     */
    public function addTour(\AppBundle\Entity\TourTransportation $tour)
    {
        $this->tours[] = $tour;

        return $this;
    }

    /**
     * Remove tour
     *
     * @param \AppBundle\Entity\TourTransportation $tour
     */
    public function removeTour(\AppBundle\Entity\TourTransportation $tour)
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
}
