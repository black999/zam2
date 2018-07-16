<?php
	require_once "../../core/init.php";

	// akceptacja zamowienia
	akceptujZamowienie($_POST['idZam'], getPozycja(), $_POST['ok'] );
	if ($_POST['komentarz'] != ""){
		$_POST['idOsoby'] = $_SESSION[APP_NAME]['idOsoby'];
		$_POST['imieNazwisko'] = $_SESSION[APP_NAME]['imie'] . " " . $_SESSION[APP_NAME]['nazwisko'];
		$_POST['ok'] = '0';
		addKomentarz($_POST);
	}
	$akc = array('akcKie', 'akcZam', 'akcKsie', 'akcPre');
	$warunek = '(statusZatw ="1" AND z.id =' . $_POST['idZam'] . ')';
	$zamowienie = getZamowienia($warunek)[$_POST['idZam']];

	include APP_DIR . '/view/zamowienia/lista_zamowienie.inc.php';
