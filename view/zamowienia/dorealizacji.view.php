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
				<th>ilość zak.</th>
				<th>opcje</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($zamowienia as $zamowienie) : ?> 
				<tr data-idzam='<?= $zamowienie['id'] ?>'>
					<?php include 'lista_dorealizacji.inc.php' ?>
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