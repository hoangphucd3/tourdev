<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TourRequest
 *
 * @ORM\Table(name="tour_yeucau")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\TourRequestRepository")
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
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User", inversedBy="touRequests")
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
     * Set numberOfAdults
     *
     * @param integer $numberOfAdults
     *
     * @return TourRequest
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
     * @return TourRequest
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
     * @return TourRequest
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
     * @param User $user
     *
     * @return TourRequest
     */
    public function setUser(User $user = null)
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
}
