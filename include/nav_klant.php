<?php include "./include/head_klant.php"; ?>
<?php
	function formatPhone($phone) {
		$phone = preg_replace("/[^0-9]/", "", $phone);
		$phone = preg_replace('~.*(\d{3})[^\d]{0,7}(\d{3})[^\d]{0,7}(\d{4}).*~', "$1-$2-$3", $phone);
		return $phone;
	}
?>
<div class="container">
	<div class="crud-container">
		<div class="row">
			<h2 class="col-4">Mijn Donkey Travel</h2>
			<div class="col-8">
				<div class="float-end">
					<p class="my-0">Ingelogd als:</p>
					<p class="my-0 text-end fw-light"><?php echo $_SESSION['naam'] . " [ " . $_SESSION['email'] . " ]" . " ( + " . formatPhone($_SESSION['telefoon']) . " )"; ?></p>
				</div>
			</div>
		</div>
		<ul class="nav nav-tabs">
			<li class="nav-item">
				<a id="nav-klant-beheer" class="nav-link <?php if (endsWith(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), "boekingen", "reserveren")) echo "active\" aria-current=\"page"; ?>" href="boekingen">Boekingen</a>
			</li>
			<li class="nav-item">
				<a id="nav-klant-account" class="nav-link <?php if (endsWith(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), "account")) echo "active\" aria-current=\"page"; ?>" href="account">Account</a>
			</li>
			<li class="nav-item ms-auto">
				<a class="nav-link text-danger" href="../logout">Logout</a>
			</li>
		</ul>
		<div class="crud-form row mx-0">