<?php

namespace AppBundle\Admin;

use AppBundle\Entity\TourRequest;
use Ivory\CKEditorBundle\Form\Type\CKEditorType;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class TourRequestAdmin extends AbstractAdmin
{
    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('tourOrder', null, array(
                    'label' => 'Đơn đặt tour',
                    'associated_property ' => '__toString',
                )
            )
            ->add('user', null, array(
                    'label' => 'Khách hàng',
                    'associated_property ' => '__toString',
                )
            )
            ->add('status', 'doctrine_orm_string', array('label' => 'Trạng thái'), 'choice', array(
                    'choices' => array(
                        'pending' => 'Chờ xử lý',
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
                    'label' => 'Mã đơn'
                )
            )
            ->add('tourOrder', null, array(
                    'label' => 'Đơn đặt tour',
                )
            )
            ->add('user', null, array(
                    'label' => 'Khách hàng'
                )
            )
            ->add('status', 'choice', array(
                    'label' => 'label.order_status',
                    'choices' => array(
                        'pending' => 'Chờ xử lý',
                        'completed' => 'Hoàn thành',
                    ),
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
                    'label' => 'Mã đơn',
                    'disabled' => 'true',
                )
            )
            ->add('user', 'sonata_type_model_list')
            ->add('tourOrder', 'sonata_type_model_list')
            ->add('content', CKEditorType::class, array(
                    'label' => 'label.tour_request_content'
                )
            )
            ->add('status', ChoiceType::class, array(
                    'label' => 'label.order_status',
                    'choices' => array(
                        'pending' => 'Chờ xử lý',
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
                    'label' => 'Mã đơn'
                )
            )
            ->add('status', 'choice', array(
                    'label' => 'Trạng thái',
                    'choices' => array(
                        'canceled' => 'Đã hủy',
                        'pending' => 'Chờ xử lý',
                        'completed' => 'Hoàn thành',
                    ),
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
        return $object instanceof TourRequest
            ? 'Đơn yêu cầu #' . $object->getId()
            : ''; // shown in the breadcrumb on the create view
    }
}
