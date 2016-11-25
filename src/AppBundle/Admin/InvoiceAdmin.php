<?php

namespace AppBundle\Admin;

use AppBundle\Entity\Invoice;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;

class InvoiceAdmin extends AbstractAdmin
{
    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('id', null, array(
                    'label' => 'Mã hóa đơn'
                )
            )
            ->add('tourOrder', null, array(
                    'label' => 'Đơn đặt tour',
                    'associated_property' => '__toString',
                )
            )
            ->add('totalPrice', null, array(
                    'label' => 'Số tiền',
                )
            )
            ->add('status', null, array(
                    'label' => 'Trạng thái'
                )
            );
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('id', null, array(
                    'label' => 'Mã hóa đơn'
                )
            )
            ->add('tourOrder', null, array(
                    'label' => 'Đơn đặt tour',
                    'associated_property' => 'id',
                )
            )
            ->add('totalPrice', 'currency', array(
                    'label' => 'Số tiền',
                    'currency' => 'VND',
                )
            )
            ->add('status', null, array(
                    'label' => 'Trạng thái'
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
            ->add('id', null, array(
                    'label' => 'Mã hóa đơn',
                    'disabled' => 'true',
                )
            )
            ->add('tourOrder', 'sonata_type_model', array(
                    'label' => 'Đơn đặt tour',
                )
            )
            ->add('totalPrice', MoneyType::class, array(
                    'label' => 'Số tiền',
                    'currency' => 'VND',
                    'scale' => 0,
                    'grouping' => true,
                )
            )
            ->add('status', null, array(
                    'label' => 'Trạng thái'
                )
            );
    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('id', null, array(
                    'label' => 'Mã hóa đơn'
                )
            )
            ->add('totalPrice', 'currency', array(
                    'label' => 'Giá',
                    'currency' => 'VND',
                )
            )
            ->add('status', null, array(
                    'label' => 'Trạng thái'
                )
            );
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
        return $object instanceof Invoice
            ? 'Hóa đơn #' . $object->getId()
            : ''; // shown in the breadcrumb on the create view
    }
}
