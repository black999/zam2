<!DOCTYPE html>
<html>
<head>
	<?php 
    	require APP_DIR . "/inc/naglowek.inc.php";
  	?>
	<title>Nowe zamowienie</title>
</head>
<body>
<div class="dialog dialog-sm">
	<button id="zamknij">zamknij</button>
	<p id='p2'></p>
	<form id="dodaj-msg" method="POST" action="<?= SITEROOT ?>/ajax/zamowienia/komentarz.php" >
		<input class="long" data-idzam="" id="input1" type="text" name="komentarz">
		<input type="submit" value="dodaj"></button>
	</form>
</div>
<div class="tytul">Nowe zamówienie</div>	
<div>
	<form action="#" method="POST">
		<label>Wybierz towar:</label> 
		<select id="sel1" name="idTowaru" required>
			<option></option>
			<?php foreach ($towary as $towar) : ?>
				<option data-cenaZak="<?= $towar['cenaZak'] ?>" value="<?= $towar['id'] ?>" >
					<?= $towar['nazwa'] . " - Cena " . $towar['cenaZak'] . " zł" ?>
				</option>
			<?php endforeach ?>
		</select>
		<a href='../towary/dodaj.php' class="btn">Nowy towar</a>
		<label>Ilość:</label>
		<input class="short" type="number" name="ilosc" value="1" max="10000">	
		<label>Cena zakupu:</label>
		<input class="short" id="cenaZak" name="cenaZak"><br>
		<label>Zużyto bezpośrednio na cele: </label>
		<select name="cel" required>
			<option></option>
			<option>Opcja 1</option>
			<option>Opcja 2</option>
			<option>Opcja 3</option>
			<option>Opcja 4</option>
		</select>
		<br>
		<label>Koszty dodatkowe : </label>
		<input type="text" name="kosztOpis" placeholder="np. kurier">
		<label>Wartość : </label>
		<input class="short" type="text" name="kosztCena">
		<button type="submit" class="btn-success">Zapisz</button>
		<!-- <a href='../towary/dodaj.php' ><i class="fas fa-plus-circle fa-lg" style="color: gray"></i></a> -->
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