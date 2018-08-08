<?php
	require_once "../init.php";

	if ($_SERVER["REQUEST_METHOD"] == "POST"){
		realizujZamowienie($_POST);
	}

	$akc = array('akcKie', 'akcZam', 'akcKsie', 'akcPre');
	$warunek = 'statusReal ="0" AND z.akcPre > 0';
	if (getPozycja() == 'akcPra') {
		$warunek .= " AND z.idOsoby =" . $_SESSION[APP_NAME]['idOsoby'];
	} elseif (getPozycja() == 'akcKie') {
		$warunek .= "AND p.idDzial =" . $_SESSION[APP_NAME]['idDzial'];
	}
	$zamowienia = getZamowienia($warunek);
	$personel = getPersonel();
	$tytul = 'zamówienia do realizacji';
	include APP_DIR . "/view/zamowienia/doakceptacji.view.php";
?>