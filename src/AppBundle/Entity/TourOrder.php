<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * TourOrder
 *
 * @ORM\Table(name="don_dat_tour")
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
     * @var datetime
     *
     * @ORM\Column(name="TGTao", type="datetime")
     */
    private $createdAt;

    /**
     * @var datetime
     *
     * @ORM\Column(name="TGCapNhat", type="datetime")
     */
    private $updatedAt;

    /**
     * @var string
     *
     * @ORM\Column(name="ho", type="string")
     */
    private $billingLastName;

    /**
     * @var string
     *
     * @ORM\Column(name="ten", type="string")
     */
    private $billingFirstName;

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
     * @ORM\Column(name="diaChi_2", type="string", nullable=true)
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
     * @var int
     *
     * @ORM\Column(name="nguoiLon", type="integer")
     */
    private $numberOfAdults;

    /**
     * @var int
     *
     * @ORM\Column(name="treEm", type="integer")
     */
    private $numberOfChildren;

    /**
     * @var int
     *
     * @ORM\Column(name="emBe", type="integer")
     */
    private $numberOfInfants;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string")
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="PTThanhToan", type="string")
     */
    private $checkoutMethod;

    /**
     * @var string
     *
     * @ORM\Column(name="trangThai", type="string")
     */
    private $status;

    /**
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Customer", inversedBy="orders")
     * @ORM\JoinColumn(name="khachHang", referencedColumnName="id")
     */
    private $customer;

    /**
     * @var Tour
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Tour", inversedBy="tourOrders")
     * @ORM\JoinColumn(name="tour", referencedColumnName="id")
     */
    private $tour;

    /**
     * @var Invoice
     *
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\Invoice", mappedBy="tourOrder")
     */
    private $invoice;

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
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
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
     *
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
     * Set billingLastName
     *
     * @param string $billingLastName
     *
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
     * Set billingFirstName
     *
     * @param string $billingFirstName
     *
     * @return TourOrder
     */
    public function setBillingFirstName($billingFirstName)
    {
        $this->billingFirstName = $billingFirstName;

        return $this;
    }

    /**
     * Get billingFirstName
     *
     * @return string
     */
    public function getBillingFirstName()
    {
        return $this->billingFirstName;
    }

    /**
     * Set billingPhone
     *
     * @param string $billingPhone
     *
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
     *
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
     *
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
     *
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
     *
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
     *
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
     * Set numberOfAdults
     *
     * @param integer $numberOfAdults
     *
     * @return TourOrder
     */
    public function setNumberOfAdults($numberOfAdults)
    {
        $this->numberOfAdults = $numberOfAdults;

        return $this;
    }

    /**
     * Get numberOfAdults
     *
     * @return integer
     */
    public function getNumberOfAdults()
    {
        return $this->numberOfAdults;
    }

    /**
     * Set numberOfChildren
     *
     * @param integer $numberOfChildren
     *
     * @return TourOrder
     */
    public function setNumberOfChildren($numberOfChildren)
    {
        $this->numberOfChildren = $numberOfChildren;

        return $this;
    }

    /**
     * Get numberOfChildren
     *
     * @return integer
     */
    public function getNumberOfChildren()
    {
        return $this->numberOfChildren;
    }

    /**
     * Set numberOfInfants
     *
     * @param integer $numberOfInfants
     *
     * @return TourOrder
     */
    public function setNumberOfInfants($numberOfInfants)
    {
        $this->numberOfInfants = $numberOfInfants;

        return $this;
    }

    /**
     * Get numberOfInfants
     *
     * @return integer
     */
    public function getNumberOfInfants()
    {
        return $this->numberOfInfants;
    }

    /**
     * Set email
     *
     * @param string $email
     *
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
     * Set checkoutMethod
     *
     * @param string $checkoutMethod
     *
     * @return TourOrder
     */
    public function setCheckoutMethod($checkoutMethod)
    {
        $this->checkoutMethod = $checkoutMethod;

        return $this;
    }

    /**
     * Get checkoutMethod
     *
     * @return string
     */
    public function getCheckoutMethod()
    {
        return $this->checkoutMethod;
    }

    /**
     * Set status
     *
     * @param string $status
     *
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
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set customer
     *
     * @param Customer|null $customer
     * @return $this
     */
    public function setCustomer(Customer $customer = null)
    {
        $this->customer = $customer;

        return $this;
    }

    /**
     * Get customer
     *
     * @return User
     */
    public function getCustomer()
    {
        return $this->customer;
    }

    /**
     * Set tour
     *
     * @param Tour $tour
     *
     * @return TourOrder
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
     * Set invoice
     *
     * @param \AppBundle\Entity\Invoice $invoice
     *
     * @return TourOrder
     */
    public function setInvoice(\AppBundle\Entity\Invoice $invoice = null)
    {
        $this->invoice = $invoice;

        return $this;
    }

    /**
     * Get invoice
     *
     * @return \AppBundle\Entity\Invoice
     */
    public function getInvoice()
    {
        return $this->invoice;
    }
}
