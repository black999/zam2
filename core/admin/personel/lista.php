<?php
	require_once "../../init.php";

	if ($_SERVER["REQUEST_METHOD"] == "POST"){  //dodanie lub aktaulizacja danych pracownika
		if ($_POST['id'] == '0'){
			addPersonel($_POST);
		} else {
			updatePersonel($_POST);
		}
	}		
	if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])){ //pobranie danych pracownka do aktualizacji
		$pracownik = getPersonel("id = " . $_GET['id']);
	} else {
		$pracownik = 	['id' => '0', 'imie' => '', 'nazwisko' => '', 'email' => '', 'login' => '', 'haslo' => '',
						 'idDzial' => '0', 'uPrac' => '0', 'uKier' => '0', 'uZampub' => '0',
						 'uKsieg' => '0', 'uPrez' => '0', 'uAdmin' => '0', 'realBiuro' => '0'];
	}	
	$personel = getPersonel();
	$dzialy = getDzialy();
	include APP_DIR . "/view/admin/personel/lista.view.php";
?>