<?php

namespace AppBundle\Manager;

use Doctrine\ORM\EntityManager;
use Symfony\Component\DependencyInjection\ContainerInterface;

class UserManager
{
    protected $container;

    protected $em;

    protected $user;

    protected $userRepository;

    public function __construct(ContainerInterface $container, EntityManager $em, $user)
    {
        $this->container = $container;
        $this->em = $em;
        $this->userRepository = $em->getRepository($user);
    }

    protected function userClass()
    {
        return $this->tour;
    }

    public function getCurrentUser()
    {
        return $this->container->get('security.token_storage')->getToken()->getUser();
    }

    public function getComments($userID)
    {
        return $this->userRepository->getUserComments($userID);
    }
}