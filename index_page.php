<body>
<?php include "include/nav.php"; ?>
                <!-- welcome screen saying name of user -->
                    <?php
                    if (isset($_SESSION['naam'])) {
                        echo "<h3>Welcome, " . $_SESSION['naam'] . "!</h3>";
                    } else
                        echo "<h3>Welcome, Guest</h3>";
                    ?>
                    <div class="alert alert-info" role="alert">
                        <i class="fa fa-info-circle" aria-hidden="true"></i>
                        <span class="sr-only">Error:</span>
                        This is the administrative tools for Donkey Travel.
                        You can add, update, delete, and view information about reservations, customers, hostels, and countries.
                    </div>
<?php include "include/footer.php" ?>
        </div>
    </div>
</body>
</html>