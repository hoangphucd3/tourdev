<?php

namespace AppBundle\EventListener;

use Sonata\AdminBundle\Event\ConfigureMenuEvent;

class MenuBuilderListener
{
    public function addMenuItems(ConfigureMenuEvent $event)
    {
        $menu = $event->getMenu();

        $child = $menu->addChild('reports', array(
            'extras' => array('icon' => '<i class="fa fa-bar-chart"></i>'),
        ));

        $child->setLabel('Thống kê');

        $child
            ->addChild('revenue', array(
                    'route' => 'admin_revenue_report',
                )
            )
            ->setLabel('Doanh thu');
        $child
            ->addChild('tour', array(
                    'route' => 'admin_tour_report',
                )
            )
            ->setLabel('Tour');
    }
}