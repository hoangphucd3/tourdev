<?php

namespace AppBundle\Block;

use AppBundle\Manager\CommentManager;
use AppBundle\Manager\UserManager;
use Sonata\BlockBundle\Block\BlockContextInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Sonata\BlockBundle\Block\BaseBlockService;
use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;

class RecentUserCommentBlockService extends BaseBlockService
{
    private $commentManager;

    private $userManager;

    public function __construct($name, EngineInterface $templating, CommentManager $commentManager, UserManager $userManager)
    {
        $this->commentManager = $commentManager;
        $this->userManager = $userManager;

        parent::__construct($name, $templating);
    }

    /**
     * {@inheritdoc}
     */
    public function execute(BlockContextInterface $blockContext, Response $response = null)
    {
        $currentUser = $this->userManager->getCurrentUser()->getId();
        $comments = $this->userManager->getComments($currentUser);

        return $this->renderResponse($blockContext->getTemplate(), array(
            'comments' => $comments,
            'block' => $blockContext->getBlock(),
            'settings' => $blockContext->getSettings(),
        ), $response);
    }

    /**
     * {@inheritdoc}
     */
    public function configureSettings(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'template' => ':Block:recent_user_comment.html.twig',
        ));
    }
}