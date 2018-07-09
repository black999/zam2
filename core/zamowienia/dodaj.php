<?php
	require_once "../init.php";

	if ($_SERVER["REQUEST_METHOD"] == "POST"){
		$_POST['idOsoby'] = $_SESSION[APP_NAME]['idOsoby'];
		$idZam = addZamowienie($_POST);
		if ( ( $_SESSION[APP_NAME]['upr'] && KIEROWNIK ) > 0 ){
			akceptujZamowienie($idZam, 'akcKie', 'true' );
		};
	};
	$zamowienia = getZamowienia('statusZatw ="0"');
	$towary = getTowary();
	include APP_DIR . "/view/zamowienia/dodaj.view.php";
?>