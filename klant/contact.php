<body>
<?php include "include/nav_klant.php"; ?>
					<!-- Welcome screen saying name of user -->
					<?php
					if (isset($_SESSION['naam'])) {
						echo "<h3>Welkom, " . $_SESSION['naam'] . "!</h3>";
					} else
						echo "<h3>Welkom, Gast</h3>";
					?>
					<div class="alert alert-info" role="alert">
						<h3>Contact gegevens</h3>
							Donkey Travel<br/>
							Lange baan 15a<br/>
							5686 BN Mooiburen
					</div>
<?php include "include/footer.php" ?>
		</div>
	</div>
</body>
</html>