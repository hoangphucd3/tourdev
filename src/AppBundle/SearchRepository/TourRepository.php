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

        $boolFilter->addShould($baseQuery);

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

        $query = Query::create($boolFilter);

        return $this->find($query);
    }
}