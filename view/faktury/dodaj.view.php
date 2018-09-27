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
		<input type="file" name="fileToUpload">
		<label>Opis faktury</label>
		<input type="text" name="opis" required>
		<button type="submit" name="submit">prześlij plik</button>
	</form>
</div>
<div>
	<table class="lista">
		<thead>
			<tr>
				<th>data</th>
				<th>opis</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($faktury as $faktura) : ?> 
				<tr>
					<td><?= $faktura['data'] ?></td>
					<td><?= $faktura['opis'] ?></td>
				</tr>
			<?php endforeach; ?>					
		</tbody>
	</table>	
</div>

</body>
</html>