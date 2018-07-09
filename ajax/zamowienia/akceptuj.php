<?php
	require_once "../../core/init.php";

	akceptujZamowienie($_POST['idZam'], getPozycja(), $_POST['ok'] );
	$akc = array('akcKie', 'akcZam', 'akcKsie', 'akcPre');
	$warunek = '(statusZatw ="1" AND z.id =' . $_POST['idZam'] . ')';
	$zamowienie = getZamowienia($warunek)[$_POST['idZam']];

	include APP_DIR . '/view/zamowienia/lista_zamowienie.inc.php';
