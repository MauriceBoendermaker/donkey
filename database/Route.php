<?php

namespace database;

class Route
{
    private $id;
    private $start;
    private $end;
    private $duration;
    private $country;

    public function __construct($id, $start, $end, $duration, $country)
    {
        $this->id = $id;
        $this->start = $start;
        $this->end = $end;
        $this->duration = $duration;
        $this->country = $country;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getStart()
    {
        return $this->start;
    }

    public function getEnd()
    {
        return $this->end;
    }

    public function getDuration()
    {
        return $this->duration;
    }

    public function getCountry()
    {
        return $this->country;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function setStart($start)
    {
        $this->start = $start;
    }

    public function setEnd($end)
    {
        $this->end = $end;
    }

    public function setDuration($duration)
    {
        $this->duration = $duration;
    }

    public function setCountry($country)
    {
        $this->country = $country;
    }
}