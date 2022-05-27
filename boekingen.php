<?php include "include/nav_boekingen.php"; ?>
	<!-- debug print database Boekingen -->
<?php
$db = new database\Database("localhost", "root", "", "donkey", null);
$boekingen = $db->getBoekingen();

// boekingen
// ID INT
// StartDatum DATE
// PINCode INT
// FKtochtenID INT (foreign key)
// FKklantenID INT (foreign key)
// FKstatussenID INT (foreign key)
echo "<h3>Database Boekingen</h3>";
echo "<table>";
echo "<tr>";
echo "<th>Startdatum</th>";
//echo "<th>Einddatum</th>";
echo "<th>Status</th>";
echo "<th>Pincode</th>";
echo "<th>Klantnaam</th>";
echo "<th>Tocht</th>";
echo "<th>Email</th>";
echo "<th>Telefoon</th>";
echo "</tr>";
foreach ($boekingen as $boeking) {
	echo "<tr>";
	echo "<td>" . $boeking->getStartdatum() . "</td>";
//	echo "<td>" . $boeking->getEinddatum() . "</td>";
	echo "<td>" . $boeking->getFKstatussenID() . "</td>";
	echo "<td>" . $boeking->getPINCode() . "</td>";
	echo "<td>" . $boeking->getFKklantenID() . "</td>";
	echo "<td>" . $boeking->getFKtochtenID() . "</td>";
	echo "<td>" . $boeking->getFKklantenID() . "</td>";
	echo "<td>" . $boeking->getFKklantenID() . "</td>";
	echo "</tr>";
}
echo "</table>";
?>
<?php include "include/footer.php"; ?>