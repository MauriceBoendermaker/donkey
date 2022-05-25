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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
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
                <li class="nav-item"><a class="nav-link active" aria-current="page" href="">Welcome</a></li>
                <li class="nav-item"><a class="nav-link" href=" read_reservation">Boekingen</a></li>
                <li class="nav-item"><a class="nav-link" href="read_reservation">Beheer</a></li>
                <!-- red logout tab aligned to the right -->
                <li class="nav-item float-end"><a class="nav-link" href="logout.php">Logout</a></li>
            </ul>
            <div class="crud-form">
                <ul class="nav nav-pills">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Active</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Link</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Link</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
                    </li>
                </ul>
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

                <!-- debug print database Statussen -->
                <?php
                $db = new database\Database("localhost", "root", "", "donkey", null);
                $statussen = $db->getStatussen();

                // statussen
                // ID INT
                // StatusCode TINYINT(4)
                // Status VARCHAR(40)
                // Verwijderbaar BIT
                // PINtoekennen BIT
                echo "<h3>Database Statussen</h3>";
                echo "<table>";
                echo "<tr>";
                echo "<th>StatusCode</th>";
                echo "<th>Status</th>";
                echo "<th>Verwijderbaar</th>";
                echo "<th>PINtoekennen</th>";
                echo "<th>Delete</th>";
                echo "</tr>";
                foreach ($statussen as $status) {
                    echo "<tr>";
                    echo "<td>" . $status->getStatusCode() . "</td>";
                    echo "<td>" . $status->getStatus() . "</td>";
                    echo "<td>" . ($status->getVerwijderbaar() ? "true" : "false") . "</td>";
                    echo "<td>" . ($status->getPintoekennen() ? "true" : "false") . "</td>";
                    echo "</tr>";
                }
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