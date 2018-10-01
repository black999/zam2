<?php
	define('APP_NAME', 'zam2');
	// define('APP_DIR', $_SERVER['DOCUMENT_ROOT'] . '/'. APP_NAME);
	define('APP_DIR', $_SERVER['DOCUMENT_ROOT'] .  APP_NAME);
	// die(APP_DIR);
	define('SITEROOT',"http://" . $_SERVER['SERVER_NAME'] . '/'. APP_NAME );
	define('TIMEOUT', '3600');

	define('PRACOWNIK', 1);
	define('KIEROWNIK', 2);
	define('ZAM_PUB', 4);
	define('KSIEGOWY', 8);
	define('PREZES', 16);

	define('DIR_FAK_NAME', '/faktury/');
	define('DIR_FAKTURY', APP_DIR . DIR_FAK_NAME);

	require_once APP_DIR . '/inc/nazwadb.inc.php';
	require_once "funkcje.php";
	
	$pdo = polaczZBaza($host, $uzytkownik, $haslo, $nazwabazydanych);
	
	$uri = explode('/', $_SERVER['REQUEST_URI']);	
	if (end($uri) != 'login.php') {
		sprawdzSesje();
	}