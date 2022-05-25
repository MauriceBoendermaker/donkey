<?php include "include/nav_beheer.php"; ?>
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
<?php include "include/footer.php"; ?>