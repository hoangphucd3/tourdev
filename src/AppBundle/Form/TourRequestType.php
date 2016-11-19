<?php

namespace AppBundle\Form;

use AppBundle\Manager\TourOrderManager;
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
        $order_detail = $options['tourOrder'];

        $builder
            ->add('numberOfAdults', NumberType::class, array(
                    'data' => $order_detail->getNumberOfAdults(),
                )
            )
            ->add('numberOfChildren', NumberType::class, array(
                    'data' => $order_detail->getNumberOfChildren(),
                )
            )
            ->add('numberOfInfants', NumberType::class, array(
                    'data' => $order_detail->getNumberOfInfants(),
                )
            );
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\TourRequest'
        ));

        $resolver->setRequired('tourOrder');
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_tourrequest';
    }


}
