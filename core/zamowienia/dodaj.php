<?php
	require_once "../funkcje.php";
	require_once "../init.php";

	if ($_SERVER["REQUEST_METHOD"] == "POST"){
		addZamowienie($_POST);
	}
	$zamowienia = getZamowienia('statusZatw ="0"');
	$towary = getTowary();
	include APP_DIR . "/view/zamowienia/dodaj.view.php";
?>