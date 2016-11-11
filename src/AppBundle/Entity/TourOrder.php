<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * TourOrder
 *
 * @ORM\Table(name="tour_order")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\TourOrderRepository")
 */
class TourOrder
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
     * @var int
     *
     * @ORM\Column(name="trangThai", type="integer")
     */
    private $status;

    /**
     * @var datetime
     *
     * @ORM\Column(name="thoiGianTao", type="datetime")
     */
    private $createdAt;

    /**
     * @var datetime
     *
     * @ORM\Column(name="thoigianCapNhat", type="datetime")
     */
    private $updatedAt;

    /**
     * @var string
     *
     * @ORM\Column(name="ten", type="string")
     */
    private $billingFirsttName;

    /**
     * @var string
     *
     * @ORM\Column(name="ho", type="string")
     */
    private $billingLastName;

    /**
     * @var string
     *
     * @ORM\Column(name="dienThoai", type="string")
     */
    private $billingPhone;

    /**
     * @var string
     *
     * @ORM\Column(name="diaChi_1", type="string")
     */
    private $billingAddress1;

    /**
     * @var string
     *
     * @ORM\Column(name="diaChi_2", type="string")
     */
    private $billingAddress2;

    /**
     * @var string
     *
     * @ORM\Column(name="thanhPho", type="string")
     */
    private $billingCity;

    /**
     * @var string
     *
     * @ORM\Column(name="maBuuChinh", type="string")
     */
    private $billingPostCode;

    /**
     * @var string
     *
     * @ORM\Column(name="datNuoc", type="string")
     */
    private $country;

    /**
     * @var date
     *
     * @ORM\Column(name="ngayKhoiHanh", type="date")
     */
    private $departure;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string")
     */
    private $email;

    /**
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User", inversedBy="orders")
     * @ORM\JoinColumn(name="khachHang", referencedColumnName="id")
     */
    private $customer;

    /**
     * @var Tour
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Tour")
     * @ORM\JoinColumn(name="tour", referencedColumnName="id")
     */
    private $tour;

    public function __construct()
    {
        $this->createdAt = new \DateTime();
        $this->updatedAt = new \DateTime();
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
     * Set status
     *
     * @param integer $status
     * @return TourOrder
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return integer 
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return TourOrder
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime 
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     * @return TourOrder
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime 
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Set billingFirsttName
     *
     * @param string $billingFirsttName
     * @return TourOrder
     */
    public function setBillingFirsttName($billingFirsttName)
    {
        $this->billingFirsttName = $billingFirsttName;

        return $this;
    }

    /**
     * Get billingFirsttName
     *
     * @return string 
     */
    public function getBillingFirsttName()
    {
        return $this->billingFirsttName;
    }

    /**
     * Set billingLastName
     *
     * @param string $billingLastName
     * @return TourOrder
     */
    public function setBillingLastName($billingLastName)
    {
        $this->billingLastName = $billingLastName;

        return $this;
    }

    /**
     * Get billingLastName
     *
     * @return string 
     */
    public function getBillingLastName()
    {
        return $this->billingLastName;
    }

    /**
     * Set billingPhone
     *
     * @param string $billingPhone
     * @return TourOrder
     */
    public function setBillingPhone($billingPhone)
    {
        $this->billingPhone = $billingPhone;

        return $this;
    }

    /**
     * Get billingPhone
     *
     * @return string 
     */
    public function getBillingPhone()
    {
        return $this->billingPhone;
    }

    /**
     * Set billingAddress1
     *
     * @param string $billingAddress1
     * @return TourOrder
     */
    public function setBillingAddress1($billingAddress1)
    {
        $this->billingAddress1 = $billingAddress1;

        return $this;
    }

    /**
     * Get billingAddress1
     *
     * @return string 
     */
    public function getBillingAddress1()
    {
        return $this->billingAddress1;
    }

    /**
     * Set billingAddress2
     *
     * @param string $billingAddress2
     * @return TourOrder
     */
    public function setBillingAddress2($billingAddress2)
    {
        $this->billingAddress2 = $billingAddress2;

        return $this;
    }

    /**
     * Get billingAddress2
     *
     * @return string 
     */
    public function getBillingAddress2()
    {
        return $this->billingAddress2;
    }

    /**
     * Set billingCity
     *
     * @param string $billingCity
     * @return TourOrder
     */
    public function setBillingCity($billingCity)
    {
        $this->billingCity = $billingCity;

        return $this;
    }

    /**
     * Get billingCity
     *
     * @return string 
     */
    public function getBillingCity()
    {
        return $this->billingCity;
    }

    /**
     * Set billingPostCode
     *
     * @param string $billingPostCode
     * @return TourOrder
     */
    public function setBillingPostCode($billingPostCode)
    {
        $this->billingPostCode = $billingPostCode;

        return $this;
    }

    /**
     * Get billingPostCode
     *
     * @return string 
     */
    public function getBillingPostCode()
    {
        return $this->billingPostCode;
    }

    /**
     * Set country
     *
     * @param string $country
     * @return TourOrder
     */
    public function setCountry($country)
    {
        $this->country = $country;

        return $this;
    }

    /**
     * Get country
     *
     * @return string 
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Set departure
     *
     * @param \DateTime $departure
     * @return TourOrder
     */
    public function setDeparture($departure)
    {
        $this->departure = $departure;

        return $this;
    }

    /**
     * Get departure
     *
     * @return \DateTime 
     */
    public function getDeparture()
    {
        return $this->departure;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return TourOrder
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set customer
     *
     * @param \AppBundle\Entity\User $customer
     * @return TourOrder
     */
    public function setCustomer(\AppBundle\Entity\User $customer = null)
    {
        $this->customer = $customer;

        return $this;
    }

    /**
     * Get customer
     *
     * @return \AppBundle\Entity\User 
     */
    public function getCustomer()
    {
        return $this->customer;
    }

    /**
     * Set tour
     *
     * @param \AppBundle\Entity\Tour $tour
     * @return TourOrder
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
}
