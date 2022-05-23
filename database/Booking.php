<?php

namespace database;

class Booking
{
    private $id;
    private $customer;
    private $guests;
    private $route;
    private $hostels;
    private $start_date;
    private $end_date;

    public function __construct($id, $customer, $guests, $route, $hostels, $start_date, $end_date)
    {
        $this->id = $id;
        $this->customer = $customer;
        $this->guests = $guests;
        $this->route = $route;
        $this->hostels = $hostels;
        $this->start_date = $start_date;
        $this->end_date = $end_date;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getGuests()
    {
        return $this->guests;
    }

    public function getCustomer()
    {
        return $this->customer;
    }

    public function getRoute()
    {
        return $this->route;
    }

    public function getHostels()
    {
        return $this->hostels;
    }

    public function getStartDate()
    {
        return $this->start_date;
    }

    public function getEndDate()
    {
        return $this->end_date;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function setGuests($guests)
    {
        $this->guests = $guests;
    }

    public function setCustomer($customer)
    {
        $this->customer = $customer;
    }

    public function setRoute($route)
    {
        $this->route = $route;
    }

    public function setHostels($hostels)
    {
        $this->hostels = $hostels;
    }

    public function setStartDate($start_date)
    {
        $this->start_date = $start_date;
    }

    public function setEndDate($end_date)
    {
        $this->end_date = $end_date;
    }
}