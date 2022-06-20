<?php include "include/head.php"; ?>
<div class="container">
	<div class="crud-container">
		<h2>Donkey Travel Administrative Tools</h2>
		<ul class="nav nav-tabs">
			<li class="nav-item">
				<a class="nav-link <?php if (endsWith($_SERVER['REQUEST_URI'], "/")) echo "active\" aria-current=\"page"; ?>" aria-current="page" href="./">Welcome</a>
			</li>
			<li class="nav-item">
				<a class="nav-link <?php if (endsWith($_SERVER['REQUEST_URI'], "boekingen")) echo "active\" aria-current=\"page"; ?>" href="boekingen">Boekingen</a>
			</li>
			<li class="nav-item">
				<a class="nav-link <?php if (endsWith($_SERVER['REQUEST_URI'], "gasten")) echo "active\" aria-current=\"page"; ?>" href="gasten">Beheer</a>
			</li>
			<li class="nav-item ms-auto">
				<a class="nav-link text-danger" href="logout">Logout</a>
			</li>
		</ul>
		<div class="crud-form row mx-0">