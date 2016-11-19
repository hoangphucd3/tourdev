<?php

namespace AppBundle\Form;

use AppBundle\Search\TourSearch;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TourAdvancedSearchType extends AbstractType
{
    private $tourNameSearch;

    private $locationSearch;

    private $serviceSearch;

    private $priceSearch;

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
            )
            ->add('services', EntityType::class, array(
                    'class' => 'AppBundle\Entity\Service',
                    'choice_label' => 'name',
                    'choice_value' => 'id',
                    'expanded' => true,
                    'multiple' => true,
                    'required' => false,
                    'data' => $this->getServiceSearch(),
                )
            )
            ->add('price', ChoiceType::class, array(
                    'choices' => array(
                        '0-1000000' => 'Dưới ' . $this->priceFilter('1000000') . '',
                        '1000000-2000000' => 'Từ ' . $this->priceFilter('1000000') . ' - ' . $this->priceFilter('2000000') . '',
                        '2000000-999999' => 'Trên ' . $this->priceFilter('2000000') . '',
                    ),
                    'expanded' => true,
                    'multiple' => false,
                    'required' => false,
                    'data' => $this->getPriceSearch(),
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

        $builder->get('services')->addEventListener(
            FormEvents::SUBMIT,
            function (FormEvent $event) {
                $search_data = $event->getData();

                $this->setServiceSearch($search_data);
            }
        );

        $builder->get('price')->addEventListener(
            FormEvents::SUBMIT,
            function (FormEvent $event) {
                $search_data = $event->getData();

                $this->setPriceSearch($search_data);
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

    public function setServiceSearch($serviceSearch)
    {
        $this->serviceSearch = $serviceSearch;
    }

    public function getServiceSearch()
    {
        return $this->serviceSearch;
    }

    public function setPriceSearch($priceSearch)
    {
        $this->priceSearch = $priceSearch;
    }

    public function getPriceSearch()
    {
        return $this->priceSearch;
    }

    private function priceFilter($price, $decimals = 0, $decPoint = ',', $thousandsSep = '.', $currency = 'đ')
    {
        $priceFormat = '%2$s&nbsp;%1$s';

        $negative = $price < 0;
        $price = floatval($negative ? $price * -1 : $price);
        $price = number_format($price, $decimals, $decPoint, $thousandsSep);

        $formatted_price = ($negative ? '-' : '') . sprintf($priceFormat, '<sup>' . ($currency) . '</sup>', $price);

        return $formatted_price;
    }
}