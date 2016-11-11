<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TourInvoice
 *
 * @ORM\Table(name="tour_invoice")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\TourInvoiceRepository")
 */
class TourInvoice
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
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }
}

