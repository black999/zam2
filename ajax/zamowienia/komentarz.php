<?php 
	require_once "../../core/init.php";	

	if ($_POST['akcja'] == 'pobierz') {
	} ;

	if ($_POST['akcja'] == 'dodaj') {
		addKomentarz($_POST);
	} 	
	$komentarze = getKomentarze('idZam ='. $_POST['idZam']);
?>

<?php foreach ($komentarze as $komentarz) : ?>
	<p class="font-sm kom-data" > <?= $komentarz['data'] ?></p>	
	<p class="kom-nazwisko"><b >Stalicki ireneusz: </b><i><?= $komentarz['komentarz'] ?></i></p>
<?php endforeach ?>
