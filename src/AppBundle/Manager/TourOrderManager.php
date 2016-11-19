<?php

namespace AppBundle\Manager;


use AppBundle\Entity\TourOrder;
use Doctrine\ORM\EntityManager;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;

class TourOrderManager
{
    protected $em;

    protected $tokenStorage;

    protected $tourOrder;

    protected $tourOrderRepository;

    public function __construct(TokenStorage $tokenStorage, EntityManager $em, $tourOrder)
    {
        $this->em = $em;
        $this->tourOrderRepository = $em->getRepository($tourOrder);
        $this->tokenStorage = $tokenStorage;
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

    public function getUserOrders()
    {
        $findBy = array(
            'customer' => $this->getCustomer(),
        );

        return $this->tourOrderRepository->getUserOrders($findBy);
    }

    private function getCustomer()
    {
        $user = $this->tokenStorage->getToken()->getUser();

        $customer = $this->em->getRepository('AppBundle:Customer')->findOneBy(array('user' => $user));

        return $customer;
    }
}