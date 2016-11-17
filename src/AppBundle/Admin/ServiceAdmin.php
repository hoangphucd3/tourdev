<?php

namespace AppBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class ServiceAdmin extends AbstractAdmin
{
    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('name', null, array(
                    'label' => 'label.service_name'
                )
            )
            ->add('icon', null, array(
                    'label' => 'label.service_icon'
                )
            );
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('name', null, array(
                    'label' => 'label.service_name'
                )
            )
            ->add('icon', null, array(
                    'label' => 'label.service_icon'
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
            ->add('name', null, array(
                    'label' => 'label.service_name'
                )
            )
            ->add('icon', null, array(
                    'label' => 'label.service_icon'
                )
            );
    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('name', null, array(
                    'label' => 'label.service_name'
                )
            )
            ->add('icon', null, array(
                    'label' => 'label.service_icon'
                )
            );
    }
}
