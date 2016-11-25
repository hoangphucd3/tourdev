<?php

namespace AppBundle\Admin;

use AppBundle\Entity\TourOrder;
use Knp\Menu\ItemInterface as MenuItemInterface;
use Sonata\AdminBundle\Admin\AdminInterface;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;

class TourOrderAdmin extends AbstractAdmin
{
    protected $parentAssociationMapping = 'customer';

    public function configure()
    {
        $this->parentAssociationMapping = 'customer';
    }

    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('customer', null, array(
                    'label' => 'Khách hàng',
                    'associated_property ' => '__toString',
                )
            )
            ->add('billingFirstName', null, array(
                    'label' => 'label.order_first_name'
                )
            )
            ->add('billingLastName', null, array(
                    'label' => 'label.order_last_name'
                )
            )
            ->add('status', 'doctrine_orm_string', array('label' => 'label.order_status'), 'choice', array(
                    'choices' => array(
                        'canceled' => 'Đã hủy',
                        'pending' => 'Chờ xử lý',
                        'completed' => 'Hoàn thành',
                    ),
                )
            )
            ->add('email', null, array(
                    'label' => 'label.order_email'
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
                    'label' => 'label.order_id'
                )
            )
            ->add('customer', null, array(
                    'label' => 'Khách hàng',
                    'associated_property ' => 'id',
                )
            )
            ->add('billingFirstName', null, array(
                    'label' => 'label.order_first_name'
                )
            )
            ->add('billingLastName', null, array(
                    'label' => 'label.order_last_name'
                )
            )
            ->add('email', null, array(
                    'label' => 'label.order_email'
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
            ->add('createdAt', null, array(
                    'label' => 'label.order_created_at'
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
                    'label' => 'label.order_id',
                    'disabled' => true,
                )
            )
            ->add('customer', 'sonata_type_model_list', array(
                    'label' => 'Khách hàng',
                )
            )
            ->add('invoice', 'sonata_type_model_list', array(
                    'label' => 'Hóa đơn',
                )
            )
            ->add('billingFirstName', null, array(
                    'label' => 'label.order_first_name'
                )
            )
            ->add('billingLastName', null, array(
                    'label' => 'label.order_last_name'
                )
            )
            ->add('email', null, array(
                    'label' => 'label.order_email'
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
            )
            ->add('checkoutMethod', ChoiceType::class, array(
                    'label' => 'Phương thức thanh toán',
                    'choices' => array(
                        'cod' => 'Thanh toán trực tiếp',
                        'onepay' => 'Thanh toán trực tuyến',
                    )
                )
            )
            ->add('billingPhone', null, array(
                    'label' => 'label.order_phone'
                )
            )
            ->add('billingAddress1', null, array(
                    'label' => 'label.order_address1'
                )
            )
            ->add('billingAddress2', null, array(
                    'label' => 'label.order_address2'
                )
            )
            ->add('billingCity', null, array(
                    'label' => 'label.order_city'
                )
            )
            ->add('billingPostCode', null, array(
                    'label' => 'label.order_postcode'
                )
            )
            ->add('country', CountryType::class, array(
                    'label' => 'label.order_country'
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
                    'label' => 'label.order_id'
                )
            )
            ->add('billingFirstName', null, array(
                    'label' => 'label.order_first_name'
                )
            )
            ->add('billingLastName', null, array(
                    'label' => 'label.order_last_name'
                )
            )
            ->add('email', null, array(
                    'label' => 'label.order_email'
                )
            )
            ->add('status', null, array(
                    'label' => 'label.order_status'
                )
            )
            ->add('createdAt', null, array(
                    'label' => 'label.order_created_at'
                )
            )
            ->add('billingPhone', null, array(
                    'label' => 'label.order_phone'
                )
            )
            ->add('billingAddress1', null, array(
                    'label' => 'label.order_address1'
                )
            )
            ->add('billingAddress2', null, array(
                    'label' => 'label.order_address2'
                )
            )
            ->add('billingCity', null, array(
                    'label' => 'label.order_city'
                )
            )
            ->add('billingPostCode', null, array(
                    'label' => 'label.order_postcode'
                )
            )
            ->add('country', null, array(
                    'label' => 'label.order_country'
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
        if ($object instanceof TourOrder) {
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
        return $object instanceof TourOrder
            ? 'Đơn đặt tour #' . $object->getId()
            : ''; // shown in the breadcrumb on the create view
    }
}
