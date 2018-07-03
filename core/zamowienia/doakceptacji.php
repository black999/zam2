<?php
	require_once "../init.php";

	if ($_SERVER["REQUEST_METHOD"] == "POST"){

	}
	$zamowienia = getZamowienia('statusZatw ="1"');
	$personel = getPersonel();
	include APP_DIR . "/view/zamowienia/doakceptacji.view.php";
?>