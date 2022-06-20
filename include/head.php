<?php
session_start();

//using the Database class
include_once 'config.php';
include_once 'database/database.php';

function endsWith($string, $endString)
{
	$len = strlen($endString);
	if ($len == 0) {
		return true;
	}
	return (substr($string, -$len) === $endString);
}

//// check if user is on login page
//if (!endsWith($_SERVER['REQUEST_URI'], 'login.php') && !endsWith($_SERVER['REQUEST_URI'], 'register.php')) {
//	// check if the user is logged in
//	if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] == false) {
//		// redirect to index.php
//		header('Location: login.php');
//		exit;
//	}
//	if ($_SESSION['rechten']['read'] == false) {
//		header('Location: klant/boekingen.php');
//		exit;
//	}
//}

?>
<!-- crud+s main page styled by bootstrap -->
<!DOCTYPE html>
<html lang="en">

<head>
	<title>Donkey Travel</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
	<script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.7.1/leaflet.css" />

	<link rel="stylesheet" href="css/style.css">

</head>