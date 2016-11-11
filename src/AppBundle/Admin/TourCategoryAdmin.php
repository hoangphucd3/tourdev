<?php

namespace AppBundle\Admin;

use AppBundle\Entity\TourCategory;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class TourCategoryAdmin extends AbstractAdmin
{
    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('id')
            ->add('name')
            ->add('description');
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('id')
            ->add('name')
            ->add('description')
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
            ->add('name')
            ->add('description');
    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('id')
            ->add('name')
            ->add('description');
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
        if ($object instanceof TourCategory) {
            $container = $this->getConfigurationPool()->getContainer();

            $object->setSlug($container->get('app.slugger')->slugify($object->getName()));
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
        return $object instanceof TourCategory
            ? $object->getName()
            : ''; // shown in the breadcrumb on the create view
    }
}
