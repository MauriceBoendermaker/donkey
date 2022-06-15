<?php include "../include/nav_klant.php"; ?>
<!-- debug print database Herbergen -->
<?php
$db = new database\Database("localhost", "root", "", "donkey", null);
$klanten = $db->getKlanten();

// klanten
// ID INT
// Naam VARCHAR(50)
// Email VARCHAR(100)
// Telefoon VARCHAR(20)
// Wachtwoord VARCHAR(100)
// FKgebruikersrechtenID INT (foreign key)
// Gewijzigd TIMESTAMP

$id = -1;
$view = null;


$id = $_SESSION['id'];


if (isset($_POST['cancel'])) {
	home();
}

if (isset($_POST['save'])) {
	if ($_POST['wachtwoord'] == $_POST['wachtwoord2']) {
		$password = hash('sha256', $_POST['wachtwoord']);
		$db->setKlant($id, $_POST['naam'], $_POST['email'], $_POST['telefoon'], $password, null);
		home();
	} else {
		echo "<div class='alert alert-danger' role='alert'>
				<i class='fa fa-exclamation-triangle' aria-hidden='true'></i>
				<span class='sr-only'>Error:</span>
				Wachtwoorden komen niet overeen.
			</div>";
	}
}

if (isset($_POST['delete']) && isset($_POST['id'])) {
	$db->deleteKlant($_POST['id']);
	home();
}

function home()
{
	header('Location: boeking.php');
	exit();
}
		$klant = $db->getKlantByID($id);
		?>
		<h3>Mijn account wijzigen</h3>
		<form action="" method="post">
			<input type="hidden" name="id" value="<?php echo $klant->getID(); ?>">
			<div class="form-group">
				<label for="naam">Naam:</label>
				<input type='text' class='form-control' id='naam' name='naam' value='<?php echo $klant->getNaam(); ?>'>
			</div>
			<div class="form-group">
				<label for="adres">Emailadres:</label>
				<input type='email' class='form-control' id='email' name='email' value='<?php echo $klant->getEmail(); ?>'>
			</div>
			<div class="form-group">
				<label for="telefoon">Telefoon:</label>
				<input type='tel' class='form-control' id='telefoon' name='telefoon' value='<?php echo $klant->getTelefoon(); ?>'>
			</div>
			<div class="form-group">
				<label for="wachtwoord">Wachtwoord:</label>
				<input type='password' class='form-control' id='wachtwoord' name='wachtwoord' value=''>
			</div>
			<div class="form-group">
				<label for="wachtwoord2">Bevestig wachtwoord:</label>
				<input type='password' class='form-control' id='wachtwoord2' name='wachtwoord2' value=''>
			</div>
			<br />
			<div style="width: fit-content;">
				<button type="submit" name="save" class="btn btn-success float-start">Bewaren</button>
				<button type="submit" name="cancel" class="btn btn-primary float-end">Annuleren</button>
				<br/>
				<button type="submit" name="delete" class="btn btn-danger mt-4 mb-3">Verwijderen mijn account</button>
			</div>
		</form>

<?php include "../include/footer.php"; ?>