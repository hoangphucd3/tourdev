<?php

namespace AppBundle\Admin;

use AppBundle\Entity\Comment;
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
                    'label' => 'label.comment_created_at',
                    'disabled' => true,
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
                    'label' => 'label.comment_created_at',
                )
            );
    }

    /**
     * @param mixed $object
     *
     * @link http://stackoverflow.com/questions/16993733/sonata-admin-bundle-one-to-many-relationship-not-saving-foreign-id
     */
    public function prePersist($object)
    {
        $this->preUpdate($object);
    }

    /**
     * @param mixed $object
     *
     * @link http://stackoverflow.com/questions/16993733/sonata-admin-bundle-one-to-many-relationship-not-saving-foreign-id
     */
    public function preUpdate($object)
    {
        if ($object instanceof Comment) {
            $object->setUpdatedAt(new \DateTime());
        }
    }

    /**
     * Returns "nice" name for object
     * Can define with __toString() function in Entity
     *
     * @param mixed $object
     * @return string
     */
    public function toString($object)
    {
        return $object instanceof Comment
            ? 'Bình luận #' . $object->getId()
            : ''; // shown in the breadcrumb on the create view
    }
}
