<?php include "./include/nav_klant.php"; ?>
<?php
$db = new database\Database($db_host, $db_user, $db_pass, $db_name, $db_port);
//$boekingen = $db->getBoekingenByKlantID(0); //$_SESSION['klant_id']
if (isset($_POST['submit'])) {
    // verify form data
    $startdatum = $_POST['startdatum'];
    $tocht = $_POST['tochtID'];

    $startdatum = date("Y-m-d", strtotime($startdatum));
    $tocht = intval($tocht);

    $boeking = new database\Boeking(null, $startdatum, null, $tocht, $_SESSION['id'], 1);
    $db->applyBoeking($boeking);

    header("Location: boekingen");
    exit;
}
?>
<h3>Boeking Reserveren</h3>
<form action="reserveren" method="post">
    <div class="form-group mt-2">
        <label for="startdatum">Startdatum:</label>
        <input type="date" class="form-control" id="startdatum" name="startdatum" placeholder="Startdatum">
    </div>
    <div class="form-group mt-2">
        <label for="tocht">Tocht:</label>
        <select class="form-select" aria-label="Select tocht" name="tochtID">
            <?php foreach ($db->getTochten() as $tocht) { ?>
                <option value="
                    <?php echo $tocht->getID(); ?>">
                    <?php echo $tocht->getOmschrijving() . " (" . $tocht->getAantalDagen() . " dagen)"; ?>
                <?php } ?>
        </select>
    </div>
    <!-- submit button -->
    <button type="submit" name="submit" class="btn btn-primary mt-3">Boeking reserveren</button>
    <a href="boekingen"><button type="button" class="btn btn-primary mt-3">Terug</button></a>
</form>
<?php include "./include/footer.php"; ?>