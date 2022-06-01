<?php include "include/nav_beheer.php"; ?>
	<!-- debug print database Herbergen -->
<?php
$db = new database\Database("localhost", "root", "", "donkey", null);
$herbergen = $db->getHerbergen();

// herbergen
// ID INT
// Naam VARCHAR(50)
// Adres VARCHAR(50)
// Email VARCHAR(100)
// Telefoon VARCHAR(20)
// Coordinaten VARCHAR(20)
// Gewijzigd TIMESTAMP
echo "<h3>Database Herbergen</h3>";
echo "<table>";
echo "<tr>";
echo "<th>Naam</th>";
echo "<th>Adres</th>";
echo "<th>Email</th>";
echo "<th>Telefoon</th>";
echo "<th>Coördinaten</th>";
echo "</tr>";
foreach ($herbergen as $herberg) {

	$coordinates = $herberg->getCoordinaten();

	$coordinatesWithout = preg_replace("/[^0-9. ]/", "", $coordinates);

	$trimOutput = $coordinatesWithout;
	$arr = explode(' ',trim($trimOutput));
	if ($coordinatesWithout != "") {
		$coord1 = $arr[0];
	} else {
		$coord1 = "";
	}
	if ($coordinatesWithout != "") {
		$coord2 = $arr[1];
	} else {
		$coord2 = "";
	}

	$output = "https://graphhopper.com/maps/?point=" . $coord1 . " " . $coord2 . "&point=" . $coord1 . " " . $coord2 . "&locale=en-US&elevation=false&profile=car&use_miles=false&layer=OpenStreetMap.de";

	echo "<tr>";
	echo "<td>" . $herberg->getNaam() . "</td>";
	echo "<td>" . $herberg->getAdres() . "</td>";
	echo "<td>" . $herberg->getEmail() . "</td>";
	echo "<td>" . $herberg->getTelefoon() . "</td>";
	echo "<td><a target='_blank' href='" . $output . "'>" . $herberg->getCoordinaten() ."</td>";
	echo "</tr>";
}
echo "</table>";
?>
<?php include "include/footer.php"; ?>