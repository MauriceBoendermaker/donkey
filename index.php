<?php
//crud+s database using object oriented php
//database has the following data:
// - bookings
//      - id (int)
//      - customer (int)
//      - guests (int)
//      - route (int) (foreign key)
//      - start_date (date)
//      - end_date (date)
// - customer
//      - id (int)
//      - firstname (varchar)
//      - lastname (varchar)
//      - email (varchar)
//      - phone (varchar)
// - routes
//      - id (int)
//      - start (varchar)
//      - end (varchar)
//      - duration (time)
//      - country (int) (foreign key)
// - countries
//      - id (int)
//      - name (varchar)
// - hostels
//      - id (int)
//      - name (varchar)
//      - location (varchar)
//      - capacity (int)
//      - reserved_spots (int)
// - bookings_hostels
//      - id (int)
//      - booking (int) (foreign key)
//      - hostel (int) (foreign key)

//using the database/Database.php class
require_once 'database/Database.php';

?>
<!-- crud+s main page styled by bootstrap -->
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Donkey Travel</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        html body {
            background-color: #eee;
            width: 100%;
        }

        .crud-container {
            margin: 50px auto;
        }

        .crud-container .crud-form {
            margin-bottom: 15px;
            background: #f7f7f7;
            box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
            padding: 10px 30px;
            border-bottom: 1px solid #ddd;
        }

        .crud-container h2 {
            margin: 0 0 15px;
        }

        .form-control,
        .btn {
            min-height: 38px;
            border-radius: 2px;
        }

        .btn {
            font-size: 15px;
            font-weight: bold;
        }

        table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        td,
        th {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        tr:nth-child(even) {
            background-color: #dddddd;
        }

        tr:hover {
            background-color: #dddddd;
        }

        .crud-container .nav-tabs>li.active>a,
        .crud-container .nav-tabs>li.active>a:focus,
        .crud-container .nav-tabs>li.active>a:hover {
            background-color: #f7f7f7;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="crud-container">
            <h2>Donkey Travel Administrative Tools</h2>
            <ul class="nav nav-tabs">
                <li class="active"><a data-toggle="tab" href="">Welcome</a></li>
                <li><a href="read_reservation">Reservations</a></li>
                <li><a href="read_customer">Customers</a></li>
                <li><a href="read_hostel">Hostels</a></li>
                <li><a href="read_country">Countries</a></li>
                <!-- red logout tab aligned to the right -->
                <li style="float:right"><a href="logout">Logout</a></li>
            </ul>
            <div class="crud-form">
                <!-- welcome screen saying name of user -->
                <?php
                if (isset($_SESSION['user'])) {
                    echo "<h3>Welcome, " . $_SESSION['user'] . "</h3>";
                } else
                    echo "<h3>Welcome, Guest</h3>";
                ?>
                <div class="alert alert-info" role="alert">
                    <i class="fa fa-info-circle" aria-hidden="true"></i>
                    <span class="sr-only">Error:</span>
                    This is the administrative tools for Donkey Travel.
                    You can add, update, delete, and view information about reservations, customers, hostels, and countries.
                </div>
                <!-- debug print database bookings -->
                <?php
                $db = new database\Database();
                $bookings = $db->getBookings();
                echo "<h3>Database Bookings</h3>";
                echo "<table>";
                echo "<tr><th>Booking ID</th><th>Guests</th><th>Customer First Name</th><th>Cusomer Last Name</th></th><th>Hostel</th><th>Hostel Location</th></th><th>Capacity</th><th>Reserved Spots</th></tr>";

                foreach ($bookings as $booking) {
                    echo "<tr>";
                    echo "<td>" . $booking->getID() . "</td>";
                    echo "<td>" . $booking->getGuests() . "</td>";
                    echo "<td>" . $booking->getCustomer()->getFirstname() . "</td>";
                    echo "<td>" . $booking->getCustomer()->getLastname() . "</td>";
                    echo "<td>" . $booking->getHostels()[0]->getName() . "</td>";
                    echo "<td>" . $booking->getHostels()[0]->getLocation() . "</td>";
                    echo "<td>" . $booking->getHostels()[0]->getCapacity() . "</td>";
                    echo "<td>" . $booking->getHostels()[0]->getReservedSpots() . "</td>";
                    echo "</tr>";
                }
                echo "</table>";
                ?>
            </div>
            <!-- footer -->
            <footer class="footer">
                <p>&copy; 2022 Donkey Travel</p>
            </footer>
        </div>
    </div>
</body>

</html>