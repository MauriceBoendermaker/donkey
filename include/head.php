<?php
//using the database/Database.php class
include_once 'database/Database.php';

session_start();

function endsWith($string, $endString)
{
	$len = strlen($endString);
	if ($len == 0) {
		return true;
	}
	return (substr($string, -$len) === $endString);
}

// check if user is on login page
if (!endsWith($_SERVER['PHP_SELF'], 'login.php')) {
	// check if the user is logged in
	if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] == false) {
		// redirect to index.php
		header('Location: login.php');
		exit;
	}
}

?>
<!-- crud+s main page styled by bootstrap -->
<!DOCTYPE html>
<html lang="en">

<head>
	<title>Donkey Travel</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.7.1/leaflet.css" />

	<link rel="stylesheet" href="css/style.css">

</head>