<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use ONGR\ElasticsearchBundle\Tests\app\fixture\Acme\FooBundle\Document\Customer;

/**
 * TourRequest
 *
 * @ORM\Table(name="tour_request")
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
     * @var string
     *
     * @ORM\Column(name="lyDo", type="text")
     */
    private $reason;

    /**
     * @var date
     *
     * @ORM\Column(name="ngayKhoiHanh", type="date")
     */

    private $departure;

    /**
     * @var int
     *
     * @ORM\Column(name="nguoiLon", type="integer")
     */
    private $adults;

    /**
     * @var int
     *
     * @ORM\Column(name="treEm", type="integer")
     */
    private $children;

    /**
     * @var int
     *
     * @ORM\Column(name="emBe", type="integer")
     */
    private $infants;

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
     * Set reason
     *
     * @param string $reason
     *
     * @return TourRequest
     */
    public function setReason($reason)
    {
        $this->reason = $reason;

        return $this;
    }

    /**
     * Get reason
     *
     * @return string
     */
    public function getReason()
    {
        return $this->reason;
    }

    /**
     * Set departure
     *
     * @param \DateTime $departure
     *
     * @return TourRequest
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
     * Set adults
     *
     * @param integer $adults
     *
     * @return TourRequest
     */
    public function setAdults($adults)
    {
        $this->adults = $adults;

        return $this;
    }

    /**
     * Get adults
     *
     * @return integer
     */
    public function getAdults()
    {
        return $this->adults;
    }

    /**
     * Set children
     *
     * @param integer $children
     *
     * @return TourRequest
     */
    public function setChildren($children)
    {
        $this->children = $children;

        return $this;
    }

    /**
     * Get children
     *
     * @return integer
     */
    public function getChildren()
    {
        return $this->children;
    }

    /**
     * Set infants
     *
     * @param integer $infants
     *
     * @return TourRequest
     */
    public function setInfants($infants)
    {
        $this->infants = $infants;

        return $this;
    }

    /**
     * Get infants
     *
     * @return integer
     */
    public function getInfants()
    {
        return $this->infants;
    }

    /**
     * Set user
     *
     * @param \AppBundle\Entity\User $user
     *
     * @return TourRequest
     */
    public function setUser(\AppBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \AppBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set tourOrder
     *
     * @param \AppBundle\Entity\TourOrder $tourOrder
     *
     * @return TourRequest
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
