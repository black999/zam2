<?php
	require_once "../../core/init.php";

	$zamowienie = getZamowienia("z.id = " .$_GET['idZam'])[$_GET['idZam']];
	echo json_encode($zamowienie); 