<?php
session_start();

// In case one is using PHP 5.4's built-in server
$filename = __DIR__ . preg_replace('#(\?.*)$#', '', $_SERVER['REQUEST_URI']);
if (php_sapi_name() === 'cli-server' && is_file($filename)) {
	return false;
}

// Include the Router class
// @note: it's recommended to just use the composer autoloader when working with other packages too
//require_once __DIR__ . '/../src/Bramus/Router/Router.php';

require_once 'vendor/autoload.php';

function base_url()
{
	$url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['SCRIPT_NAME']);
	return $url;
}

function startWith($haystack, $needle)
{
	return substr($haystack, 0, strlen($needle)) === $needle;
}

// Create a Router
$router = new \Bramus\Router\Router();

// Custom 404 Handler
$router->set404(function () {
	header($_SERVER['SERVER_PROTOCOL'] . ' 404 Not Found');
	echo '404, route not found!';
});

// custom 404
$router->set404('/test(/.*)?', function () {
	header($_SERVER['SERVER_PROTOCOL'] . ' 404 Not Found');
	echo '<h1><mark>404, route not found!</mark></h1>';
});

$router->before('GET', '/(.*)', function($page) {
	if ($page == 'login' || $page == 'register') {
		return;
	}
	if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] == false) {
		header('Location: ' . base_url() . '/login');
		exit;
	}
	if (startWith($page, 'klant/') || $page == 'logout' ) return;
	if ($_SESSION['rechten']['read'] == false) {
		header('Location: klant/boekingen');
		exit;
	}
});

$router->all('/boekingen', function () {
	include 'boekingen.php';
});

$router->all('/gasten', function () {
	include 'gasten.php';
});

$router->all('/herbergen', function () {
	include 'herbergen.php';
});

$router->all('/', function () {
	die();
	if ($_SESSION['rechten']['read'] == false) {
		header('Location: klant/boekingen');
		exit;
	}
	include 'index.php';
});

$router->all('/kaart', function () {
	include 'kaart.php';
});

$router->all('/login', function () {
	include 'login.php';
});

$router->all('/logout', function () {
	include 'logout.php';
});

$router->all('/overnachtingsplaatsen_beheer', function () {
	include 'overnachtingsplaatsen_beheer.php';
});

$router->all('/pauzeplaatsen_beheer', function () {
	include 'pauzeplaatsen_beheer.php';
});

$router->all('/register', function () {
	include 'register.php';
});

$router->all('/restaurants', function () {
	include 'restaurants.php';
});

$router->all('/statussen', function () {
	include 'statussen.php';
});

$router->all('/tochten', function () {
	include 'tochten.php';
});

$router->all('/test', function () {
	include 'test.php';
});

$router->all('/klant/boekingen', function () {
	include 'klant/boekingen.php';
});

$router->all('/klant/account', function () {
	include 'klant/account.php';
});

// Thunderbirds are go!
$router->run();

?>