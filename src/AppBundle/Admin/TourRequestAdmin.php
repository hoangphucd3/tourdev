<?php

namespace AppBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class TourRequestAdmin extends AbstractAdmin
{
    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('reason', null, array(
                    'label' => 'label.tour_request_reason'
                )
            )
            ->add('departure', null, array(
                    'label' => 'label.tour_request_departure'
                )
            )
            ->add('adults', null, array(
                    'label' => 'label.tour_request_adults'
                )
            )
//            ->add('children')
            ->add('infants', null, array(
                    'label' => 'label.tour_request_infants'
                )
            );
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('reason', null, array(
                    'label' => 'label.tour_request_reason'
                )
            )
            ->add('departure', null, array(
                    'label' => 'label.tour_request_departure'
                )
            )
            ->add('adults', null, array(
                    'label' => 'label.tour_request_adults'
                )
            )
//            ->add('children')
            ->add('infants', null, array(
                    'label' => 'label.tour_request_infants'
                )
            )
            ->add('_action', null, array(
                'actions' => array(
                    'show' => array(),
                    'edit' => array(),
                    'delete' => array(),
                )
            ));
    }

    /**
     * @param FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('reason', null, array(
                    'label' => 'label.tour_request_reason'
                )
            )
            ->add('departure', null, array(
                    'label' => 'label.tour_request_departure'
                )
            )
            ->add('adults', null, array(
                    'label' => 'label.tour_request_adults'
                )
            )
//            ->add('children')
            ->add('infants', null, array(
                    'label' => 'label.tour_request_infants'
                )
            )
            ->add('infants');
    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('reason', null, array(
                    'label' => 'label.tour_request_reason'
                )
            )
            ->add('departure', null, array(
                    'label' => 'label.tour_request_departure'
                )
            )
            ->add('adults', null, array(
                    'label' => 'label.tour_request_adults'
                )
            )
//            ->add('children')
            ->add('infants', null, array(
                    'label' => 'label.tour_request_infants'
                )
            );
    }
}
