<?php

namespace AppBundle\Search;

class TourSearch
{
    private $tourName;

    private $locations;

    private $departure;

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    public function getTourName()
    {
        return $this->tourName;
    }

    public function setTourName($tourName)
    {
        $this->tourName = $tourName;

        return $this;
    }

    public function getLocations()
    {
        return $this->locations;
    }

    public function setLocations($locations)
    {
        $this->locations = $locations;

        return $this;
    }

    public function getDeparture()
    {
        return $this->departure;
    }

    public function setDeparture($departure)
    {
        $this->departure = $departure;

        return $this;
    }
}