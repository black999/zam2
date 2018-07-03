<!DOCTYPE html>
<html>
<head>
	<?php 
    	require APP_DIR . "/inc/naglowek.inc.php";
  	?>
	<title>Nowe zamowienie</title>
</head>
<body>
<div class="tytul edit">Edycja zamowienia</div>	
<div>
	<form action="#" method="POST">
		<input type="hidden" name="id" value="<?= $zamowienie['id'] ?>">
		<label>Towar:</label> 
		<select id="sel1" name="idTowaru" readonly>
			<?php foreach ($towary as $towar) : ?>
				<option data-cenaZak="<?= $towar['cenaZak'] ?>" value="<?= $towar['id'] ?>" <?= ($zamowienie['idTowaru'] == $towar['id']) ? " selected" :"" ?> >
					<?= $towar['nazwa'] . " - Cena " . $towar['cenaZak'] . " zł" ?>
				</option>
			<?php endforeach ?>
		</select>
		<button type="submit" class="btn-success">Zapisz</button><br>
		<label>Ilość:</label>
		<input class="short" type="number" name="ilosc" max="10000" value="<?= $zamowienie['ilosc'] ?>">	
		<label>Cena zakupu:</label>
		<input class="short"  name="cenaZak" value="<?= $zamowienie['cenaZak'] ?>">
		<label>Koszt realizacji:</label>
		<input class="short" type="text" name="kosztCena" value="<?= $zamowienie['kosztCena'] ?>">
		<label>Opis kosztu:</label>
		<input type="text" name="kosztOpis" placeholder="np. kurier" value="<?= $zamowienie['kosztOpis'] ?>">
	</form>
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