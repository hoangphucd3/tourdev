<?php

namespace AppBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TourSearchType extends AbstractType
{
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
                )
            )
            ->add('locations', EntityType::class, array(
                    'class' => 'AppBundle\Entity\Location',
                    'choice_label' => 'name',
                    'choice_value' => 'slug',
                    'placeholder' => 'Chọn địa điểm',
                    'required' => false,
                )
            )
            ->add('departure', TextType::class, array(
                    'label' => 'Chọn ngày khởi hành',
                    'attr' => ['placeholder' => 'Ngày khởi hành'],
                    'required' => false,
                )
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
}