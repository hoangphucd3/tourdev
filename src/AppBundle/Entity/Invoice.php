<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Invoice
 *
 * @ORM\Table(name="hoa_don")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\InvoiceRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Invoice
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
     * @var float
     *
     * @ORM\Column(name="tongCong", type="float")
     */
    private $totalPrice;

    /**
     * @var string
     * @ORM\Column(name="trangThai", type="string")
     */
    private $status;

    /**
     * @var Customer
     *@ORM\ManyToOne(targetEntity="AppBundle\Entity\Customer", cascade={"persist", "refresh", "merge", "detach"})
     * @ORM\JoinColumn(name="customer_id", referencedColumnName="id", onDelete="SET NULL")
     */
    private $customer;

    /**
     * @var TourOrder
     *
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\TourOrder", inversedBy="invoice")
     * @ORM\JoinColumn(name="tour_order_id", referencedColumnName="id", onDelete="CASCADE")
     */
    private $tourOrder;

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
     * Set totalPrice
     *
     * @param float $totalPrice
     *
     * @return Invoice
     */
    public function setTotalPrice($totalPrice)
    {
        $this->totalPrice = $totalPrice;

        return $this;
    }

    /**
     * Get totalPrice
     *
     * @return float
     */
    public function getTotalPrice()
    {
        return $this->totalPrice;
    }

    /**
     * Set status
     *
     * @param string $status
     *
     * @return Invoice
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
     * @param \AppBundle\Entity\Customer $customer
     *
     * @return Invoice
     */
    public function setCustomer(\AppBundle\Entity\Customer $customer = null)
    {
        $this->customer = $customer;

        return $this;
    }

    /**
     * Get customer
     *
     * @return \AppBundle\Entity\Customer
     */
    public function getCustomer()
    {
        return $this->customer;
    }

    /**
     * Set tourOrder
     *
     * @param \AppBundle\Entity\TourOrder $tourOrder
     *
     * @return Invoice
     */
    public function setTourOrder(\AppBundle\Entity\TourOrder $tourOrder = null)
    {
        $this->tourOrder = $tourOrder;

        return $this;
    }

    /**
     * Get tourOrder
     *
     * @return \AppBundle\Entity\TourOrder
     */
    public function getTourOrder()
    {
        return $this->tourOrder;
    }

    public function __toString()
    {
        return 'Hóa đơn #' . $this->id;
    }

    /**
     * @ORM\PrePersist()
     */
    public function prePersist()
    {
        $this->setUpdatedAt(new \DateTime());
    }

    /**
     * @ORM\PreUpdate()
     */
    public function preUpdate()
    {
        $this->setUpdatedAt(new \DateTime());
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return Invoice
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
     * @return Invoice
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
}
