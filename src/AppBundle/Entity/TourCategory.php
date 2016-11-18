<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * TourCategory
 *
 * @ORM\Table(name="tour_danhmuc")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\TourCategoryRepository")
 */
class TourCategory
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
     * @ORM\Column(name="slug", type="string")
     */
    private $slug;

    /**
     * @var string
     *
     * @ORM\Column(name="moTa", type="string")
     */
    private $description;

    /**
     * @var Tour
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Tour", mappedBy="category")
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
     * @return TourCategory
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
     * Set slug
     *
     * @param string $slug
     *
     * @return TourCategory
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get slug
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return TourCategory
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Add tour
     *
     * @param Tour $tour
     *
     * @return TourCategory
     */
    public function addTour(Tour $tour)
    {
        $this->tours[] = $tour;

        return $this;
    }

    /**
     * Remove tour
     *
     * @param Tour $tour
     */
    public function removeTour(Tour $tour)
    {
        $this->tours->removeElement($tour);
    }

    /**
     * Get tours
     *
     * @return Tour|ArrayCollection
     */
    public function getTours()
    {
        return $this->tours;
    }
}
