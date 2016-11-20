<?php

namespace AppBundle\SearchRepository;

use AppBundle\Search\TourSearch;
use Elastica\Query;
use Elastica\Query\BoolQuery;
use Elastica\Query\Match;
use Elastica\Query\MatchAll;
use FOS\ElasticaBundle\Repository;

class TourRepository extends Repository
{
    public function findTours(TourSearch $tourSearch)
    {
        if (!empty($tourSearch->getTourName())) {
            $query = new Query\MultiMatch();
            $query->setQuery($tourSearch->getTourName());
            $query->setFields(array('tourName', 'description'));
        } else {
            $query = new MatchAll();
        }

        $baseQuery = $query;

        $boolFilter = new BoolQuery();

        $boolFilter->addShould($baseQuery);

        if (!empty($tourSearch->getLocations())) {
            $nestedFilter = new Query\Nested();
            $locationQuery = new Match();
            $locationBool = new BoolQuery();

            $nestedFilter->setPath('locations');
            $locationFilter = $locationQuery->setFieldQuery('locations.locationId', $tourSearch->getLocations()->getId());
            $locationBool->addMust($locationFilter);
            $nestedFilter->setQuery($locationBool);
            $boolFilter->addMust($nestedFilter);
        }

        if (!empty($tourSearch->getDeparture())) {
            $departure = \DateTime::createFromFormat('d/m/Y', $tourSearch->getDeparture());
            $fomartDeparture = $departure->format('Y-m-d');
            $beforeDeparture = $departure->sub(new \DateInterval('P1D'))->format('Y-m-d');

            $departureRangeQuery = new Query\Range();
            $departureRangeQuery->addField('startDate', array(
                    'gte' => \Elastica\Util::convertDate($beforeDeparture),
                    'lte' => \Elastica\Util::convertDate($fomartDeparture),
                )
            );
            $boolFilter->addMust($departureRangeQuery);
        }

        $query = Query::create($boolFilter);

        return $this->find($query);
    }

    public function advancedFindTours(TourSearch $tourSearch)
    {
        if (!empty($tourSearch->getTourName())) {
            $query = new Query\MultiMatch();
            $query->setQuery($tourSearch->getTourName());
            $query->setFields(array('tourName', 'description'));
        } else {
            $query = new MatchAll();
        }

        $baseQuery = $query;

        $boolFilter = new BoolQuery();

        $boolFilter->addMust($baseQuery);

        if (!empty($tourSearch->getLocations())) {
            $locations = $tourSearch->getLocations();

            foreach ($locations as $location) {
                $nestedFilter = new Query\Nested();
                $locationQuery = new Match();
                $locationBool = new BoolQuery();

                $nestedFilter->setPath('locations');
                $locationFilter = $locationQuery->setFieldQuery('locations.locationId', $location->getId());
                $locationBool->addMust($locationFilter);
                $nestedFilter->setQuery($locationBool);
                $boolFilter->addMust($nestedFilter);
            }
        }

        if (!empty($tourSearch->getServices())) {
            $services = $tourSearch->getServices();

            foreach ($services as $service) {
                $nestedFilter = new Query\Nested();
                $serviceQuery = new Match();
                $serviceBool = new BoolQuery();

                $nestedFilter->setPath('services');
                $serviceFilter = $serviceQuery->setFieldQuery('services.serviceId', $service->getId());
                $serviceBool->addMust($serviceFilter);
                $nestedFilter->setQuery($serviceBool);
                $boolFilter->addMust($nestedFilter);
            }
        }

        if (!empty($tourSearch->getPrice())) {
            $price_data = $tourSearch->getPrice();

            $price_range = explode('-', $price_data);

            $minPrice = $price_range[0];
            $maxPrice = $price_range[1];

            $priceRangeQuery = new Query\Range();

            $priceRangeQuery->addField('regularPrice', array('gte' => $minPrice, 'lte' => $maxPrice));

            $boolFilter->addMust($priceRangeQuery);
        }

        if (!empty($tourSearch->getDeparture())) {
            $departure = \DateTime::createFromFormat('d/m/Y', $tourSearch->getDeparture());
            $fomartDeparture = $departure->format('Y-m-d');
            $beforeDeparture = $departure->sub(new \DateInterval('P1D'))->format('Y-m-d');

            $departureRangeQuery = new Query\Range();
            $departureRangeQuery->addField('startDate', array(
                    'gte' => \Elastica\Util::convertDate($beforeDeparture),
                    'lte' => \Elastica\Util::convertDate($fomartDeparture),
                )
            );
            $boolFilter->addMust($departureRangeQuery);
        }

        $query = Query::create($boolFilter);

        return $this->find($query);
    }
}