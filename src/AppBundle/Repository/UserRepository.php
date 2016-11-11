<?php

namespace AppBundle\Repository;

use AppBundle\Repository\AppUserInterface;

/**
 * UserRepository
 */
class UserRepository extends \Doctrine\ORM\EntityRepository implements AppUserInterface
{
    /**
     * {@inheritdoc}
     */
    public function findUsers()
    {
        return $this->findAll();
    }
}
