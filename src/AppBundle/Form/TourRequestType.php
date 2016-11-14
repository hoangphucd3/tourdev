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
            ->add('reason')
            ->add('departure', TextType::class, array(
                    'data' => $order_detail->getDeparture()->format('d/m/Y'),
                )
            )
            ->add('adults', NumberType::class, array(
                    'data' => $order_detail->getAdults(),
                )
            )
            ->add('children', NumberType::class, array(
                    'data' => $order_detail->getChildren(),
                )
            )
            ->add('infants', NumberType::class, array(
                    'data' => $order_detail->getInfants(),
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
