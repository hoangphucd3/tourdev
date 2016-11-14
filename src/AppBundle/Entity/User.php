<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Sonata\UserBundle\Entity\BaseUser as BaseUser;

/**
 * User
 *
 * @ORM\Table(name="fos_user")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\UserRepository")
 */
class User extends BaseUser
{

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Comment", mappedBy="user", cascade={"persist"})
     */
    private $comments;

    /**
     * @var TourOrder
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\TourOrder", mappedBy="customer", cascade={"persist"})
     */
    private $orders;

    /**
     * @var TourRequest
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\TourRequest", mappedBy="customer", cascade={"persist"})
     */
    private $touRequests;

    public function __construct()
    {
        parent::__construct();
        $this->comments = new ArrayCollection();
        $this->orders = new ArrayCollection();
        $this->touRequests = new ArrayCollection();
    }

    /**
     * Add comments
     *
     * @param \AppBundle\Entity\Comment $comments
     * @return User
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
     * Add orders
     *
     * @param \AppBundle\Entity\TourOrder $orders
     * @return User
     */
    public function addOrder(\AppBundle\Entity\TourOrder $orders)
    {
        $this->orders[] = $orders;

        return $this;
    }

    /**
     * Remove orders
     *
     * @param \AppBundle\Entity\TourOrder $orders
     */
    public function removeOrder(\AppBundle\Entity\TourOrder $orders)
    {
        $this->orders->removeElement($orders);
    }

    /**
     * Get orders
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getOrders()
    {
        return $this->orders;
    }

    /**
     * Add touRequest
     *
     * @param \AppBundle\Entity\TourRequest $touRequest
     *
     * @return User
     */
    public function addTouRequest(\AppBundle\Entity\TourRequest $touRequest)
    {
        $this->touRequests[] = $touRequest;

        return $this;
    }

    /**
     * Remove touRequest
     *
     * @param \AppBundle\Entity\TourRequest $touRequest
     */
    public function removeTouRequest(\AppBundle\Entity\TourRequest $touRequest)
    {
        $this->touRequests->removeElement($touRequest);
    }

    /**
     * Get touRequests
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTouRequests()
    {
        return $this->touRequests;
    }
}
