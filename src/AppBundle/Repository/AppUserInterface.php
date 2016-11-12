<?php

namespace AppBundle\Repository;

//use Doctrine\Common\Persistence\ObjectRepository;

interface AppUserInterface
{
    /**
     * Returns a collection with all user instances.
     */
    public function findUsers();

    public function getUserComments($userID);
}