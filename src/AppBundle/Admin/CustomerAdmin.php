<?php

namespace AppBundle\Admin;

use AppBundle\Entity\Customer;
use Knp\Menu\ItemInterface as MenuItemInterface;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Admin\AdminInterface;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Route\RouteCollection;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\UserBundle\Model\UserInterface;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;

class CustomerAdmin extends AbstractAdmin
{
    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('lastname')
            ->add('firstname')
            ->add('email')
            ->add('phoneNumber')
            ->add('country');
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('user', null, array(
                'label' => 'Tài khoản',
            ))
            ->addIdentifier('email', null, array(
                'label' => 'Email',
            ))
            ->add('lastname', null, array(
                'label' => 'Tên',
            ))
            ->add('firstname', null, array(
                'label' => 'Họ',
            ))
            ->add('phoneNumber', null, array(
                'label' => 'Số điện thoại',
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
        $user = $this->getUserInfo();

        $formMapper
            ->add('user', 'sonata_type_model_list', array(
                'label' => 'Tài khoản',
            ))
            ->add('lastname', null, array(
                'label' => 'Tên',
                'empty_data' => $user->getFirstName(),
            ))
            ->add('firstname', null, array(
                'label' => 'Họ',
                'empty_data' => $user->getLastName(),
            ))
            ->add('email', null, array(
                'label' => 'Email',
                'empty_data' => $user->getEmail(),
            ))
            ->add('phoneNumber', null, array(
                'label' => 'Số điện thoại',
                'empty_data' => $user->getPhone(),
            ))
            ->add('city', null, array(
                'label' => 'Thành phố',
            ))
            ->add('postCode', null, array(
                'label' => 'Mã bưu chính',
            ))
            ->add('country', 'country', array(
                'label' => 'Quốc gia'
            ));
    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('lastname')
            ->add('firstname')
            ->add('email')
            ->add('phoneNumber')
            ->add('address1')
            ->add('address2')
            ->add('city')
            ->add('postCode')
            ->add('country')
            ->add('updatedAt')
            ->add('createdAt');
    }

    protected function configureRoutes(RouteCollection $collection)
    {
        $collection->remove('create');
    }

    private function getUserInfo()
    {
        $container = $this->getConfigurationPool()->getContainer();
        $em = $container->get('doctrine.orm.entity_manager');
        $id = $this->getRequest()->get('id');

        $customer = $em->getRepository('AppBundle:Customer')->find($id);

        $user = $customer->getUser();

        return $user;
    }

    protected function configureSideMenu(MenuItemInterface $menu, $action, AdminInterface $childAdmin = null)
    {
        if (!$childAdmin && !in_array($action, array('edit'))) {
            return;
        }
        $admin = $this->isChild() ? $this->getParent() : $this;

        $id = $admin->getRequest()->get('id');

        $menu->addChild(
            $this->trans('Khách hàng', array(), 'AppBundle'),
            $admin->generateMenuUrl('edit', array('id' => $id))
        );

        $menu->addChild(
            $this->trans('Đơn đặt tour', array(), 'AppBundle'),
            $admin->generateMenuUrl('app.admin.tour_order.list', array('id' => $id))
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
        return $object instanceof Customer
            ? 'Khách hàng #' . $object->getId()
            : ''; // shown in the breadcrumb on the create view
    }
}
