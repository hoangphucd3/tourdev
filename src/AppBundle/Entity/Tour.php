<?php

namespace AppBundle\Entity;

use Application\Sonata\MediaBundle\Entity\Gallery;
use Application\Sonata\MediaBundle\Entity\Media;
use Doctrine\ORM\Mapping as ORM;
use FOS\ElasticaBundle\Annotation\Search;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;

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
     * @var date
     *
     * @ORM\Column(name="ngayKhoiHanh", type="date")
     */
    private $startDate;

    /**
     * @var int
     *
     * @ORM\Column(name="thoiGian", type="integer")
     * @Assert\GreaterThan(value="0")
     */
    private $duration;

    /**
     * @var int
     *
     * @ORM\Column(name="soLuongNguoi", type="integer")
     */
    private $numberOfPeople;

    /**
     * @var string
     *
     * @ORM\Column(name="moTa", type="text", nullable=true)
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
     * @ORM\Column(name="giaGoc", type="bigint")
     */
    private $regularPrice;

    /**
     * @var int
     *
     * @ORM\Column(name="giaKhuyenMai", type="bigint", nullable=true)
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
     * @ORM\JoinColumn(onDelete="SET NULL")
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
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\TourOrder", mappedBy="tour", cascade={"persist"}, orphanRemoval=true)
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    private $tourOrders;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->locations = new ArrayCollection();
        $this->hotels = new ArrayCollection();
        $this->backgrounds = new ArrayCollection();
        $this->comments = new ArrayCollection();
        $this->services = new ArrayCollection();
        $this->tourOrders = new ArrayCollection();
    }

    /**
     * Add location
     *
     * @param TourLocation $location
     * @return $this
     */
    public function addLocation(TourLocation $location)
    {
        $location->setTour($this);

        $this->locations[] = $location;

        return $this;
    }

    /**
     * Remove location
     *
     * @param TourLocation $location
     */
    public function removeLocation(TourLocation $location)
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
     * @return ArrayCollection
     */
    public function getLocations()
    {
        return $this->locations;
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
     * Get hotels
     *
     * @return ArrayCollection
     */
    public function getHotels()
    {
        return $this->hotels;
    }

    /**
     * Add hotel
     *
     * @param TourHotel $hotel
     *
     * @return Tour
     */
    public function addHotel(TourHotel $hotel)
    {
        $hotel->setTour($this);

        $this->hotels[] = $hotel;

        return $this;
    }

    /**
     * Remove hotel
     *
     * @param TourHotel $hotel
     */
    public function removeHotel(TourHotel $hotel)
    {
        $this->hotels->removeElement($hotel);
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
     * Get backgrounds
     *
     * @return ArrayCollection
     */
    public function getBackgrounds()
    {
        return $this->backgrounds;
    }

    /**
     * Add background
     *
     * @param TourBackground $background
     *
     * @return Tour
     */
    public function addBackground(TourBackground $background)
    {
        $background->setTour($this);

        $this->backgrounds[] = $background;

        return $this;
    }

    /**
     * Remove background
     *
     * @param TourBackground $background
     */
    public function removeBackground(TourBackground $background)
    {
        $this->backgrounds->removeElement($background);
    }

    /**
     * Add comments
     *
     * @param Comment $comments
     * @return Tour
     */
    public function addComment(Comment $comments)
    {
        $this->comments[] = $comments;

        return $this;
    }

    /**
     * Remove comments
     *
     * @param Comment $comments
     */
    public function removeComment(Comment $comments)
    {
        $this->comments->removeElement($comments);
    }

    /**
     * Get comments
     *
     * @return ArrayCollection
     */
    public function getComments()
    {
        return $this->comments;
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
            $this->addService($service);
        }

        return $this;
    }

    /**
     * Get services
     *
     * @return ArrayCollection
     */
    public function getServices()
    {
        return $this->services;
    }

    /**
     * Add service
     *
     * @param TourService $service
     *
     * @return Tour
     */
    public function addService(TourService $service)
    {
        $service->setTour($this);

        $this->services[] = $service;

        return $this;
    }

    /**
     * Remove service
     *
     * @param TourService $service
     */
    public function removeService(TourService $service)
    {
        $this->services->removeElement($service);
    }

    /**
     * Add tourOrder
     *
     * @param TourOrder $tourOrder
     *
     * @return Tour
     */
    public function addTourOrder(TourOrder $tourOrder)
    {
        $this->tourOrders[] = $tourOrder;

        return $this;
    }

    /**
     * Remove tourOrder
     *
     * @param TourOrder $tourOrder
     */
    public function removeTourOrder(TourOrder $tourOrder)
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

    /**
     * @Assert\IsTrue(message = "admin.sale_price_error")
     */
    public function isSalePriceLegal()
    {
        if ($this->salePrice >= $this->regularPrice) {
            return false;
        } else {
            return true;
        }
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
     * Set duration
     *
     * @param integer $duration
     *
     * @return Tour
     */
    public function setDuration($duration)
    {
        $this->duration = $duration;

        return $this;
    }

    /**
     * Get duration
     *
     * @return integer
     */
    public function getDuration()
    {
        return $this->duration;
    }

    /**
     * Set numberOfPeople
     *
     * @param integer $numberOfPeople
     *
     * @return Tour
     */
    public function setNumberOfPeople($numberOfPeople)
    {
        $this->numberOfPeople = $numberOfPeople;

        return $this;
    }

    /**
     * Get numberOfPeople
     *
     * @return integer
     */
    public function getNumberOfPeople()
    {
        return $this->numberOfPeople;
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
     * Set featuredImage
     *
     * @param Media $featuredImage
     *
     * @return Tour
     */
    public function setFeaturedImage(Media $featuredImage = null)
    {
        $this->featured_image = $featuredImage;

        return $this;
    }

    /**
     * Get featuredImage
     *
     * @return Media
     */
    public function getFeaturedImage()
    {
        return $this->featured_image;
    }

    /**
     * Set gallery
     *
     * @param Gallery $gallery
     *
     * @return Tour
     */
    public function setGallery(Gallery $gallery = null)
    {
        $this->gallery = $gallery;

        return $this;
    }

    /**
     * Get gallery
     *
     * @return Gallery
     */
    public function getGallery()
    {
        return $this->gallery;
    }

    public function __toString()
    {
        return $this->tourName;
    }
}
