<?php include "../include/head_klant.php"; ?>
<div class="container">
	<div class="crud-container">
		<h2>Mijn Donkey Travel</h2>
		<ul class="nav nav-tabs">
			<li class="nav-item">
				<a id="nav-klant-beheer" class="nav-link <?php if (endsWith($_SERVER['REQUEST_URI'], "boeking.php")) echo "active\" aria-current=\"page"; ?>" href="boeking.php">Boekingen</a>
			</li>
			<li class="nav-item">
				<a id="nav-klant-account" class="nav-link <?php if (endsWith($_SERVER['REQUEST_URI'], "account.php")) echo "active\" aria-current=\"page"; ?>" href="account.php">Account</a>
			</li>
			<li class="nav-item ms-auto">
				<a class="nav-link text-danger" href="../logout.php">Logout</a>
			</li>
		</ul>
		<div class="crud-form row mx-0">