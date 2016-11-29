<?php

namespace AppBundle\Admin;

use AppBundle\Entity\TourCancel;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class TourCancelAdmin extends AbstractAdmin
{
    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('id', null, array(
                    'label' => 'Mã đơn'
                )
            )
            ->add('tourOrder', null, array(
                    'label' => 'Đơn đặt tour',
                )
            )
            ->add('customer', null, array(
                    'label' => 'Khách hàng',
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
            ->add('customer', null, array(
                    'label' => 'Khách hàng',
                )
            )
            ->add('status', 'choice', array(
                    'label' => 'Trạng thái',
                    'choices' => array(
                        'pending' => 'Chờ xử lý',
                        'completed' => 'Hoàn thành',
                    ),
                )
            )
            ->add('createdAt', null, array(
                    'label' => 'Thời gian tạo',
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
            ->add('status', ChoiceType::class, array(
                    'label' => 'Trạng thái',
                    'choices' => array(
                        'pending' => 'Chờ xử lý',
                        'completed' => 'Hoàn thành',
                    ),
                )
            )
            ->add('tourOrder', 'sonata_type_model_list', array(
                    'label' => 'Đơn đặt tour',
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
                    'label' => 'Mã đơn',
                    'disabled' => 'true',
                )
            )
            ->add('status', 'choice', array(
                    'label' => 'Trạng thái',
                    'choices' => array(
                        'pending' => 'Chờ xử lý',
                        'completed' => 'Hoàn thành',
                    ),
                )
            )
            ->add('createdAt', null, array(
                    'label' => 'Thời gian tạo',
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
        if ($object instanceof TourCancel) {
            if('completed' == $object->getStatus()) {
                $object->getTourOrder()->setStatus('canceled');
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
        return $object instanceof TourCancel
            ? 'Đơn hủy tour #' . $object->getId()
            : ''; // shown in the breadcrumb on the create view
    }
}
