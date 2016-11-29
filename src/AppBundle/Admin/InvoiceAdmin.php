<?php

namespace AppBundle\Admin;

use AppBundle\Entity\Invoice;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
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
            ->add('status', 'doctrine_orm_string', array('label' => 'label.order_status'), 'choice', array(
                    'choices' => array(
                        'pending' => 'Chờ thanh toán',
                        'completed' => 'Hoàn thành',
                    ),
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
                )
            )
            ->add('totalPrice', 'currency', array(
                    'label' => 'Số tiền',
                    'currency' => 'VND',
                )
            )
            ->add('status', 'choice', array(
                    'label' => 'Trạng thái',
                    'choices' => array(
                        'pending' => 'Chờ thanh toán',
                        'completed' => 'Hoàn thành',
                    ),
                )
            )
            ->add('updatedAt', null, array(
                'label' => 'TG cập nhật',
            ))
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
            ->add('status', ChoiceType::class, array(
                    'label' => 'Trạng thái',
                    'choices' => array(
                        'pending' => 'Chờ thanh toán',
                        'completed' => 'Hoàn thành',
                    ),
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
            ->add('tourOrder', null, array(
                    'label' => 'Đơn đặt tour',
                )
            )
            ->add('status', 'choice', array(
                    'label' => 'Trạng thái',
                    'choices' => array(
                        'pending' => 'Chờ thanh toán',
                        'completed' => 'Hoàn thành',
                    ),
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
        if ($object instanceof Invoice) {
            if ('completed' == $object->getStatus()) {
                $object->getTourOrder()->setStatus($object->getStatus());
            }
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
        return $object instanceof Invoice
            ? 'Hóa đơn #' . $object->getId()
            : ''; // shown in the breadcrumb on the create view
    }
}
