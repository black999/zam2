<?php 
	require_once "init.php";

	if ($_SERVER["REQUEST_METHOD"] == "POST"){
		$_POST['haslo'] = md5($_POST['haslo']);
		if ($sesja = zaloguj($_POST)) {
			session_start();
			$_SESSION = $sesja;
		    header("Location:". SITEROOT . "/index.php");
		}
	}		
	include APP_DIR . "/view/login.view.php";
 ?>


