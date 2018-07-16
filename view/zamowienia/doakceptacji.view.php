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
				<th>opcje</th>
				<th>ki</th>
				<th>za</th>
				<th>ks</th>
				<th>pr</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($zamowienia as $zamowienie) : ?> 
				<tr data-idzam='<?= $zamowienie['id'] ?>'>
					<?php include 'lista_zamowienie.inc.php' ?>
				</tr>
				<tr class="ukr" style="display: none;">
					<td colspan="12" >
						<div style="overflow: auto;">
							<div class="szczegoly-zam">
								<p>weryfikacja - kierownik 
									<?php if ($zamowienie['akcKie'] != '0') : ?>
										<b><?= $personel[abs($zamowienie['akcKie'])]['imie'] . " ". $personel[abs($zamowienie['akcKie'])]['nazwisko'] ?></b>
									<?php endif ?>
								</p>
								<p>weryfikacja - zam. publiczne 
									<?php if ($zamowienie['akcZam'] != '0') : ?>
										<b><?= $personel[abs($zamowienie['akcZam'])]['imie'] . " ". $personel[abs($zamowienie['akcZam'])]['nazwisko'] ?></b>
									<?php endif ?>
								</p>
								<p>weryfikacja - ksiegowość 
									<?php if ($zamowienie['akcKsie'] != '0') : ?>
										<b><?= $personel[abs($zamowienie['akcKsie'])]['imie'] . " ". $personel[abs($zamowienie['akcKsie'])]['nazwisko'] ?></b>
									<?php endif ?>
								</p>
								<p>weryfikacja - prezes
									<?php if ($zamowienie['akcPre'] != '0') : ?>
										<b><?= $personel[abs($zamowienie['akcPre'])]['imie'] . " ". $personel[abs($zamowienie['akcPre'])]['nazwisko'] ?></b>
									<?php endif ?>
								</p>
							</div>
							<div class="szczegoly-zam">
								<p>data : <?= ($zamowienie['dataAkcKie'] == '0000-00-00') ? "": $zamowienie['dataAkcKie'] ?></p>
								<p>data : <?= ($zamowienie['dataAkcZam'] == '0000-00-00') ? "": $zamowienie['dataAkcZam'] ?></p>
								<p>data : <?= ($zamowienie['dataAkcKsie']== '0000-00-00') ? "": $zamowienie['dataAkcKsie']  ?></p>
								<p>data : <?= ($zamowienie['dataAkcPre'] == '0000-00-00') ? "": $zamowienie['dataAkcPre'] ?></p>
							</div>
							<?php if (getPozycja() != 'akcPra' && $zamowienie[getPozycja()] == '0')  : ?>
								<div class="szczegoly-zam weryfikacja">
									<p>zweryfikuj</p>
									<i name='yes' data-idzam='<?= $zamowienie['id'] ?>' class="fas fa-thumbs-up fa-lg" style="color: green"></i>	
									<i name='no' data-idzam='<?= $zamowienie['id'] ?>' class="fas fa-thumbs-down fa-lg" style="color: red"></i>	
								</div>
							<?php endif ?>
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