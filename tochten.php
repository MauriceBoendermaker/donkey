<?php include "include/nav_beheer.php"; ?>
	<!-- debug print database Tochten -->
<?php
$db = new database\Database("localhost", "root", "", "donkey", null);
$tochten = $db->getTochten();

// statussen
// ID INT
// StatusCode TINYINT(4)
// Status VARCHAR(40)
// Verwijderbaar BIT
// PINtoekennen BIT
echo "<h3>Database Tochten</h3>";
echo "<table>";
echo "<tr>";
echo "<th>Omschrijving</th>";
echo "<th>Route naam</th>";
echo "<th>Aantal dagen</th>";
echo "<th>Delete</th>";
echo "</tr>";
foreach ($tochten as $tocht) {
	echo "<tr>";
	echo "<td>" . $tocht->getOmschrijving() . "</td>";
	echo "<td>" . $tocht->getRoute() . "</td>";
	echo "<td>" . $tocht->getAantalDagen() . "</td>";
	echo "</tr>";
}
echo "</table>";
?>
<?php include "include/footer.php"; ?>