<?php


namespace database;


class Hostel
{
    private $id;
    private $name;
    private $location;
    private $capacity;
    private $reserved_spots;

    public function __construct($id, $name, $location, $capacity, $reserved_spots)
    {
        $this->id = $id;
        $this->name = $name;
        $this->location = $location;
        $this->capacity = $capacity;
        $this->reserved_spots = $reserved_spots;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getLocation()
    {
        return $this->location;
    }

    public function getCapacity()
    {
        return $this->capacity;
    }

    public function getReservedSpots()
    {
        return $this->reserved_spots;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function setLocation($location)
    {
        $this->location = $location;
    }

    public function setCapacity($capacity)
    {
        $this->capacity = $capacity;
    }

    public function setReservedSpots($reserved_spots)
    {
        $this->reserved_spots = $reserved_spots;
    }
}