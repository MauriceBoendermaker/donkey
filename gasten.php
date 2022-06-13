<?php include "include/nav_beheer.php"; ?>
<!-- debug print database Statussen -->
<?php
$db = new database\Database("localhost", "root", "", "donkey", null);
$gasten = $db->getKlanten();

// klanten
// ID INT
// Naam VARCHAR(50)
// Email VARCHAR(100)
// Telefoon VARCHAR(20)
// Wachtwoord VARCHAR(100)
// Gewijzigd TIMESTAMP
echo "<h3>Gasten</h3>";
echo "<table>";
echo "<tr>";
echo "<th>Naam</th>";
echo "<th>Email</th>";
echo "<th>Telefoon</th>";
echo "</tr>";
foreach ($gasten as $gast) {
    echo "<tr>";
    echo "<td>" . $gast->getNaam() . "</td>";
    echo "<td>" . $gast->getEmail() . "</td>";
    echo "<td>" . $gast->getTelefoon() . "</td>";
    echo "</tr>";
}
echo "</table>";
?>
<?php include "include/footer.php"; ?>