<?php

namespace AppBundle\Entity;

use Application\Sonata\MediaBundle\Entity\Gallery;
use Application\Sonata\MediaBundle\Entity\Media;
use Doctrine\ORM\Mapping as ORM;
use FOS\ElasticaBundle\Annotation\Search;

/**
 * Tour
 *
 * @ORM\Table(name="tour")
 * @Search(repositoryClass="AppBundle\SearchRepository\TourRepository")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\TourRepository")
 */
class Tour
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
    private $tourName;

    /**
     * @var string
     *
     * @ORM\Column(name="slug", type="string")
     */
    private $slug;

    /**
     * @var string
     *
     * @ORM\Column(name="ngayBatDau", type="datetime")
     */
    private $startDate;

    /**
     * @var string
     *
     * @ORM\Column(name="ngayKetThuc", type="datetime")
     */
    private $endDate;

    /**
     * @var int
     *
     * @ORM\Column(name="soLuong", type="integer")
     */
    private $amount;

    /**
     * @var string
     *
     * @ORM\Column(name="moTa", type="text")
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="trangThai", type="string", nullable=true)
     */
    private $status;

    /**
     * @var int
     *
     * @ORM\Column(name="giaThongThuong", type="bigint")
     */
    private $regularPrice;

    /**
     * @var int
     *
     * @ORM\Column(name="giaBan", type="bigint", nullable=true)
     */
    private $salePrice;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\TourLocation", mappedBy="tour", cascade={"persist"}, orphanRemoval=true)
     */
    private $locations;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\TourHotel", mappedBy="tour", cascade={"persist"}, orphanRemoval=true)
     */
    private $hotels;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\TourService", mappedBy="tour", cascade={"persist"}, orphanRemoval=true)
     */
    private $services;
    /**
     * @var TourCategory
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\TourCategory", inversedBy="tours", cascade={"persist"})
     * @ORM\JoinColumn(onDelete="SET NULL")
     */
    private $category;

    /**
     * @var Media
     * @link http://bertrandg.github.io/symfony2-sonata-media-inline-validation-type-and-size/
     *
     * @ORM\OneToOne(targetEntity="Application\Sonata\MediaBundle\Entity\Media", cascade={"persist"})
     * @ORM\JoinColumn(onDelete="SET NULL")
     */
    private $featured_image;

    /**
     * @var Gallery
     *
     * @ORM\ManyToOne(targetEntity="Application\Sonata\MediaBundle\Entity\Gallery", cascade={"persist"})
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    private $gallery;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\TourBackground", mappedBy="tour", cascade={"persist"}, orphanRemoval=true)
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    private $backgrounds;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Comment", mappedBy="tour", cascade={"persist"}, orphanRemoval=true)
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    private $comments;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\TourOrder", mappedBy="tour")
     */
    private $tourOrders;

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
        $this->locations = new \Doctrine\Common\Collections\ArrayCollection();
        $this->hotels = new \Doctrine\Common\Collections\ArrayCollection();
        $this->backgrounds = new \Doctrine\Common\Collections\ArrayCollection();
        $this->comments = new \Doctrine\Common\Collections\ArrayCollection();
        $this->services = new \Doctrine\Common\Collections\ArrayCollection();
        $this->tourOrders = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set tourName
     *
     * @param string $tourName
     *
     * @return Tour
     */
    public function setTourName($tourName)
    {
        $this->tourName = $tourName;

        return $this;
    }

    /**
     * Get tourName
     *
     * @return string
     */
    public function getTourName()
    {
        return $this->tourName;
    }

    /**
     * Set startDate
     *
     * @param \DateTime $startDate
     *
     * @return Tour
     */
    public function setStartDate($startDate)
    {
        $this->startDate = $startDate;

        return $this;
    }

    /**
     * Get startDate
     *
     * @return \DateTime
     */
    public function getStartDate()
    {
        return $this->startDate;
    }

    /**
     * Set endDate
     *
     * @param \DateTime $endDate
     *
     * @return Tour
     */
    public function setEndDate($endDate)
    {
        $this->endDate = $endDate;

        return $this;
    }

    /**
     * Get endDate
     *
     * @return \DateTime
     */
    public function getEndDate()
    {
        return $this->endDate;
    }

    /**
     * Set amount
     *
     * @param integer $amount
     *
     * @return Tour
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;

        return $this;
    }

    /**
     * Get amount
     *
     * @return integer
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Tour
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
     * Set status
     *
     * @param string $status
     *
     * @return Tour
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set condition
     *
     * @param string $condition
     *
     * @return Tour
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
     * Add location
     *
     * @param \AppBundle\Entity\TourLocation $location
     *
     * @return Tour
     */
    public function addLocation(\AppBundle\Entity\TourLocation $location)
    {
        $location->setTour($this);

        $this->locations[] = $location;

        return $this;
    }

    /**
     * Remove location
     *
     * @param \AppBundle\Entity\TourLocation $location
     */
    public function removeLocation(\AppBundle\Entity\TourLocation $location)
    {
        $this->locations->removeElement($location);
    }

    /**
     * Set locations
     *
     * @param $locations
     * @return $this
     */
    public function setLocations($locations)
    {
        foreach ($locations as $location) {
            $this->addLocation($location);
        }

        return $this;
    }

    /**
     * Get locations
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getLocations()
    {
        return $this->locations;
    }

    /**
     * Add hotel
     *
     * @param \AppBundle\Entity\TourHotel $hotel
     *
     * @return Tour
     */
    public function addHotel(\AppBundle\Entity\TourHotel $hotel)
    {
        $hotel->setTour($this);

        $this->hotels[] = $hotel;

        return $this;
    }

    /**
     * Set hotels
     *
     * @param $hotels
     * @return $this
     */
    public function setHotels($hotels)
    {
        foreach ($hotels as $hotel) {
            $this->addHotel($hotel);
        }

        return $this;
    }

    /**
     * Remove hotel
     *
     * @param \AppBundle\Entity\TourHotel $hotel
     */
    public function removeHotel(\AppBundle\Entity\TourHotel $hotel)
    {
        $this->hotels->removeElement($hotel);
    }


    /**
     * Get hotels
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getHotels()
    {
        return $this->hotels;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->getTourName();
    }

    /**
     * Set regularPrice
     *
     * @param integer $regularPrice
     *
     * @return Tour
     */
    public function setRegularPrice($regularPrice)
    {
        $this->regularPrice = $regularPrice;

        return $this;
    }

    /**
     * Get regularPrice
     *
     * @return integer
     */
    public function getRegularPrice()
    {
        return $this->regularPrice;
    }

    /**
     * Set salePrice
     *
     * @param integer $salePrice
     *
     * @return Tour
     */
    public function setSalePrice($salePrice)
    {
        $this->salePrice = $salePrice;

        return $this;
    }

    /**
     * Get salePrice
     *
     * @return integer
     */
    public function getSalePrice()
    {
        return $this->salePrice;
    }

    /**
     * Set featuredImage
     *
     * @param \Application\Sonata\MediaBundle\Entity\Media $featuredImage
     *
     * @return Tour
     */
    public function setFeaturedImage(\Application\Sonata\MediaBundle\Entity\Media $featuredImage = null)
    {
        $this->featured_image = $featuredImage;

        return $this;
    }

    /**
     * Get featuredImage
     *
     * @return \Application\Sonata\MediaBundle\Entity\Media
     */
    public function getFeaturedImage()
    {
        return $this->featured_image;
    }

    /**
     * Set slug
     *
     * @param string $slug
     *
     * @return Tour
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
     * Set category
     *
     * @param \AppBundle\Entity\TourCategory $category
     *
     * @return Tour
     */
    public function setCategory(\AppBundle\Entity\TourCategory $category = null)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return \AppBundle\Entity\TourCategory
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Set gallery
     *
     * @param \Application\Sonata\MediaBundle\Entity\Gallery $gallery
     *
     * @return Tour
     */
    public function setGallery(\Application\Sonata\MediaBundle\Entity\Gallery $gallery = null)
    {
        $this->gallery = $gallery;

        return $this;
    }

    /**
     * Get gallery
     *
     * @return \Application\Sonata\MediaBundle\Entity\Gallery
     */
    public function getGallery()
    {
        return $this->gallery;
    }

    /**
     * Set backgrounds
     *
     * @param $backgrounds
     * @return $this
     */
    public function setBackgrounds($backgrounds)
    {
        foreach ($backgrounds as $background) {
            $this->addBackground($background);
        }

        return $this;
    }

    /**
     * Add background
     *
     * @param \AppBundle\Entity\TourBackground $background
     *
     * @return Tour
     */
    public function addBackground(\AppBundle\Entity\TourBackground $background)
    {
        $background->setTour($this);

        $this->backgrounds[] = $background;

        return $this;
    }

    /**
     * Remove background
     *
     * @param \AppBundle\Entity\TourBackground $background
     */
    public function removeBackground(\AppBundle\Entity\TourBackground $background)
    {
        $this->backgrounds->removeElement($background);
    }

    /**
     * Get backgrounds
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getBackgrounds()
    {
        return $this->backgrounds;
    }

    /**
     * Add comments
     *
     * @param \AppBundle\Entity\Comment $comments
     * @return Tour
     */
    public function addComment(\AppBundle\Entity\Comment $comments)
    {
        $this->comments[] = $comments;

        return $this;
    }

    /**
     * Remove comments
     *
     * @param \AppBundle\Entity\Comment $comments
     */
    public function removeComment(\AppBundle\Entity\Comment $comments)
    {
        $this->comments->removeElement($comments);
    }

    /**
     * Get comments
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getComments()
    {
        return $this->comments;
    }

    /**
     * Add service
     *
     * @param \AppBundle\Entity\TourService $service
     *
     * @return Tour
     */
    public function addService(\AppBundle\Entity\TourService $service)
    {
        $service->setTour($this);

        $this->services[] = $service;

        return $this;
    }


    /**
     * Set services
     *
     * @param $services
     * @return $this
     */
    public function setServices($services)
    {
        foreach ($services as $service) {
            $this->addLocation($service);
        }

        return $this;
    }

    /**
     * Remove service
     *
     * @param \AppBundle\Entity\TourService $service
     */
    public function removeService(\AppBundle\Entity\TourService $service)
    {
        $this->services->removeElement($service);
    }

    /**
     * Get services
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getServices()
    {
        return $this->services;
    }

    /**
     * Add tourOrder
     *
     * @param \AppBundle\Entity\TourOrder $tourOrder
     *
     * @return Tour
     */
    public function addTourOrder(\AppBundle\Entity\TourOrder $tourOrder)
    {
        $this->tourOrders[] = $tourOrder;

        return $this;
    }

    /**
     * Remove tourOrder
     *
     * @param \AppBundle\Entity\TourOrder $tourOrder
     */
    public function removeTourOrder(\AppBundle\Entity\TourOrder $tourOrder)
    {
        $this->tourOrders->removeElement($tourOrder);
    }

    /**
     * Get tourOrders
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTourOrders()
    {
        return $this->tourOrders;
    }
}
