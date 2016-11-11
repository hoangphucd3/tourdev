<?php

namespace AppBundle\Admin;

use Sonata\UserBundle\Admin\Model\UserAdmin as BaseUserAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class UserAdmin extends BaseUserAdmin
{
    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
//            ->add('id')
//            ->add('username')
//            ->add('password')
//            ->add('email')
//            ->add('isActive')
//            ->add('fullName')
//            ->add('sex')
//            ->add('birthdate')
//            ->add('id_number')
//            ->add('address')
//            ->add('phoneNumber')
//            ->add('roles')
        ;
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        parent::configureListFields($listMapper);

        $listMapper
//            ->add('id')
//            ->add('username')
//            ->add('password')
//            ->add('email')
//            ->add('isActive')
//            ->add('fullName')
//            ->add('sex')
//            ->add('birthdate')
//            ->add('id_number')
//            ->add('address')
//            ->add('phoneNumber')
//            // https://github.com/sonata-project/SonataAdminBundle/issues/1023
//            ->add('roles', 'choice', [
//                'multiple' => true,
//                'choices' => [
//                    'ROLE_USER' => 'user',
//                    'ROLE_ADMIN' => 'admin',
//                    'ROLE_SUPER_ADMIN' => 'super admin'
//                ]
//            ])
//            ->add('_action', null, array(
//                'actions' => array(
//                    'show' => array(),
//                    'edit' => array(),
//                    'delete' => array(),
//                )
//            ))
        ;
    }

    /**
     * @param FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
//        $container = $this->getConfigurationPool()->getContainer();
//        $roles = $container->getParameter('security.role_hierarchy.roles');
//
//        $rolesChoices = self::flattenRoles($roles);

        parent::configureFormFields($formMapper);

        $formMapper
//            ->add('id')
//            ->add('username')
//            ->add('password')
//            ->add('email')
//            ->add('isActive')
//            ->add('fullName')
//            ->add('sex')
//            ->add('birthdate')
//            ->add('id_number')
//            ->add('address')
//            ->add('phoneNumber')
//            ->add('roles', 'choice', array(
//                    'choices' => $rolesChoices,
//                    'multiple' => true,
//                )
//            )
        ;
    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        parent::configureShowFields($showMapper);
        $showMapper
//            ->add('id')
//            ->add('username')
//            ->add('password')
//            ->add('email')
//            ->add('isActive')
//            ->add('fullName')
//            ->add('sex')
//            ->add('birthdate')
//            ->add('id_number')
//            ->add('address')
//            ->add('phoneNumber')
//            ->add('roles')
        ;
    }

    /**
     * Turns the role's array keys into string <ROLES_NAME> keys.
     *
     * @param $rolesHierarchy
     * @return array
     */
    protected static function flattenRoles($rolesHierarchy)
    {
        $flatRoles = [];
        foreach ($rolesHierarchy as $key => $roles) {
            $flatRoles[$key] = $key;
            if (empty($roles)) {
                continue;
            }

            foreach ($roles as $role) {
                if (!isset($flatRoles[$role])) {
                    $flatRoles[$role] = $role;
                }
            }
        }

        return $flatRoles;
    }
}
