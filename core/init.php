<?php
	define('APP_DIR', $_SERVER['DOCUMENT_ROOT'] . 'zam2');
	define('SITEROOT',"http://" . $_SERVER['SERVER_NAME'] . '/zam2' );
	define('TIMEOUT', '3600');

	require_once APP_DIR . '/inc/nazwadb.inc.php';
	
	$pdo = polaczZBaza($host, $uzytkownik, $haslo, $nazwabazydanych);