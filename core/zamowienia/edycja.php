<?php
	require_once "../init.php";

	if ($_SERVER["REQUEST_METHOD"] == "POST"){
		$_POST['idOsoby'] = $_SESSION[APP_NAME]['idOsoby'];
		updateZamowienie($_POST);
		header("Location: dodaj.php");	
	}		
	$towary = getTowary();
	$zamowienia = getZamowienia('statusZatw ="0"');
	$zamowienie = $zamowienia[$_GET['id']];
	include APP_DIR . "/view/zamowienia/edycja.view.php";
?>