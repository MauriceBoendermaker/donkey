<?php
include "include/head.php";

?>

<body>
    <div class="container">
        <div class="crud-container">
            <h2>Donkey Travel Administrative Tools</h2>
            <ul class="nav nav-tabs">
                <li class="nav-item"><a class="nav-link active" aria-current="page" href="">Welcome</a></li>
                <li class="nav-item"><a class="nav-link" href="read_reservation">Boekingen</a></li>
                <li class="nav-item"><a class="nav-link" href="read_reservation">Beheer</a></li>
                <li class="nav-item ms-auto"><a class="nav-link text-danger" href="logout.php">Logout</a></li>
            </ul>
            <div class="crud-form row mx-0 ps-0">
                <div class="col-md-1">
                    <ul class="nav nav-pills flex-column nav-fill">
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
                </div>
                <div class="col-md-11">
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
                    echo "</table>";
                    ?>
                </div>
            </div>
            <!-- footer -->
            <footer class="footer">
                <p>&copy; 2022 Donkey Travel</p>
            </footer>
        </div>
    </div>
</body>

</html>