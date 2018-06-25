<?php
	require_once "../../core/funkcje.php";
	require_once "../../core/init.php";

	$towary = getTowary();
	// $tab = array('imie' => 'janek', 'nazwisko' => 'nowak');
	// dd($tab);
	echo json_encode($towary);
