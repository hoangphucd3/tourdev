<?php

namespace AppBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class TourOrderAdmin extends AbstractAdmin
{
    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('id')
            ->add('status')
            ->add('createdAt')
            ->add('updatedAt')
            ->add('billingFirsttName')
            ->add('billingLastName')
            ->add('billingPhone')
            ->add('billingAddress1')
            ->add('billingAddress2')
            ->add('billingCity')
            ->add('billingPostCode')
            ->add('country')
            ->add('departure')
            ->add('email')
        ;
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('id')
            ->add('status')
            ->add('createdAt')
            ->add('updatedAt')
            ->add('billingFirsttName')
            ->add('billingLastName')
            ->add('billingPhone')
            ->add('billingAddress1')
            ->add('billingAddress2')
            ->add('billingCity')
            ->add('billingPostCode')
            ->add('country')
            ->add('departure')
            ->add('email')
            ->add('_action', null, array(
                'actions' => array(
                    'show' => array(),
                    'edit' => array(),
                    'delete' => array(),
                )
            ))
        ;
    }

    /**
     * @param FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('id')
            ->add('status')
            ->add('createdAt')
            ->add('updatedAt')
            ->add('billingFirsttName')
            ->add('billingLastName')
            ->add('billingPhone')
            ->add('billingAddress1')
            ->add('billingAddress2')
            ->add('billingCity')
            ->add('billingPostCode')
            ->add('country')
            ->add('departure')
            ->add('email')
        ;
    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('id')
            ->add('status')
            ->add('createdAt')
            ->add('updatedAt')
            ->add('billingFirsttName')
            ->add('billingLastName')
            ->add('billingPhone')
            ->add('billingAddress1')
            ->add('billingAddress2')
            ->add('billingCity')
            ->add('billingPostCode')
            ->add('country')
            ->add('departure')
            ->add('email')
        ;
    }
}
