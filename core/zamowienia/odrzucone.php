<?php
	require_once "../init.php";

	$akc = array('akcKie', 'akcZam', 'akcKsie', 'akcPre');
	$warunek = 'statusZatw ="1" AND z.akcPre < 0';
	if (getPozycja() == 'akcPra') {
		$warunek .= " AND z.idOsoby =" . $_SESSION[APP_NAME]['idOsoby'];
	} elseif (getPozycja() == 'akcKie') {
		$warunek .= "AND p.idDzial =" . $_SESSION[APP_NAME]['idDzial'];
	}
	$zamowienia = getZamowienia($warunek);
	$personel = getPersonel();
	$tytul = 'zamówienia odrzucone';
	include APP_DIR . "/view/zamowienia/doakceptacji.view.php";
?>