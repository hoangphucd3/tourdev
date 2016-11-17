<?php

namespace AppBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class CommentAdmin extends AbstractAdmin
{
    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('content', null, array(
                    'label' => 'label.comment_content'
                )
            )
            ->add('createdAt', null, array(
                    'label' => 'label.comment_created_at'
                )
            );
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('content', null, array(
                    'label' => 'label.comment_content'
                )
            )
            ->add('createdAt', null, array(
                    'label' => 'label.comment_created_at'
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
            ->add('content', null, array(
                    'label' => 'label.comment_content'
                )
            )
            ->add('createdAt', null, array(
                    'label' => 'label.comment_created_at'
                )
            );
    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('content', null, array(
                    'label' => 'label.comment_content'
                )
            )
            ->add('createdAt', null, array(
                    'label' => 'label.comment_created_at'
                )
            );
    }
}
