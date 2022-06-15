<?php include "include/head.php"; ?>
	<div class="container">
		<div class="crud-container">
			<h2>Donkey Travel Administrative Tools</h2>
			<ul class="nav nav-tabs">
				<li class="nav-item">
					<a class="nav-link" aria-current="page" href="index.php">Welcome</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="boekingen.php">Boekingen</a>
				</li>
				<li class="nav-item">
					<a class="nav-link active" href="gasten.php">Beheer</a>
				</li>
				<li class="nav-item ms-auto">
					<a id="nav-klant-account" class="nav-link" href="klant/account.php">Account</a>
				</li>
				<li class="nav-item">
					<a class="nav-link text-danger" href="logout.php">Logout</a>
				</li>
			</ul>
			<div class="crud-form row mx-0 ps-0">
				<div class="col-md-auto">
					<ul class="nav nav-pills flex-column nav-fill">
						<li class="nav-item">
							<a id="nav-gasten" class="nav-link" aria-current="page" href="gasten.php">Gasten</a>
						</li>
						<li class="nav-item">
							<a id="nav-herbergen" class="nav-link" href="herbergen.php">Herbergen</a>
						</li>
						<li class="nav-item">
							<a id="nav-restaurants" class="nav-link" href="restaurants.php">Restaurants</a>
						</li>
						<li class="nav-item">
							<a id="nav-tochten" class="nav-link" href="tochten.php">Tochten</a>
						</li>
						<li class="nav-item">
							<a id="nav-statussen" class="nav-link" href="status.php">Statussen</a>
						</li>
					</ul>
				</div>
				<div class="col-md-10">