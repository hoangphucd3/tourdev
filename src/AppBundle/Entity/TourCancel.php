<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TourCancel
 *
 * @ORM\Table(name="don_huy_tour")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\TourCancelRepository")
 */
class TourCancel
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
     * @ORM\Column(name="trangThai", type="string")
     */
    private $status;

    /**
     * @var Customer
     *
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\Customer")
     * @ORM\JoinColumn(name="customer_id", referencedColumnName="id")
     */
    private $customer;

    /**
     * @var TourOrder
     *
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\TourOrder")
     * @ORM\JoinColumn(name="order_id", referencedColumnName="id")
     */
    private $tourOrder;

    /**
     * @var datetime
     *
     * @ORM\Column(name="TGTao", type="datetime")
     */
    private $createdAt;

    public function __construct()
    {
        $this->createdAt = new \DateTime();
        $this->status = 'pending';
    }

    public function __toString()
    {
        return 'Đơn hủy tour #' . $this->id;
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
     * @param string $status
     *
     * @return TourCancel
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
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return TourCancel
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
     * Set customer
     *
     * @param \AppBundle\Entity\Customer $customer
     *
     * @return TourCancel
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
     * @return TourCancel
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
}
