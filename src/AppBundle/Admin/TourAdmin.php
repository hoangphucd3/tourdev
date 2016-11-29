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
use Sonata\CoreBundle\Form\Type\DatePickerType;
use Sonata\DoctrineORMAdminBundle\Filter\DateRangeFilter;
use Sonata\MediaBundle\Form\Type\MediaType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;

class TourAdmin extends AbstractAdmin
{
    protected $translationDomain = 'AppBundle';

    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('tourName', null, array(
                    'label' => 'label.tour_name')
            )
            ->add('startDate', DateRangeFilter::class, array(
                    'label' => 'label.tour_start_date',
                    'format' => 'dd/MM/yyyy',
                    'widget' => 'single_text',
                )
            )
            ->add('category', null, array(
                    'label' => 'Danh mục',
                    'associated_property' => '__toString',
                )
            )
            ->add('duration', null, array(
                    'label' => 'label.tour_duration')
            )
            ->add('numberOfPeople', null, array(
                    'label' => 'label.tour_number_of_people'
                )
            );
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('tourName', null, array(
                    'label' => 'label.tour_name')
            )
            ->add('startDate', null, array(
                    'label' => 'label.tour_start_date',
                )
            )
            ->add('duration', null, array(
                    'label' => 'label.tour_duration')
            )
            ->add('numberOfPeople', null, array(
                    'label' => 'label.tour_number_of_people'
                )
            )
            ->add('regularPrice', 'currency', array(
                    'label' => 'label.tour_regular_price',
                    'currency' => 'VND',
                )
            )
            ->add('salePrice', 'currency', array(
                    'label' => 'label.tour_sale_price',
                    'currency' => 'VND',
                )
            )
            ->add('_action', null, array(
                    'actions' => array(
                        'show' => array(),
                        'edit' => array(),
                        'delete' => array(),
                    )
                )
            );
    }

    /**
     * @param FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        /**
         * Fix intl format
         * @link http://stackoverflow.com/questions/10280872/intldateformatterparse-returns-date-parsing-failed-u-parse-error
         */

        $formMapper
            ->with('group.content', array('class' => 'col-md-12'))
            ->add('tourName', null, array(
                    'label' => 'label.tour_name')
            )
            ->add('startDate', DatePickerType::class, array(
                    'label' => 'label.tour_start_date',
                    'format' => 'dd-MM-yyyy',
                )
            )
            ->add('duration', null, array(
                    'label' => 'label.tour_duration')
            )
            ->add('numberOfPeople', null, array(
                    'label' => 'label.tour_number_of_people'
                )
            )
            ->add('description', CKEditorType::class, array(
                    'label' => 'label.tour_description',
                )
            )
            ->add('status', ChoiceType::class, array(
                    'label' => 'label.tour_status',
                    'choices' => array(
                        'open' => 'Mở',
                        'closed' => 'Đã đóng',
                    ),
                )
            )
            ->add('regularPrice', MoneyType::class, array(
                    'label' => 'label.tour_regular_price',
                    'currency' => 'VND',
                    'scale' => 0,
                    'grouping' => true,
                )
            )
            ->add('salePrice', MoneyType::class, array(
                    'label' => 'label.tour_sale_price',
                    'currency' => 'VND',
                    'scale' => 0,
                    'grouping' => true,
                )
            )
            ->add('category', ModelType::class, array(
                    'label' => 'label.tour_category',
                    'class' => 'AppBundle\Entity\TourCategory',
                    'property' => 'name',
                )
            )
            ->add('featured_image', MediaType::class, array(
                'label' => 'label.tour_featured_image',
                'provider' => 'sonata.media.provider.image',
                'context' => 'default')/*, array(
                                'edit' => 'inline',
                                'inline' => 'table',
                                'link_parameters' => array(
                                    'provider' => 'sonata.media.provider.image',
                                    'context' => 'default'
                                )
                            )*/
            )
            ->add('backgrounds', CollectionType::class, array(
                'label' => 'label.tour_backgrounds',
            ), array(
                    'edit' => 'inline',
                    'inline' => 'table',
                    'sortable' => 'position',
                )
            )
            ->add('gallery', ModelListType::class, array(
                    'label' => 'label.tour_gallery',
                )
            )
            ->end()
            ->with('group.tour_services', array('class' => 'col-md-12'))
            ->add('services', CollectionType::class, array(
                'label' => 'label.tour_services',
            ), array(
                    'edit' => 'inline',
                    'inline' => 'table',
                    'admin_code' => 'app.admin.tour_service',
                )
            )
            ->end()
            ->with('group.tour_location', array('class' => 'col-md-12'))
            ->add('locations', CollectionType::class, array(
                'label' => 'label.tour_locations',
            ), array(
                    'edit' => 'inline',
                    'inline' => 'table',
                    'admin_code' => 'app.admin.tour_location',
                )
            )
            ->end()
//            ->with('group.tour_hotels', array('class' => 'col-md-12'))
//            ->add('hotels', CollectionType::class, array('label' => 'label.tour_hotels',), array(
//                    'edit' => 'inline',
//                    'inline' => 'table',
//                    'admin_code' => 'app.admin.tour_hotel',
//                )
//            )
//            ->end()
        ;
    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('tourName', null, array(
                    'label' => 'label.tour_name')
            )
            ->add('startDate', null, array(
                    'label' => 'label.tour_start_date')
            )
            ->add('duration', null, array(
                    'label' => 'label.tour_duration')
            )
            ->add('numberOfPeople', null, array(
                    'label' => 'label.tour_number_of_people'
                )
            )
            ->add('regularPrice', 'currency', array(
                    'label' => 'label.tour_regular_price',
                    'currency' => 'VND',
                )
            )
            ->add('salePrice', 'currency', array(
                    'label' => 'label.tour_sale_price',
                    'currency' => 'VND',
                )
            )
            ->add('status');
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
