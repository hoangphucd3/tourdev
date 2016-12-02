<?php

namespace AppBundle\Search;

use Symfony\Component\HttpFoundation\Request;

class TourSearch
{
    private $id;

    private $tourName;

    private $locations;

    private $services;

    private $price;

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

    public function getServices()
    {
        return $this->services;
    }

    public function setServices($services)
    {
        $this->services = $services;

        return $this;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function setPrice($price)
    {
        $this->price = $price;

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