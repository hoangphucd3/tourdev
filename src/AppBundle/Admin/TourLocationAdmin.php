<?php

namespace AppBundle\Admin;

use AppBundle\Entity\TourLocation;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Form\Type\ModelListType;

class TourLocationAdmin extends AbstractAdmin
{
    protected $parentAssociationMapping = 'tour';

    public function configure()
    {
        $this->parentAssociationMapping = 'tour';
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('tour', null, array(
                'associated_property' => 'tourName',
            ))
            ->add('location', null, array(
                    'label' => 'label.location_name'
                )
            );
    }

    /**
     * @param FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('location', ModelListType::class);
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
        return $object instanceof TourLocation
            ? $object->getLocation()->getName()
            : ''; // shown in the breadcrumb on the create view
    }
}
