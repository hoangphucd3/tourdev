<?php

namespace AppBundle\Admin;

use AppBundle\Entity\Customer;
use Knp\Menu\ItemInterface as MenuItemInterface;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Admin\AdminInterface;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

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
            ->add('user')
            ->add('lastname')
            ->add('firstname')
            ->add('email')
            ->add('phoneNumber')
            ->add('country')
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
            ->add('user', 'sonata_type_model_list')
            ->add('lastname')
            ->add('firstname')
            ->add('email')
            ->add('birthDate')
            ->add('birthPlace')
            ->add('phoneNumber')
            ->add('address1')
            ->add('address2')
            ->add('city')
            ->add('postCode')
            ->add('country');
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
            ->add('birthDate')
            ->add('birthPlace')
            ->add('phoneNumber')
            ->add('address1')
            ->add('address2')
            ->add('city')
            ->add('postCode')
            ->add('country')
            ->add('updatedAt')
            ->add('createdAt');
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
