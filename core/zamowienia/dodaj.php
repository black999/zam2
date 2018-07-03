<?php
	require_once "../init.php";

	if ($_SERVER["REQUEST_METHOD"] == "POST"){
		$_POST['idOsoby'] = $_SESSION[APP_NAME]['idOsoby'];
		addZamowienie($_POST);
	}
	$zamowienia = getZamowienia('statusZatw ="0"');
	$towary = getTowary();
	include APP_DIR . "/view/zamowienia/dodaj.view.php";
?>