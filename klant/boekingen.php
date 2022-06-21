<?php include "./include/nav_klant.php"; ?>
<?php
$db = new database\Database($db_host, $db_user, $db_pass, $db_name, $db_port);
$boekingen = $db->getBoekingenByKlantID(0); //$_SESSION['klant_id']

// boeking (klant)
// ID INT
// StartDatum DATE
// PINCode INT
// FKtochtenID INT (foreign key)
// FKklantenID INT (foreign key)
// FKstatussenID INT (foreign key)
echo "<h3>Boeking Klant</h3>";
if (count($boekingen) == 0) {
	echo '
		<div class="alert alert-info mt-2" role="alert">
			<i class="fa fa-info-circle" aria-hidden="true"></i>
			<span class="sr-only">Error:</span>
			U heeft nog geen boekingen.
		</div>';
} else {
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
	echo "<td>" . $boeking->getStatus()->getStatus() . "</td>";
	echo "<td>" . $boeking->getPINCode() . "</td>";
	echo "<td>" . $boeking->getKlant()->getNaam() . "</td>";
	echo "<td>" . $boeking->getTocht()->getOmschrijving() . "</td>";
	echo "<td>" . $boeking->getKlant()->getEmail() . "</td>";
	echo "<td>" . $boeking->getKlant()->getTelefoon() . "</td>";
	echo "</tr>";
}
echo "</table>";
}
?>
<?php include "./include/footer.php"; ?>