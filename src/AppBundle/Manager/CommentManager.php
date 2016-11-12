<?php

namespace AppBundle\Manager;

use AppBundle\Entity\Comment;
use Doctrine\ORM\EntityManager;

class CommentManager
{
    protected $em;

    protected $comment;

    protected $commentRepository;

    public function __construct(EntityManager $em, $comment)
    {
        $this->em = $em;
        $this->commentRepository = $em->getRepository($comment);
    }

    protected function commentClass()
    {
        return $this->comment;
    }

    public function createComment(Comment $comment)
    {
        $this->em->persist($comment);
        $this->em->flush();

        return true;
    }
}