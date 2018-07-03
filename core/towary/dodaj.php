<?php
	require_once "../init.php";

	if ($_SERVER["REQUEST_METHOD"] == "POST"){
		addTowar($_POST);
	}		
	$towary = getTowary();
	$dzialy = getDzialy();
	include APP_DIR . "/view/towary/dodaj.view.php";
?>