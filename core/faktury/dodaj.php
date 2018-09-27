<?php
	require_once "../init.php";

	if ($_SERVER["REQUEST_METHOD"] == "POST"){
		uploadFile($_FILES, $_POST);
	}	

	$faktury = getFaktury();	

	include APP_DIR . "/view/faktury/dodaj.view.php";
?>