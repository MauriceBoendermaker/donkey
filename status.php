<?php include "include/nav_beheer.php"; ?>
<!-- debug print database Statussen -->
<?php
$db = new database\Database("localhost", "root", "", "donkey", null);
$statussen = $db->getStatussen();

// statussen
// ID INT
// StatusCode TINYINT(4)
// Status VARCHAR(40)
// Verwijderbaar BIT
// PINtoekennen BIT

$id = -1;
$view = null;
if (isset($_GET['id']))
	$id = $_GET['id'];
if (isset($_GET['view']))
	$view = $_GET['view'];


if (isset($_POST['cancel'])) {
	home();
}

if (isset($_POST['delete']) && isset($_POST['id'])) {
	$db->deleteStatus($_POST['id']);
	home();
}

if (isset($_POST['add'])) {
    $db->addStatus($_POST['statusCode'], $_POST['status'], $_POST['verwijderbaar'], $_POST['PINtoekennen']);
    home();
}

function home()
{
	header('Location: status.php');
	exit();
}

switch ($view) {
	case 'edit':
		$status = $db->getStatusByID($id);
		?>
		<h3>Tocht gegevens wijzigen</h3>
		<form action="" method="post">
			<div class="form-group">
				<label for="statusCode">Code:</label>
				<input type='number' class='form-control' id='statusCode' value='<?php echo $status->getStatusCode(); ?>'>
			</div>
			<div class="form-group">
				<label for="status">Status:</label>
				<input type='text' class='form-control' id='status' value='<?php echo $status->getStatus(); ?>'>
			</div>
			<div class="form-group">
				<label for="verwijderbaar">Verwijderbaar:</label>
				<input type='checkbox' class='' id='verwijderbaar' <?php if ($status->getVerwijderbaar() == 1) {
					echo "checked";
				} else if ($status->getVerwijderbaar() == 0) {
					echo "";
				} ?>>
			</div>
			<div class="form-group">
				<label for="pinToekennen">PIN toekennen:</label>
				<input type='checkbox' class='' id='pinToekennen' <?php if ($status->getPintoekennen() == 1) {
					echo "checked";
				} else if ($status->getPintoekennen() == 0) {
					echo "";
				} ?>>
			</div>
			<br/>
			<button type="submit" name="save" class="btn btn-success">Bewaren</button>
			<button type="submit" name="cancel" class="btn btn-primary">Annuleren</button>
		</form>
		<?php
		break;
	case 'delete':
		$status = $db->getStatusByID($id);
		?>
		<h3>Tocht verwijderen</h3>
		<form action="" method="post">
			<div class="form-group">
				<label for="statusCode">Code:</label>
				<input type='number' class='form-control' id='statusCode' value='<?php echo $status->getStatusCode(); ?>' disabled>
			</div>
			<div class="form-group">
				<label for="status">Status:</label>
				<input type='text' class='form-control' id='status' value='<?php echo $status->getStatus(); ?>' disabled>
			</div>
			<div class="form-group">
				<label for="verwijderbaar">Verwijderbaar:</label>
                <input type='text' class='form-control' id='verwijderbaar' value='<?php if ($status->getVerwijderbaar() == 1) {
                    echo "Ja";
                } else if ($status->getVerwijderbaar() == 0) {
                    echo "Nee";
                } ?>' disabled>
			</div>
			<div class="form-group">
				<label for="pinToekennen">PIN toekennen:</label>
				<input type='text' class='form-control' id='verwijderbaar' value='<?php if ($status->getPintoekennen() == 1) {
					echo "Ja";
				} else if ($status->getPintoekennen() == 0) {
					echo "Nee";
				} ?>' disabled>
			</div>
			<br/>
			<button type="submit" name="save" class="btn btn-danger">Verwijderen</button>
			<button type="submit" name="cancel" class="btn btn-primary">Annuleren</button>
		</form>
		<?php
        break;
    case 'add':
        ?>
        <h3>Status toevoegen</h3>
        <form action="" method="post">
            <div class="form-group">
                <label for="statusCode">Code:</label>
                <input type='text' class='form-control' id='statusCode' name='statusCode'>
            </div>
            <div class="form-group">
                <label for="status">Status:</label>
                <input type='text' class='form-control' id='status' name='status'>
            </div>
            <div class="form-group">
                <label for="aantalDagen">Aantal dagen:</label>
                <input type='number' class='form-control' id='aantalDagen' name='aantalDagen'>
            </div>
            <div class="form-group">
                <label for="verwijderbaar">Verwijderbaar:</label>
                <input type='checkbox' class='' id='verwijderbaar' name='verwijderbaar'>
            </div>
            <div class="form-group">
                <label for="PINtoekennen">Pin toekennen:</label>
                <input type='checkbox' class='' id='PINtoekennen' name='PINtoekennen'>
            </div>
            <br/>
            <button type="submit" name="add" class="btn btn-success">Toevoegen</button>
            <button type="submit" name="cancel" class="btn btn-primary">Annuleren</button>
        </form>
        <?php
        break;
    default:
		?>
<h3>Database Statussen</h3>
<table>
	<tr>
		<th>Code</th>
		<th>Status</th>
		<th>Verwijderbaar</th>
		<th>PIN toekennen</th>
		<th class="d-flex justify-content-center"><a class='mx-1' href='?view=add'><button><i class="fa-solid fa-plus"></i></button></a></th>
	</tr>
<?php
	foreach ($statussen as $status) {
		echo "<tr>";
		echo "<td>" . $status->getStatusCode() . "</td>";
		echo "<td>" . $status->getStatus() . "</td>";
		echo "<td>" . ($status->getVerwijderbaar() ? "true" : "false") . "</td>";
		echo "<td>" . ($status->getPintoekennen() ? "true" : "false") . "</td>";
		echo "<td class='px-0 d-flex justify-content-center'>
			<a class='mx-1' href='?id={$status->getID()}&view=edit'><button><i class='fa-solid fa-pen-to-square'></i></button></a>
			<a class='mx-1' href='?id={$status->getID()}&view=delete'><button><i class='fa-solid fa-trash-can'></i></button></a>
		</td>";
		echo "</tr>";
	}
	echo "</table>";
}
?>
<?php include "include/footer.php"; ?>