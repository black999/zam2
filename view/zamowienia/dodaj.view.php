<!DOCTYPE html>
<html>
<head>
	<?php 
    	require APP_DIR . "/inc/naglowek.inc.php";
  	?>
	<title>Nowe zamowienie</title>
</head>
<body>
<div class="tytul">Nowe zamówienie</div>	
<div >
	<form action="#" method="POST">
		<label>Towar:</label> 
		<select id="sel1" name="idTowaru" >
			<?php foreach ($towary as $towar) : ?>
				<option data-cenaZak="<?= $towar['cenaZak'] ?>" value="<?= $towar['id'] ?>" >
					<?= $towar['nazwa'] . " - Cena " . $towar['cenaZak'] . " zł" ?>
				</option>
			<?php endforeach ?>
		</select>
		<button type="submit" class="btn-success">Zapisz</button><br>
		<label>Ilość:</label>
		<input class="short" type="number" name="ilosc" value="1" max="10000">	
		<label>Cena zakupu:</label>
		<input class="short" id="cenaZak" name="cenaZak">
		<label>Koszt realizacji:</label>
		<input class="short" type="text" name="kosztCena">
		<label>Opis kosztu:</label>
		<input type="text" name="kosztOpis" placeholder="np. kurier">
	</form>
</div>
<div class="dial">
	<p>Akcja zakończona powodzeniem</p>
	<button class="button exit">Zamknij</button>
</div>
<?php include "lista.inc.php" ?>    
<script type="text/javascript">
	<?php
		include APP_DIR . "/jquery/zamowienia/dodaj.js";
		include APP_DIR . "/jquery/select2.inc.js";
	?>
</script>
</body>
</html>