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

$id = -1;
$view = null;
if (isset($_GET['id']))
	$id = $_GET['id'];
if (isset($_GET['view']))
	$view = $_GET['view'];

switch ($view) {
	case 'edit':
		?>
		<h3>Boeking wijzigen</h3>
	<?php
		break;
	case 'delete':
		$boeking = $db->getBoekingByID($id);
		?>
		<h3>Boeking verwijderen</h3>
		<form>
			<div class="form-group">
				<label for="startdatum">Startdatum</label>
				<input value="<?php echo $boeking->getStartdatum(); ?>" type="date" class="form-control" id="startdatum" disabled>
			</div>
			<div class="form-group">
				<label for="status">Status</label>
				<input type="text" class="form-control" id="status" disabled>
			</div>
			<div class="form-group">
				<label for="klant">Klant</label>
				<input type="text" class="form-control" id="klant" disabled>
			</div>
			<div class="form-group">
				<label for="emailTelefoon">Email/Telefoon</label>
				<input type="text" class="form-control" id="emailTelefoon" disabled>
			</div>
			<div class="form-group">
				<label for="tocht">Tocht</label>
				<input type="text" class="form-control" id="tocht" disabled>
			</div>
			<br/>
			<button type="submit" class="btn btn-primary">Verwijderen</button>
			<button type="submit" class="btn btn-primary">Annuleren</button>
		</form>
	<?php
		break;
	default:
?>
<h3>Database Boekingen</h3>
<table>
<tr>
	<th>Startdatum</th>
	<th>Status</th>
	<th>Pincode</th>
	<th>Klantnaam</th>
	<th>Tocht</th>
	<th>Email</th>
	<th>Telefoon</th>
	<th class="d-flex justify-content-center"><button onClick='window.location.reload();'><i class='fa-solid fa-arrow-rotate-right'></i></button></th>
</tr>
	<?php
foreach ($boekingen as $boeking) {
	echo "<tr>";
	echo "<td>" . $boeking->getStartdatum() . "</td>";
	echo "<td>" . $boeking->getStatus()->getStatus() . "</td>";
	echo "<td>" . $boeking->getPINCode() . "</td>";
	echo "<td>" . $boeking->getKlant()->getNaam() . "</td>";
	echo "<td>" . $boeking->getTocht()->getOmschrijving() . "</td>";
	echo "<td>" . $boeking->getKlant()->getEmail() . "</td>";
	echo "<td>" . $boeking->getKlant()->getTelefoon() . "</td>";
	echo "<td class='px-0 d-flex justify-content-center'>
			<a class='mx-1' href='pauzeplaatsen_beheer.php'><button><i class='fa-solid fa-pause'></i></button></a>
			<a class='mx-1' href='overnachtingsplaatsen_beheer.php'><button><i class='fa-solid fa-bed'></i></button></a>
			<a class='mx-1' href='?id={$boeking->getID()}&view=edit'><button><i class='fa-solid fa-pen-to-square'></i></button></a>
			<a class='mx-1' href='?id={$boeking->getID()}&view=delete'><button><i class='fa-solid fa-trash-can'></i></button></a>
		</td>";
	echo "</tr>";
}
echo "</table>";

}
?>
<?php include "include/footer.php"; ?>