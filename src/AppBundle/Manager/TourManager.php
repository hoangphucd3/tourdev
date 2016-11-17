<?php

namespace AppBundle\Manager;

use Doctrine\ORM\EntityManager;

class TourManager
{
    protected $em;

    protected $tour;

    protected $tourRepository;

    public function __construct(EntityManager $em, $tour)
    {
        $this->em = $em;
        $this->tourRepository = $em->getRepository($tour);
    }

    protected function tourClass()
    {
        return $this->tour;
    }

    public function getAllTours()
    {
        $tours = $this->tourRepository->findAll();

        return $tours;
    }

    public function getPercentDiscount($regularPirce, $salePrice)
    {
        $percent = round((($regularPirce - $salePrice) / $regularPirce) * 100);

        $output = $percent;

        return $output;
    }
}