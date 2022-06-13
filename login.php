<?php include "include/head.php";

// php code for login form with bootstrap use input email and password fields

// klanten
// ID INT
// Naam VARCHAR(50)
// Email VARCHAR(100)
// Telefoon VARCHAR(20)
// Wachtwoord VARCHAR(100)
// Gewijzigd TIMESTAMP

// check for login submit
if (isset($_POST['email']) && isset($_POST['password'])) {
	// get email and password from form
	$email = $_POST['email'];
	// hash password
	$password = hash('sha256', $_POST['password']);

	// connect to database
	$db = new database\Database("localhost", "root", "", "donkey", null);

	// get klant by email
	$klant = $db->getKlantByEmail($email);

	// check if klant exists
	if ($klant) {
		// check if password is correct
		if ($klant->getWachtwoord() == $password) {
			// set session variables
			$_SESSION['loggedin'] = true;
			$_SESSION['id'] = $klant->getId();
			$_SESSION['naam'] = $klant->getNaam();
			$_SESSION['email'] = $klant->getEmail();
			$_SESSION['telefoon'] = $klant->getTelefoon();

			// redirect to index.php
			header('Location: index.php');
			exit;
		} else {
			// show error message
			echo '<div class="alert alert-danger" role="alert">
				  Wrong password
				</div>';
		}

	} else {
		// show error message
		echo '<div class="alert alert-danger" role="alert">
			  Wrong email
			</div>';
	}
}

// if user is logged in, redirect to index.php

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
	header('Location: index.php');
	exit;
}

?>

<body>
<!-- Login form with bootstrap use input email and password fields -->
<div class="container">
	<div class="row">
		<div class="col-md-4 offset-md-4">
			<div class="card">
				<div class="card-body">
					<h3 class="card-title text-center">Login</h3>
					<form action="login.php" method="post">
						<div class="form-group">
							<label for="email">Email</label>
							<input type="email" class="form-control" id="email" name="email" placeholder="Email" required>
						</div>
						<div class="form-group">
							<label for="password">Password</label>
							<input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
						</div>
						<div class="form-group">
							<button type="submit" class="btn btn-primary btn-block">Login</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
</body>