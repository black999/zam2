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
	<form id="dodaj-msg" method="POST" action="<?= SITEROOT ?>/ajax/zamowienia/komentarz.php" >
		<input class="long" data-idzam="" id="input1" type="text" name="komentarz">
		<input type="submit" value="dodaj"></button>
	</form>
</div>
<div class="tytul">Zamówienia do akceptacji</div>
<div id="zawartosc" style="display: none;">
	Zamowienie z dnia <span></span>
	<p name='towar'></p>
</div>
<div>
	<table class="lista">
		<thead>
			<tr>
				<th>Data</th>
				<th>Zamawiający</th>
				<th>Towar</th>
				<th>Ilość</th>
				<th>Cena zakupu</th>
				<th>Wartość </th>
				<th>Koszty dodatkowe</th>
				<th>Opcje</th>
				<th>Ki</th>
				<th>Za</th>
				<th>Ks</th>
				<th>Pr</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($zamowienia as $zamowienie) : ?> 
				<tr>
					<td><?= $zamowienie['dataZam'] ?></td>
					<td><?= $zamowienie['dataZam'] ?></td>
					<td><?= $zamowienie['nazwa'] ?></td>
					<td class="center"><?= $zamowienie['ilosc'] ?></td>
					<td class="money"><?= $zamowienie['cenaZak'] ?> zł</td>
					<td class="money"><?= $zamowienie['cenaZak'] * $zamowienie['ilosc'] ?> zł</td>
					<td class="money"><?= $zamowienie['kosztCena'] ?> zł</td>
					<td>
						<button class="btn" value="komentarz" data-idzam='<?= $zamowienie['id'] ?>' >komentarz</button>
						<button class="btn" value="pokaz" data-idzam='<?= $zamowienie['id'] ?>' >pokaż</button>
					</td>
					<td>
						<?php if ($zamowienie['akcKie'] > 0) : ?>
							<i class="fas fa-thumbs-up fa-lg" style="color: green"></i>
						<?php elseif ($zamowienie['akcKie'] < 0) : ?>						
							<i class="fas fa-thumbs-down fa-lg" style="color: red"></i>
						<?php endif ?>
					</td>
				</tr>
				<tr class="ukr" style="display: none;">
					<td colspan="8" >
						<div style="overflow: auto;">
							<div class="szczegoly-zam">
								<p>Weryfikacja - Kierownik <?= $zamowienie['akcKie'] ?></p>
								<p>Weryfikacja - Zam. publiczne <?= $zamowienie['akcZam'] ?></p>
								<p>Weryfikacja - Księgowość <?= $zamowienie['akcKsie'] ?></p>
								<p>Akceptajca  - Prezes <?= $zamowienie['akcPre'] ?></p>
							</div>
							<div class="szczegoly-zam">
								<p>Data : <?= $zamowienie['dataAkcKie'] ?></p>
								<p>Data : <?= $zamowienie['dataAkcZam'] ?></p>
								<p>Data : <?= $zamowienie['dataAkcKsie'] ?></p>
								<p>Data : <?= $zamowienie['dataAkcPre'] ?></p>
							</div>
							<div class="szczegoly-zam">
								<p>Zweryfikuj</p>
								<i name='yes' data-idzam='<?= $zamowienie['id'] ?>' class="fas fa-thumbs-up fa-lg" style="color: green"></i>	
								<i name='no' data-idzam='<?= $zamowienie['id'] ?>' class="fas fa-thumbs-down fa-lg" style="color: red"></i>	
							</div>
						</div>
					</td>
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