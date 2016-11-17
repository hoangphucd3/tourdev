<?php

namespace AppBundle\Entity;

use Application\Sonata\MediaBundle\Entity\Media;
use Doctrine\ORM\Mapping as ORM;

/**
 * TourBackground
 *
 * @ORM\Table(name="tour_hinhnen")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\TourBackgroundRepository")
 */
class TourBackground
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
     * @ORM\Column(name="thuTu", type="integer")
     */
    private $position;

    /**
     * @var Tour
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Tour", inversedBy="backgrounds")
     * @ORM\JoinColumn(name="tour_id", referencedColumnName="id", onDelete="CASCADE")
     */
    private $tour;

    /**
     * @var Media
     *
     * @ORM\ManyToOne(targetEntity="Application\Sonata\MediaBundle\Entity\Media")
     * @ORM\JoinColumn(name="media_id", referencedColumnName="id", onDelete="CASCADE")
     */
    private $media;

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
     * Set tour
     *
     * @param \AppBundle\Entity\Tour $tour
     *
     * @return TourBackground
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

    /**
     * Set media
     *
     * @param \Application\Sonata\MediaBundle\Entity\Media $media
     *
     * @return TourBackground
     */
    public function setMedia(\Application\Sonata\MediaBundle\Entity\Media $media = null)
    {
        $this->media = $media;

        return $this;
    }

    /**
     * Get media
     *
     * @return \Application\Sonata\MediaBundle\Entity\Media
     */
    public function getMedia()
    {
        return $this->media;
    }

    /**
     * Set position
     *
     * @param integer $position
     *
     * @return TourBackground
     */
    public function setPosition($position)
    {
        $this->position = $position;

        return $this;
    }

    /**
     * Get position
     *
     * @return integer
     */
    public function getPosition()
    {
        return $this->position;
    }
}
