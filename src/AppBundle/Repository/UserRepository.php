<?php

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * UserRepository
 */
class UserRepository extends EntityRepository implements AppUserInterface
{
    /**
     * {@inheritdoc}
     */
    public function findUsers()
    {
        return $this->findAll();
    }

    public function getUserComments($userID)
    {
        return $this->find($userID)->getComments();
    }
}
