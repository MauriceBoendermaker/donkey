<?php

namespace database;

//require_once statements
require_once 'database/Route.php';
require_once 'database/Booking.php';
require_once 'database/Customer.php';
require_once 'database/Hostel.php';
require_once 'database/Country.php';

use database\Booking;
use database\Country;
use database\Customer;
use database\Hostel;
use mysqli;
use database\Route;

class Database
{
    private $hostname = "localhost";
    private $username = "root";
    private $password = "";
    private $database = "donkey";
    private $conn;

    public function __construct()
    {
        $this->conn = new mysqli($this->hostname, $this->username, $this->password, $this->database);
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    public function __destruct()
    {
        $this->conn->close();
    }

    // ----- create functions ----- 

    public function setBooking($booking)
    {
        $sql = "INSERT INTO bookings (customer, guests, route, start_date, end_date) VALUES (" . $booking->getCustomer() . ", " . $booking->getGuests() . ", " . $booking->getRoute() . ", '" . $booking->getStartDate() . "', '" . $booking->getEndDate() . "')";
        $this->conn->query($sql);
    }

    public function setCustomer($customer)
    {
        $sql = "INSERT INTO customers (firstname, lastname, email, phone) VALUES ('" . $customer->getFirstname() . "', '" . $customer->getLastname() . "', '" . $customer->getEmail() . "', '" . $customer->getPhone() . "')";
        $this->conn->query($sql);
    }

    public function setRoute($route)
    {
        $sql = "INSERT INTO routes (start, end, duration, country) VALUES ('" . $route->getStart() . "', '" . $route->getEnd() . "', " . $route->getDuration() . ", " . $route->getCountry() . ")";
        $this->conn->query($sql);
    }

    public function setCountry($country)
    {
        $sql = "INSERT INTO countries (name) VALUES ('" . $country->getName() . "')";
        $this->conn->query($sql);
    }

    public function setHostel($hostel)
    {
        $sql = "INSERT INTO hostels (name, location, capacity, reserved_spots) VALUES ('" . $hostel->getName() . "', '" . $hostel->getLocation() . "', " . $hostel->getCapacity() . ", " . $hostel->getReservedSpots() . ")";
        $this->conn->query($sql);
    }

    public function setBookingHostel($booking, $hostel)
    {
        $sql = "INSERT INTO bookings_hostels (booking, hostel) VALUES (" . $booking->getId() . ", " . $hostel->getId() . ")";
        $this->conn->query($sql);
    }

    // ----- read functions -----

    public function getBookings()
    {
        $sql = "SELECT * FROM bookings";
        $result = $this->conn->query($sql);
        $bookings = array();
        if (!empty($result->num_rows) && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $booking = new Booking($row["id"], $row["customer"], $row["guests"], $row["route"], null, $row["start_date"], $row["end_date"]);
                $booking->setRoute($this->getRoute($booking->getRoute()));
                $booking->setCustomer($this->getCustomer($booking->getCustomer()));
                $booking->setHostels($this->getBookingHostels($booking->getId()));
                array_push($bookings, $booking);
            }
        }
        return $bookings;
    }

    public function getBooking($id)
    {
        $sql = "SELECT * FROM bookings WHERE id = " . $id;
        $result = $this->conn->query($sql);
        $booking = null;
        if (!empty($result->num_rows) && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $booking = new Booking($row["id"], $row["customer"], $row["guests"], $row["route"], null, $row["start_date"], $row["end_date"]);
            $booking->setRoute($this->getRoute($booking->getRoute()));
            $booking->setCustomer($this->getCustomers($booking->getCustomer()));
            $booking->setHostels($this->getBookingHostels($booking->getId()));
        }
        return $booking;
    }

    public function getCustomers()
    {
        $sql = "SELECT * FROM customers";
        $result = $this->conn->query($sql);
        $customers = array();
        if (!empty($result->num_rows) && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $customer = new Customer($row["id"], $row["firstname"], $row["lastname"], $row["email"], $row["phone"]);
                array_push($customers, $customer);
            }
        }
        return $customers;
    }

    public function getCustomer($id)
    {
        $sql = "SELECT * FROM customers WHERE id = $id";
        $result = $this->conn->query($sql);
        $customer = null;
        if (!empty($result->num_rows) && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $customer = new Customer($row["id"], $row["firstname"], $row["lastname"], $row["email"], $row["phone"]);
        }
        return $customer;
    }

    public function getRoutes()
    {
        $sql = "SELECT * FROM routes";
        $result = $this->conn->query($sql);
        $routes = array();
        if (!empty($result->num_rows) && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $route = new Route($row["id"], $row["start"], $row["end"], $row["duration"], $row["country"]);
                $route->setCountry($this->getCountry($route->getCountry()));
                array_push($routes, $route);
            }
        }
        return $routes;
    }

    public function getRoute($id)
    {
        $sql = "SELECT * FROM routes WHERE id = $id";
        $result = $this->conn->query($sql);
        $route = null;
        if (!empty($result->num_rows) && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $route = new Route($row["id"], $row["start"], $row["end"], $row["duration"], $row["country"]);
            $route->setCountry($this->getCountry($route->getCountry()));
        }
        return $route;
    }

    public function getCountries()
    {
        $sql = "SELECT * FROM countries";
        $result = $this->conn->query($sql);
        $countries = array();
        if (!empty($result->num_rows) && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $country = new Country($row["id"], $row["name"]);
                array_push($countries, $country);
            }
        }
        return $countries;
    }

    public function getCountry($id)
    {
        $sql = "SELECT * FROM countries WHERE id = $id";
        $result = $this->conn->query($sql);
        $country = null;
        if (!empty($result->num_rows) && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $country = new Country($row["id"], $row["name"]);
        }
        return $country;
    }

    public function getHostels()
    {
        $sql = "SELECT * FROM hostels";
        $result = $this->conn->query($sql);
        $hostels = array();
        if (!empty($result->num_rows) && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $hostel = new Hostel($row["id"], $row["name"], $row["location"], $row["capacity"], $row["reserved_spots"]);
                array_push($hostels, $hostel);
            }
        }
        return $hostels;
    }

    public function getHostel($id)
    {
        $sql = "SELECT * FROM hostels WHERE id = $id";
        $result = $this->conn->query($sql);
        $hostel = null;
        if (!empty($result->num_rows) && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $hostel = new Hostel($row["id"], $row["name"], $row["location"], $row["capacity"], $row["reserved_spots"]);
        }
        return $hostel;
    }

    public function getBookingHostels($id)
    {
        $sql = "SELECT * FROM bookings_hostels WHERE booking = $id";
        $result = $this->conn->query($sql);
        $bookingHostels = array();
        if (!empty($result->num_rows) && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                array_push($bookingHostels, $this->getHostel($row["hostel"]));
            }
        }
        return $bookingHostels;
    }

    // ----- update functions ----- 

    public function updateBooking($booking)
    {
        $sql = "UPDATE bookings SET customer = " . $booking->getCustomer() . ", guests = " . $booking->getGuests() . ", route = " . $booking->getRoute() . ", start_date = '" . $booking->getStartDate() . "', end_date = '" . $booking->getEndDate() . "' WHERE id = " . $booking->getId();
        $this->conn->query($sql);
    }

    public function updateCustomer($customer)
    {
        $sql = "UPDATE customers SET firstname = '" . $customer->getFirstname() . "', lastname = '" . $customer->getLastname() . "', email = '" . $customer->getEmail() . "', phone = '" . $customer->getPhone() . "' WHERE id = " . $customer->getId();
        $this->conn->query($sql);
    }

    public function updateRoute($route)
    {
        $sql = "UPDATE routes SET start = '" . $route->getStart() . "', end = '" . $route->getEnd() . "', duration = " . $route->getDuration() . ", country = " . $route->getCountry() . " WHERE id = " . $route->getId();
        $this->conn->query($sql);
    }

    public function updateCountry($country)
    {
        $sql = "UPDATE countries SET name = '" . $country->getName() . "' WHERE id = " . $country->getId();
        $this->conn->query($sql);
    }

    public function updateHostel($hostel)
    {
        $sql = "UPDATE hostels SET name = '" . $hostel->getName() . "', location = '" . $hostel->getLocation() . "', capacity = " . $hostel->getCapacity() . ", reserved_spots = " . $hostel->getReservedSpots() . " WHERE id = " . $hostel->getId();
        $this->conn->query($sql);
    }

    public function updateBookingHostel($booking, $hostel)
    {
        $sql = "UPDATE bookings_hostels SET booking = " . $booking->getId() . ", hostel = " . $hostel->getId() . " WHERE booking = " . $booking->getId() . " AND hostel = " . $hostel->getId();
        $this->conn->query($sql);
    }

    // ----- delete functions ----- 

    public function deleteBooking($booking)
    {
        $sql = "DELETE FROM bookings WHERE id = " . $booking->getId();
        $this->conn->query($sql);
    }

    public function deleteCustomer($customer)
    {
        $sql = "DELETE FROM customers WHERE id = " . $customer->getId();
        $this->conn->query($sql);
    }

    public function deleteRoute($route)
    {
        $sql = "DELETE FROM routes WHERE id = " . $route->getId();
        $this->conn->query($sql);
    }

    public function deleteCountry($country)
    {
        $sql = "DELETE FROM countries WHERE id = " . $country->getId();
        $this->conn->query($sql);
    }

    public function deleteHostel($hostel)
    {
        $sql = "DELETE FROM hostels WHERE id = " . $hostel->getId();
        $this->conn->query($sql);
    }

    public function deleteBookingHostel($booking, $hostel)
    {
        $sql = "DELETE FROM bookings_hostels WHERE booking = " . $booking->getId() . " AND hostel = " . $hostel->getId();
        $this->conn->query($sql);
    }

    // search functions

    public function searchBookings($search)
    {
        $sql = "SELECT id FROM bookings WHERE id LIKE '%$search%' OR customer LIKE '%$search%' OR guests LIKE '%$search%' OR route LIKE '%$search%' OR start_date LIKE '%$search%' OR end_date LIKE '%$search%'";
        $result = $this->conn->query($sql);
        $bookings = array();
        if (!empty($result->num_rows) && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                array_push($bookings, $this->getBooking($row["id"]));
            }
        }
        return $bookings;
    }

    public function searchCustomers($search)
    {
        $sql = "SELECT id FROM customers WHERE id LIKE '%$search%' OR firstname LIKE '%$search%' OR lastname LIKE '%$search%' OR email LIKE '%$search%' OR phone LIKE '%$search%'";
        $result = $this->conn->query($sql);
        $customers = array();
        if (!empty($result->num_rows) && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                array_push($customers, $this->getCustomer($row["id"]));
            }
        }
        return $customers;
    }

    public function searchRoutes($search)
    {
        $sql = "SELECT id FROM routes WHERE id LIKE '%$search%' OR start LIKE '%$search%' OR end LIKE '%$search%' OR duration LIKE '%$search%' OR country LIKE '%$search%'";
        $result = $this->conn->query($sql);
        $routes = array();
        if (!empty($result->num_rows) && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                array_push($routes, $this->getRoute($row["id"]));
            }
        }
        return $routes;
    }

    public function searchCountries($search)
    {
        $sql = "SELECT id FROM countries WHERE id LIKE '%$search%' OR name LIKE '%$search%'";
        $result = $this->conn->query($sql);
        $countries = array();
        if (!empty($result->num_rows) && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                array_push($countries, $this->getCountry($row["id"]));
            }
        }
        return $countries;
    }

    public function searchHostels($search)
    {
        $sql = "SELECT id FROM hostels WHERE id LIKE '%$search%' OR name LIKE '%$search%' OR location LIKE '%$search%' OR capacity LIKE '%$search%' OR reserved_spots LIKE '%$search%'";
        $result = $this->conn->query($sql);
        $hostels = array();
        if (!empty($result->num_rows) && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                array_push($hostels, $this->getHostel($row["id"]));
            }
        }
        return $hostels;
    }

    public function searchBookingHostels($search)
    {
        $sql = "SELECT id FROM bookings_hostels WHERE id LIKE '%$search%' OR booking LIKE '%$search%' OR hostel LIKE '%$search%'";
        $result = $this->conn->query($sql);
        $bookingHostels = array();
        if (!empty($result->num_rows) && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                array_push($bookingHostels, $this->getBookingHostels($row["id"]));
            }
        }
        return $bookingHostels;
    }
}