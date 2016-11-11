<?php

namespace AppBundle\Entity;

use Application\Sonata\MediaBundle\Entity\Media;
use Doctrine\ORM\Mapping as ORM;

/**
 * Location
 *
 * @ORM\Table(name="dia_danh")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\LocationRepository")
 */
class Location
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
     * @ORM\Column(name="moTa", type="text", nullable=true)
     */
    private $description;

    /**
     * @var Media
     * @link http://stackoverflow.com/questions/14257004/doctrine2-symfony2-cascading-remove-integrity-constraint-violation-1451
     *
     * @ORM\OneToOne(targetEntity="Application\Sonata\MediaBundle\Entity\Media", cascade={"all"})
     * @ORM\JoinColumn(name="hinhAnh", referencedColumnName="id", onDelete="SET NULL")
     */
    private $featuredImage;

    /**
     * @var string
     *
     * @ORM\Column(name="diaDiem", type="string")
     */
    private $location;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\TourLocation", mappedBy="location", cascade={"persist"}, orphanRemoval=true)
     */
    private $tours;

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
     * Constructor
     */
    public function __construct()
    {
        $this->tours = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Location
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
     * Set description
     *
     * @param string $description
     *
     * @return Location
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
     * Set location
     *
     * @param string $location
     *
     * @return Location
     */
    public function setLocation($location)
    {
        $this->location = $location;

        return $this;
    }

    /**
     * Get location
     *
     * @return string
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * Set condition
     *
     * @param string $condition
     *
     * @return Location
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
     * Add tour
     *
     * @param \AppBundle\Entity\TourLocation $tour
     *
     * @return Location
     */
    public function addTour(\AppBundle\Entity\TourLocation $tour)
    {
        $this->tours[] = $tour;

        return $this;
    }

    /**
     * Remove tour
     *
     * @param \AppBundle\Entity\TourLocation $tour
     */
    public function removeTour(\AppBundle\Entity\TourLocation $tour)
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

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->getName();
    }

    /**
     * Set featuredImage
     *
     * @param \Application\Sonata\MediaBundle\Entity\Media $featuredImage
     *
     * @return Location
     */
    public function setFeaturedImage(\Application\Sonata\MediaBundle\Entity\Media $featuredImage = null)
    {
        $this->featuredImage = $featuredImage;

        return $this;
    }

    /**
     * Get featuredImage
     *
     * @return \Application\Sonata\MediaBundle\Entity\Media
     */
    public function getFeaturedImage()
    {
        return $this->featuredImage;
    }

    /**
     * Set slug
     *
     * @param string $slug
     * @return Location
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
}
