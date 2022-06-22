<?php

use database\Boeking;

include "./include/nav_klant.php"; ?>
<?php
$db = new database\Database($db_host, $db_user, $db_pass, $db_name, $db_port);

$id = -1;
$view = null;
if (isset($_GET['id']))
	$id = $_GET['id'];
if (isset($_GET['view']))
	$view = $_GET['view'];

if (isset($_POST['cancel']))
	home();

$boeking = $db->getBoekingByID($id);
if (isset($_POST['save']) || isset($_POST['delete'])) {
	if ($boeking->getKlant()->getID() != $_SESSION['id']) home();

	if (isset($_POST['save'])) {
		$db->setBoeking($boeking->getID(), $_POST['startDatum'], $boeking->getPincode(), $_POST['tochtID'], $boeking->getKlant()->getID(), $boeking->getStatus()->getID());
	} else {
		$db->deleteBoeking($boeking->getID());
	}
	home();
}

function home()
{
	header('Location: boekingen');
	exit();
}

switch ($view) {
	case "edit":
		if ($boeking->getKlant()->getID() != $_SESSION['id']) home();
?>
		<h3>Boeking wijzigen</h3>
		<form action="" method="post">
			<div class="form-group mt-2">
				<label for="startdatum">Startdatum</label>
				<input value="<?php echo $boeking->getStartdatum(); ?>" name="startDatum" type="date" class="form-control" id="startdatum" required>
			</div>
			<div class="form-group mt-2">
				<label for="tocht">Tocht:</label>
				<select name="tochtID" class="form-select" aria-label="Select tocht">
					<?php foreach ($db->getTochten() as $tocht) { ?>
						<option value="
								<?php echo $tocht->getID(); ?>" <?php if ($tocht->getID() == $boeking->getTocht()->getID()) echo "selected"; ?>>
							<?php echo $tocht->getOmschrijving() . " (" . $tocht->getAantalDagen() . " dagen)"; ?>
						</option>
					<?php } ?>
				</select>
			</div>
			<br />
			<button name="save" type="submit" class="btn btn-success">Bewaren</button>
			<button name="cancel" type="submit" class="btn btn-primary">Annuleren</button>
		</form>
	<?php
		break;
	case "delete":
		if ($boeking->getKlant()->getID() != $_SESSION['id']) home();
	?>
		<h3>Boeking verwijderen</h3>
		<form action="" method="post">
			<input type="hidden" id="ID" name="id" value="<?php echo $id; ?>">
			<div class="form-group mt-2">
				<label for="startdatum">Startdatum:</label>
				<input value="<?php echo $boeking->getStartdatum(); ?>" type="date" class="form-control" id="startdatum" disabled required>
			</div>
			<div class="form-group mt-2">
				<label for="status">Status:</label>
				<input value="<?php echo $boeking->getStatus()->getStatus(); ?>" type="text" class="form-control" id="status" disabled>
			</div>
			<div class="form-group mt-2">
				<label for="klant">Klant:</label>
				<input value="<?php echo $boeking->getKlant()->getNaam(); ?>" type="text" class="form-control" id="klant" disabled>
			</div>
			<div class="form-group mt-2">
				<label for="emailTelefoon">Email/Telefoon:</label>
				<input value="<?php echo $boeking->getKlant()->getEmail() . " - " . $boeking->getKlant()->getTelefoon(); ?>" type="text" class="form-control" id="emailTelefoon" disabled>
			</div>
			<div class="form-group mt-2">
				<label for="tocht">Tocht:</label>
				<input value="<?php echo $boeking->getTocht()->getOmschrijving(); ?>" type="text" class="form-control" id="tocht" disabled>
			</div>
			<br />
			<button name="delete" type="submit" class="btn btn-danger">Verwijderen</button>
			<button name="cancel" type="submit" class="btn btn-primary">Annuleren</button>
		</form>
	<?php
		break;
	default:
	?>
		<h3>Boeking Klant</h3>
		<?php
		$boekingen = $db->getBoekingenByKlantID($_SESSION['id']); //$_SESSION['klant_id']
		if (count($boekingen) == 0) {
		?>
			<div class="alert alert-info mt-2" role="alert">
				<i class="fa fa-info-circle" aria-hidden="true"></i>
				<span class="sr-only">Error:</span>
				U heeft nog geen boekingen.
			</div>
		<?php } else { ?>
			<table>
				<tr>
					<th>Startdatum</th>
					<th>Einddatum</th>
					<th>Status</th>
					<th>Pincode</th>
					<th>Tocht</th>
					<th>Bijwerken</th>
				</tr>
			<?php
			foreach ($boekingen as $boeking) {
				echo "<tr>";
				echo "<td>" . $boeking->getStartdatum() . "</td>";
				echo "<td>" . date('Y-m-d', strtotime($boeking->getStartdatum() . ' + ' . $boeking->getTocht()->getAantalDagen() . ' days')) . "</td>";
				echo "<td>" . $boeking->getStatus()->getStatus() . "</td>";
				echo "<td>" . $boeking->getPINCode() . "</td>";
				echo "<td>" . $boeking->getTocht()->getOmschrijving() . "</td>";
				echo "<td class='px-0 d-flex justify-content-center'>
					<a class='mx-1' href='?id={$boeking->getID()}&view=edit'><button class='btn btn-primary min-height-0 btn-sm'><i class='fa-solid fa-pen-to-square'></i></button></a>
					<a class='mx-1' href='?id={$boeking->getID()}&view=delete'><button class='btn btn-danger min-height-0 btn-sm'><i class='fa-solid fa-trash-can'></i></button></a>
				</td>";
				echo "</tr>";
			}
			echo "</table>";
		}
			?>
			<a href="reserveren" class="w-100 mt-3"><button class="w-100 btn btn-primary">Boeking toevoegen</button></a>
	<?php
		break;
}
	?>
	<?php include "./include/footer.php"; ?>