<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TourOrderType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('billingName', TextType::class, array(
                'label' => 'Tên',
                'data' => '',
            ))
            ->add('email', TextType::class, array(
                'label' => 'Email'
            ))
            ->add('billingPhone', TextType::class, array(
                'label' => 'Số điện thoại'
            ))
            ->add('country', CountryType::class, array(
                'label' => 'Quốc gia'
            ))
            ->add('billingAddress1', TextType::class, array(
                'label' => 'Địa chỉ 1'
            ))
            ->add('billingAddress2', TextType::class, array(
                'label' => 'Địa chỉ 2'
            ))
            ->add('billingCity', TextType::class, array(
                'label' => 'Thành phố'
            ))
            ->add('billingPostCode', TextType::class, array(
                'label' => 'Mã bưu chính'
            ));
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\TourOrder'
        ));
    }
}
