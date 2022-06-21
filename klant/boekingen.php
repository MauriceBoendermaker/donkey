<?php include "./include/nav_klant.php"; ?>
<?php
$db = new database\Database($db_host, $db_user, $db_pass, $db_name, $db_port);
$boekingen = $db->getBoekingenByKlantID($_SESSION['id']); //$_SESSION['klant_id']

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
	echo "<th>Einddatum</th>";
	echo "<th>Status</th>";
	echo "<th>Pincode</th>";
	echo "<th>Tocht</th>";
	echo "</tr>";
	foreach ($boekingen as $boeking) {
		echo "<tr>";
		echo "<td>" . $boeking->getStartdatum() . "</td>";
		echo "<td>" . date('Y-m-d', strtotime($boeking->getStartdatum() . ' + ' . $boeking->getTocht()->getAantalDagen() . ' days')) . "</td>";
		echo "<td>" . $boeking->getStatus()->getStatus() . "</td>";
		echo "<td>" . $boeking->getPINCode() . "</td>";
		echo "<td>" . $boeking->getTocht()->getOmschrijving() . "</td>";
		echo "</tr>";
	}
	echo "</table>";
}
?>
<a href="reserveren" class="w-100 mt-3"><button class="w-100 btn btn-primary">Boeking toevoegen</button></a>
<?php include "./include/footer.php"; ?>