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
echo "<th>ID</th>";
echo "<th>Naam</th>";
echo "<th>Email</th>";
echo "<th>Telefoon</th>";
echo "<th>Wachtwoord</th>";
echo "<th>Gewijzigd</th>";
echo "</tr>";
foreach ($gasten as $gast) {
    echo "<tr>";
    echo "<td>" . $gast['ID'] . "</td>";
    echo "<td>" . $gast['Naam'] . "</td>";
    echo "<td>" . $gast['Email'] . "</td>";
    echo "<td>" . $gast['Telefoon'] . "</td>";
    echo "<td>" . $gast['Wachtwoord'] . "</td>";
    echo "<td>" . $gast['Gewijzigd'] . "</td>";
    echo "</tr>";
}
echo "</table>";
?>
<?php include "include/footer.php"; ?>