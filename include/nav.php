<?php include "include/head.php"; ?>
<?php
	function formatPhone($phone)
	{
		$phone = preg_replace("/[^0-9]/", "", $phone);
		$phone = preg_replace('~.*(\d{3})[^\d]{0,7}(\d{3})[^\d]{0,7}(\d{4}).*~', "$1-$2-$3", $phone);
		return $phone;
	}
?>
<div class="container">
	<div class="crud-container">
		<div class="row">
			<h2 class="col-5">Donkey Travel Administrative Tools</h2>
			<div class="col-7">
				<div class="float-end">
					<p class="my-0">Ingelogd als:</p>
					<p class="my-0 text-end fw-light"><?php echo $_SESSION['naam'] . " [ " . $_SESSION['email'] . " ]" . " ( + " . formatPhone($_SESSION['telefoon']) . " )"; ?></p>
				</div>
			</div>
		</div>
		<?php
		$welcome = endsWith($_SERVER['REQUEST_URI'], "/");

		$boekingen = endsWith($_SERVER['REQUEST_URI'], "boekingen");

		?>
		<ul class="nav nav-tabs">
			<li class="nav-item">
				<a class="nav-link <?php if ($welcome) echo "active\" aria-current=\"page"; ?>" aria-current="page" href="./">Welcome</a>
			</li>
			<li class="nav-item">
				<a class="nav-link <?php if ($boekingen) echo "active\" aria-current=\"page"; ?>" href="boekingen">Boekingen</a>
			</li>
			<li class="nav-item">
				<a class="nav-link <?php if (!$welcome && !$boekingen) echo "active\" aria-current=\"page"; ?>" href="gasten">Beheer</a>
			</li>
			<li class="nav-item ms-auto">
				<a class="nav-link text-danger" href="logout">Logout</a>
			</li>
		</ul>
		<div class="crud-form row mx-0">