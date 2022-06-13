<?php use database\Klant;

include "include/head.php";

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
	header('Location: index.php');
	exit;
}

// php code for registration form with bootstrap use input name, email, password, password confirmation and phone number fields

// klanten
// ID INT
// Naam VARCHAR(50)
// Email VARCHAR(100)
// Telefoon VARCHAR(20)
// Wachtwoord VARCHAR(100)
// Gewijzigd TIMESTAMP


// if form is submitted
if (isset($_POST['name']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['phone'])) {
	// create a new klant object
	$password = hash('sha256', $_POST['password']);
	$klant = new Klant(null, $_POST['name'], $_POST['email'], $_POST['phone'], $password, 0, null);
	// save to database
	$klant->save();
	// show success message
	echo '<div class="alert alert-success" role="alert">
		  Account aangemaakt
		</div>';

	// set session variables
	$_SESSION['loggedin'] = true;
	$_SESSION['id'] = $klant->getId();
	$_SESSION['naam'] = $klant->getNaam();
	$_SESSION['email'] = $klant->getEmail();
	$_SESSION['telefoon'] = $klant->getTelefoon();

	// redirect to index.php
	header('Location: index.php');
	exit;
}

// if form is not submitted
else {
	// show form
	echo '<div class="alert alert-info" role="alert">
		  Vul uw gegevens in
		</div>';
}

?>

<body>
<!-- register register form with bootstrap use input name, email, password, password confirmation and phone number fields -->
<div class="container">
	<div class="row">
		<div class="col-md-4 offset-md-4">
			<div class="card">
				<div class="card-body">
					<h3 class="card-title text-center">Donkey Travel account aanvragen</h3>
					<form action="register.php" name="register" method="post">
						<div class="form-group">
							<label for="name">Naam</label>
							<input type="text" class="form-control" id="name" name="name" placeholder="Naam" required>
						</div>
						<div class="form-group">
							<label for="email">Email</label>
							<input type="email" class="form-control" id="email" name="email" placeholder="Email" required>
						</div>
						<div class="form-group">
							<label for="password">Wachtwoord</label>
							<input type="password" class="form-control" id="password" name="password" placeholder="Wachtwoord" required>
						</div>
						<div class="form-group">
							<label for="phone">Telefoonnummer</label>
							<input type="text" class="form-control" id="phone" name="phone" placeholder="Telefoonnummer" required>
						</div>
						<div class="form-group">
							<button type="submit" class="btn btn-primary btn-block">Aanvragen</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
</body>