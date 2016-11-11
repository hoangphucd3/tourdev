<?php

namespace AppBundle\Manager;


use AppBundle\Entity\TourOrder;
use Doctrine\ORM\EntityManager;

class TourOrderManager
{
    protected $em;

    protected $tourOrder;

    protected $tourOrderRepository;

    public function __construct(EntityManager $em, $tourOrder)
    {
        $this->em = $em;
        $this->tourOrderRepository = $em->getRepository($tourOrder);
    }

    protected function tourOrderClass()
    {
        return $this->tourOrder;
    }

    public function createTourOrder(TourOrder $tourOrder)
    {
        $this->em->persist($tourOrder);
        $this->em->flush();

        return true;
    }
}