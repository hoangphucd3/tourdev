<?php

namespace AppBundle\Form;

use AppBundle\Search\TourSearch;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TourAdvancedSearchType extends AbstractType
{
    private $tourNameSearch;

    private $locationSearch;

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('tourName', TextType::class, array(
                    'attr' => array(
                        'placeholder' => 'Nhập từ khóa tìm kiếm',
                    ),
                    'required' => false,
                    'data' => $this->getTourNameSearch(),
                )
            )
            ->add('locations', EntityType::class, array(
                    'class' => 'AppBundle\Entity\Location',
                    'choice_label' => 'name',
                    'choice_value' => 'slug',
                    'expanded' => true,
                    'multiple' => true,
                    'required' => false,
                    'data' => $this->getLocationSearch(),
                )
            );

        $builder->get('tourName')->addEventListener(
            FormEvents::SUBMIT,
            function (FormEvent $event) {
                $search_data = $event->getData();

                $this->setTourNameSearch($search_data);
            }
        );

        $builder->get('locations')->addEventListener(
            FormEvents::SUBMIT,
            function (FormEvent $event) {
                $search_data = $event->getData();

                $this->setLocationSearch($search_data);
            }
        );
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Search\TourSearch'
        ));
    }

    public function setTourNameSearch($tourNameSearch)
    {
        $this->tourNameSearch = $tourNameSearch;
    }

    public function getTourNameSearch()
    {
        return $this->tourNameSearch;
    }

    public function setLocationSearch($locationSearch)
    {
        $this->locationSearch = $locationSearch;
    }

    public function getLocationSearch()
    {
        return $this->locationSearch;
    }
}