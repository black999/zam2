<?php
	require_once "../init.php";

	if ($_SERVER["REQUEST_METHOD"] == "POST"){
		uploadFile($_FILES);
	}		

	include APP_DIR . "/view/faktury/dodaj.view.php";
?>