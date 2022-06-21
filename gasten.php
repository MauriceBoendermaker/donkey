<?php include "include/nav.php"; ?>
<?php include "include/tabs_beheer.php"; ?>
<!-- debug print database Statussen -->
<?php
$db = new database\Database($db_host, $db_user, $db_pass, $db_name, $db_port);
$gasten = $db->getKlanten();

function formatPhone($phone)
{
    $phone = preg_replace("/[^0-9]/", "", $phone);
    $phone = preg_replace('~.*(\d{3})[^\d]{0,7}(\d{3})[^\d]{0,7}(\d{4}).*~', "$1-$2-$3", $phone);
    return $phone;
}

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
    echo "<td>+ " . formatPhone($gast->getTelefoon()) . "</td>";
    echo "</tr>";
}
echo "</table>";
?>
<?php include "include/footer.php"; ?>