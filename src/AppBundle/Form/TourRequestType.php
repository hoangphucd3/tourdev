<?php

namespace AppBundle\Form;

use AppBundle\Manager\TourOrderManager;
use Ivory\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TourRequestType extends AbstractType
{
    private $tourOrderManager;

    public function __construct(TourOrderManager $tourOrderManager)
    {
        $this->tourOrderManager = $tourOrderManager;
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder
            ->add('content', CKEditorType::class, array(
                'label' => 'Nội dung yêu cầu chỉnh sửa',
            ));
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\TourRequest'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_tourrequest';
    }


}
