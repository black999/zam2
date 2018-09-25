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
		<button type="submit" name="submit">prześlij plik</button>
	</form>
</div>

</body>
</html>