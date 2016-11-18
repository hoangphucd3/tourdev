<?php

namespace AppBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class CustomerAdmin extends AbstractAdmin
{
    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('lastname')
            ->add('firstname')
            ->add('email')
            ->add('birthDate')
            ->add('birthPlace')
            ->add('phoneNumber')
            ->add('address1')
            ->add('address2')
            ->add('city')
            ->add('postCode')
            ->add('country')
            ->add('updatedAt')
            ->add('createdAt')
        ;
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('lastname')
            ->add('firstname')
            ->add('email')
            ->add('birthDate')
            ->add('birthPlace')
            ->add('phoneNumber')
            ->add('address1')
            ->add('address2')
            ->add('city')
            ->add('postCode')
            ->add('country')
            ->add('updatedAt')
            ->add('createdAt')
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
            ->add('user', 'sonata_type_model_list')
            ->add('lastname')
            ->add('firstname')
            ->add('email')
            ->add('birthDate')
            ->add('birthPlace')
            ->add('phoneNumber')
            ->add('address1')
            ->add('address2')
            ->add('city')
            ->add('postCode')
            ->add('country')
        ;
    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('lastname')
            ->add('firstname')
            ->add('email')
            ->add('birthDate')
            ->add('birthPlace')
            ->add('phoneNumber')
            ->add('address1')
            ->add('address2')
            ->add('city')
            ->add('postCode')
            ->add('country')
            ->add('updatedAt')
            ->add('createdAt')
        ;
    }
}
