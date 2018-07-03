<?php
	require_once "../init.php";

	if ($_SERVER["REQUEST_METHOD"] == "POST"){
		updateTowar($_POST);
		header("Location: dodaj.php");	
	}		
	$towary = getTowary();
	$dzialy = getDzialy();
	$towar = $towary[$_GET['id']];
	include APP_DIR . "/view/towary/edycja.view.php";
?>