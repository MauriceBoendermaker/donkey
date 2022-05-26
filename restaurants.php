<?php include "include/nav_beheer.php"; ?>
	<!-- debug print database Restaurants -->
<?php
$db = new database\Database("localhost", "root", "", "donkey", null);
$restaurants = $db->getRestaurants();

// restaurants
// ID INT
// Naam VARCHAR(50)
// Adres VARCHAR(50)
// Email VARCHAR(50)
// Telefoon VARCHAR(20)
// Coordinaten VARCHAR(20)
// Gewijzigd TIMESTAMP
echo "<h3>Database Restaurants</h3>";
echo "<table>";
echo "<tr>";
echo "<th>Naam</th>";
echo "<th>Adres</th>";
echo "<th>Email</th>";
echo "<th>Telefoon</th>";
echo "<th>Coördinaten</th>";
echo "</tr>";
foreach ($restaurants as $restaurant) {
	echo "<tr>";
	echo "<td>" . $restaurant->getNaam() . "</td>";
	echo "<td>" . $restaurant->getAdres() . "</td>";
	echo "<td>" . $restaurant->getEmail() . "</td>";
	echo "<td>" . $restaurant->getTelefoon() . "</td>";
	echo "<td>" . $restaurant->getCoordinaten() . "</td>";
	echo "</tr>";
}
echo "</table>";
?>
<?php include "include/footer.php"; ?>