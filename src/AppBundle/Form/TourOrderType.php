<?php

namespace AppBundle\Form;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TourOrderType extends AbstractType
{
//    use ContainerAwareTrait;
    private $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $user_object = $this->container->get('security.token_storage')->getToken()->getUser();

        $builder
            ->add('billingFirsttName', TextType::class, array(
                'label' => 'Tên',
                'data' => !empty($user_object->getFirstName()) ? $user_object->getFirstName() : '',
            ))
            ->add('billingLastName', TextType::class, array(
                'label' => 'Họ',
                'data' => !empty($user_object->getLastName()) ? $user_object->getLastName() : '',
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
