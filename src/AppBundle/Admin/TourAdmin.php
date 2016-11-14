<?php

namespace AppBundle\Admin;

use AppBundle\Entity\Tour;
use Ivory\CKEditorBundle\Form\Type\CKEditorType;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Form\Type\ModelListType;
use Sonata\AdminBundle\Form\Type\ModelType;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\CoreBundle\Form\Type\CollectionType;
use Sonata\MediaBundle\Form\Type\MediaType;

class TourAdmin extends AbstractAdmin
{
    protected $translationDomain = 'AppBundle';

    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper;
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('tourName')
            ->add('startDate')
            ->add('endDate')
            ->add('amount')
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
            ->with('group.content', array('class' => 'col-md-12'))
            ->add('tourName', null, array(
                    'label' => 'label.tour_name')
            )
            ->add('startDate', null, array(
                    'label' => 'label.start_date')
            )
            ->add('endDate', null, array(
                    'label' => 'label.end_date')
            )
            ->add('amount', null, array(
                    'label' => 'label.amount')
            )
            ->add('description', CKEditorType::class, array(
                    'label' => 'label.description',
                )
            )
            ->add('status')
            ->add('regularPrice')
            ->add('salePrice')
            ->add('category', ModelType::class, array(
                    'class' => 'AppBundle\Entity\TourCategory',
                    'property' => 'name',
                )
            )
            ->add('featured_image', MediaType::class, array('provider' => 'sonata.media.provider.image',
                'context' => 'default')/*, array(
                            'edit' => 'inline',
                            'inline' => 'table',
                            'link_parameters' => array(
                                'provider' => 'sonata.media.provider.image',
                                'context' => 'default'
                            )
                        )*/
            )
            ->add('backgrounds', CollectionType::class, array(), array(
                    'edit' => 'inline',
                    'inline' => 'table',
                    'sortable' => 'position',
                )
            )
            ->add('gallery', ModelListType::class)
            ->end()
            ->with('group.tour_service', array('class' => 'col-md-12'))
            ->add('services', CollectionType::class, array(), array(
                    'edit' => 'inline',
                    'inline' => 'table',
                    'admin_code' => 'app.admin.tour_service',
                )
            )
            ->end()
            ->with('group.tour_location', array('class' => 'col-md-12'))
            ->add('locations', CollectionType::class, array(), array(
                    'edit' => 'inline',
                    'inline' => 'table',
                    'admin_code' => 'app.admin.tour_location',
                )
            )
            ->end()
            ->with('group.tour_hotel', array('class' => 'col-md-12'))
            ->add('hotels', CollectionType::class, array(), array(
                    'edit' => 'inline',
                    'inline' => 'table',
                    'admin_code' => 'app.admin.tour_hotel',
                )
            )
            ->end();
    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper;
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
        if ($object instanceof Tour) {
            $container = $this->getConfigurationPool()->getContainer();

            $object->setServices($object->getServices());
            $object->setLocations($object->getLocations());
            $object->setHotels($object->getHotels());
            $object->setBackgrounds($object->getBackgrounds());
            $object->setSlug($container->get('app.slugger')->slugify($object->getTourName()));
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
        return $object instanceof Tour
            ? $object->getTourName()
            : ''; // shown in the breadcrumb on the create view
    }
}
