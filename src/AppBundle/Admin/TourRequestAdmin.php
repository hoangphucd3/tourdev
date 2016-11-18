<?php

namespace AppBundle\Admin;

use AppBundle\Entity\TourRequest;
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
            ->add('departure', null, array(
                    'label' => 'label.tour_request_departure'
                )
            )
            ->add('numberOfAdults', null, array(
                    'label' => 'label.tour_request_adults'
                )
            )
            ->add('numberOfChildren', null, array(
                    'label' => 'label.tour_request_children'
                )
            )
            ->add('numberOfInfants', null, array(
                    'label' => 'label.tour_request_infants'
                )
            )
            ->add('status', null, array(
                    'label' => 'label.order_status',
                    'choices' => array(
                        'canceled' => 'Đã hủy',
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
            ->add('departure', null, array(
                    'label' => 'label.tour_request_departure'
                )
            )
            ->add('numberOfAdults', null, array(
                    'label' => 'label.tour_request_adults'
                )
            )
            ->add('numberOfChildren', null, array(
                    'label' => 'label.tour_request_children'
                )
            )
            ->add('numberOfInfants', null, array(
                    'label' => 'label.tour_request_infants'
                )
            )
            ->add('status', 'choice', array(
                    'label' => 'label.order_status',
                    'choices' => array(
                        'canceled' => 'Đã hủy',
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
            ->add('departure', null, array(
                    'label' => 'label.tour_request_departure'
                )
            )
            ->add('numberOfAdults', null, array(
                    'label' => 'label.tour_request_adults'
                )
            )
            ->add('numberOfChildren', null, array(
                    'label' => 'label.tour_request_children'
                )
            )
            ->add('numberOfInfants', null, array(
                    'label' => 'label.tour_request_infants'
                )
            )
            ->add('status', ChoiceType::class, array(
                    'label' => 'label.order_status',
                    'choices' => array(
                        'canceled' => 'Đã hủy',
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
            ->add('departure', null, array(
                    'label' => 'label.tour_request_departure'
                )
            )
            ->add('numberOfAdults', null, array(
                    'label' => 'label.tour_request_adults'
                )
            )
            ->add('numberOfChildren', null, array(
                    'label' => 'label.tour_request_children'
                )
            )
            ->add('numberOfInfants', null, array(
                    'label' => 'label.tour_request_infants'
                )
            )
            ->add('status', 'choice', array(
                    'label' => 'label.order_status',
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
