<?php 
	require_once "../../core/init.php";	

	if ($_POST['akcja'] == 'pobierz') {
	} ;

	if ($_POST['akcja'] == 'dodaj') {
		$_POST['idOsoby'] = $_SESSION[APP_NAME]['idOsoby'];
		$_POST['imieNazwisko'] = $_SESSION[APP_NAME]['imie'] . " " . $_SESSION[APP_NAME]['nazwisko'];
		addKomentarz($_POST);
	} 	
	$komentarze = getKomentarze('idZam ='. $_POST['idZam']);
?>

<?php foreach ($komentarze as $komentarz) : ?>
	<p class="font-sm kom-data" > <?= $komentarz['data'] ?></p>	
	<p class="kom-nazwisko"><b><?= $komentarz['imieNazwisko'].":" ?></b>
		<?php if ($komentarz['ok'] == '0') : ?>
			<i style="color : red">
		<?php else : ?>
			<i>
		<?php endif ?>
		<?= $komentarz['komentarz'] ?></i></p>
<?php endforeach ?>
