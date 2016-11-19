<?php

namespace AppBundle\Entity;

use Application\Sonata\MediaBundle\Entity\Media;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Location
 *
 * @ORM\Table(name="dia_diem")
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
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\TourLocation", mappedBy="location", cascade={"persist"}, orphanRemoval=true)
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
     * @param TourLocation $tour
     * @return $this
     */
    public function addTour(TourLocation $tour)
    {
        $this->tours[] = $tour;

        return $this;
    }

    /**
     * Remove tour
     *
     * @param TourLocation $tour
     */
    public function removeTour(TourLocation $tour)
    {
        $this->tours->removeElement($tour);
    }

    /**
     * Get tours
     *
     * @return ArrayCollection
     */
    public function getTours()
    {
        return $this->tours;
    }

    /**
     * Set featuredImage
     *
     * @param Media|null $featuredImage
     * @return $this
     */
    public function setFeaturedImage(Media $featuredImage = null)
    {
        $this->featuredImage = $featuredImage;

        return $this;
    }

    /**
     * Get featuredImage
     *
     * @return Media
     */
    public function getFeaturedImage()
    {
        return $this->featuredImage;
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
     * Set slug
     *
     * @param string $slug
     *
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

    public function __toString()
    {
        return $this->name;
    }
}
