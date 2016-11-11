<?php

namespace AppBundle\Service;

use Doctrine\ORM\EntityRepository;

class UserManagerService
{
    protected $repository;

    public function __construct(EntityRepository $repository)
    {
        $this->repository = $repository;
    }

    public function findUsers() {
        return $this->repository->findUsers();
    }

}