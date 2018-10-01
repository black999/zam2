<!DOCTYPE html>
<html>
<head>
	<?php 
    	require APP_DIR . "/inc/naglowek.inc.php";
  	?>	
	<title>Dodawanie/Lista faktury</title>
</head>
<body>
<div class="tytul">Nowa faktura</div>
<div>
	<form method="POST" enctype="multipart/form-data">
	   	<input type="hidden" name="MAX_FILE_SIZE" value="300000" >
		<label>Wybierz fakturę do przesłania</label>
		<input type="file" name="fileToUpload" accept="application/pdf">
		<label>Opis faktury</label>
		<input type="text" name="opis" required>
		<button type="submit" name="submit">prześlij plik</button>
	</form>
</div>
<div class="dialog dialog-lg">
	<button id="zamknij">Zamknij</button>
	<embed src="" width="100%" height="500">
</div>
<div>
	<table id="tabela1" class="lista compact">
		<thead>
			<tr>
				<th>data</th>
				<th>opis</th>
				<th>dodana przez</th>
				<th>opcje</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($faktury as $faktura) : ?> 
				<tr>
					<td><?= $faktura['data'] ?></td>
					<td><?= $faktura['opis'] ?></td>
					<td><?= $faktura['imie'] . " " . $faktura['nazwisko'] ?></td>
					<td>
						<button class="pokaz" data-sciezka="<?= $faktura['sciezka'] ?>" >pokaż</button>
					</td>
				</tr>
			<?php endforeach; ?>					
		</tbody>
	</table>	
</div>
<script type="text/javascript">
	<?php
		require APP_DIR . "/jquery/dataTable.inc.js";
		require APP_DIR . "/jquery/faktury/dodaj.js";
	?>
</script>
</body>
</html>