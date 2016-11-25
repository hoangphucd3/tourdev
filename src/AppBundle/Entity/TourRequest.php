<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TourRequest
 *
 * @ORM\Table(name="tour_yeucau")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\TourRequestRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class TourRequest
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
     * @var text
     * @ORM\Column(name="noiDung", type="text")
     */
    private $content;

    /**
     * @var string
     *
     * @ORM\Column(name="trangThai", type="string")
     */
    private $status;

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
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Customer", inversedBy="touRequests")
     */
    private $user;

    /**
     * @var Tour
     *
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\TourOrder")
     */
    private $tourOrder;

    public function __construct()
    {
        $this->createdAt = new \DateTime();
        $this->updatedAt = new \DateTime();
        $this->status = 'pending';
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
     * @return TourRequest
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
     * @return TourRequest
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
     * @return TourRequest
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
     * Set user
     *
     * @param Customer $user
     *
     * @return TourRequest
     */
    public function setUser(Customer $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set tourOrder
     *
     * @param TourOrder $tourOrder
     *
     * @return TourRequest
     */
    public function setTourOrder(TourOrder $tourOrder = null)
    {
        $this->tourOrder = $tourOrder;

        return $this;
    }

    /**
     * Get tourOrder
     *
     * @return TourOrder
     */
    public function getTourOrder()
    {
        return $this->tourOrder;
    }

    /**
     * Set content
     *
     * @param string $content
     *
     * @return TourRequest
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content
     *
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    public function __toString()
    {
        return 'Đơn yêu cầu sửa tour #' . $this->id;
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
}
