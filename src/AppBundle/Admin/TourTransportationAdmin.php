<?php

namespace AppBundle\Admin;

use AppBundle\Entity\TourTransportation;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Form\Type\ModelListType;

class TourTransportationAdmin extends AbstractAdmin
{
    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('tour', null, array(
                'associated_property' => 'tourName',
            ))
            ->add('transportation', null, array(
                    'label' => 'Phương tiện'
                )
            );
    }

    /**
     * @param FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('transportation', ModelListType::class, array(
                'label' => 'Phương tiện',
            ));
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
        return $object instanceof TourTransportation
            ? $object->getTransportation()->getType()
            : ''; // shown in the breadcrumb on the create view
    }
}
