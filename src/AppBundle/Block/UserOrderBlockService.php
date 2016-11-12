<?php

namespace AppBundle\Block;

use AppBundle\Manager\TourOrderManager;
use Sonata\BlockBundle\Block\BlockContextInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Sonata\BlockBundle\Block\BaseBlockService;
use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;

class UserOrderBlockService extends BaseBlockService
{
    private $tourOrderManager;

    public function __construct($name, EngineInterface $templating, TourOrderManager $tourOrderManager)
    {
        $this->tourOrderManager = $tourOrderManager;

        parent::__construct($name, $templating);
    }

    /**
     * {@inheritdoc}
     */
    public function execute(BlockContextInterface $blockContext, Response $response = null)
    {
        $orders = $this->tourOrderManager->getUserOrders();

        return $this->renderResponse($blockContext->getTemplate(), array(
            'orders' => $orders,
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
            'template' => ':Block:user_order.html.twig',
        ));
    }
}