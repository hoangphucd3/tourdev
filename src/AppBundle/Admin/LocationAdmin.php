<?php

namespace AppBundle\Admin;

use AppBundle\Entity\Location;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\MediaBundle\Form\Type\MediaType;

class LocationAdmin extends AbstractAdmin
{
    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('name', null, array(
                    'label' => 'label.location_name'
                )
            )
            ->add('description', null, array(
                    'label' => 'label.location_desc'
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
                    'label' => 'label.location_name'
                )
            )
            ->add('description', null, array(
                    'label' => 'label.location_desc'
                )
            )
            ->add('_action', null, array(
                    'actions' => array(
                        'show' => array(),
                        'edit' => array(),
                        'delete' => array(),
                    )
                )
            );
    }

    /**
     * @param FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('name', null, array(
                    'label' => 'label.location_name'
                )
            )
            ->add('description', null, array(
                    'label' => 'label.location_desc'
                )
            )
            ->add('featuredImage', MediaType::class, array(
                    'provider' => 'sonata.media.provider.image',
                    'context' => 'default'
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
                    'label' => 'label.location_name'
                )
            )
            ->add('description', null, array(
                    'label' => 'label.location_desc'
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
        if ($object instanceof Location) {
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
        return $object instanceof Location
            ? $object->getName()
            : ''; // shown in the breadcrumb on the create view
    }
}
