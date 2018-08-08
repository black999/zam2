<!DOCTYPE html>
<html>
<head>
<head>
	<?php 
    	require APP_DIR . "/inc/naglowek.inc.php";
  	?>
	<title>Akceptacja zamowien</title>
</head>
<body>
<div class="dialog dialog-sm">
	<button id="zamknij">zamknij</button>
	<p id='p2'></p>
	<form id="dodaj-msg" method="post" action="<?= SITEROOT ?>/ajax/zamowienia/komentarz.php" >
		<input class="long" data-idzam="" id="input1" type="text" name="komentarz">
		<input type="submit" value="dodaj"></button>
	</form>
</div>
<div class="tytul"><?= $tytul ?></div>
<div>
	<table class="lista">
		<thead>
			<tr>
				<th>data</th>
				<th>zamawiający</th>
				<th>towar</th>
				<th>ilość</th>
				<th>cena zakupu</th>
				<th>wartość </th>
				<th>koszty dodatkowe</th>
				<th>data realizacji</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($zamowienia as $zamowienie) : ?> 
				<tr data-idzam='<?= $zamowienie['id'] ?>'>
					<td><?= $zamowienie['dataZam'] ?></td>
					<td><?= $zamowienie['imie'] . ' ' . $zamowienie['nazwisko'] ?></td>
					<td><?= $zamowienie['nazwa'] ?></td>
					<td class="center"><?= $zamowienie['ilosc'] ?></td>
					<td class="money"><?= $zamowienie['cenaZak'] ?> zł</td>
					<td class="money"><?= $zamowienie['cenaZak'] * $zamowienie['ilosc'] ?> zł</td>
					<td class="money"><?= $zamowienie['kosztCena'] ?> zł</td>
					<td><?= $zamowienie['dataReal'] ?></td>
				</tr>
			<?php endforeach; ?>					
		</tbody>
	</table>	
</div>
<script type="text/javascript">
	<?php
		include APP_DIR . "/jquery/zamowienia/dodaj.js";
	?>
</script>
</body>
</html>