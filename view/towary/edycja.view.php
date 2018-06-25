<!DOCTYPE html>
<html>
<head>
	<?php 
    	require APP_DIR . "/inc/naglowek.inc.php";
  	?>	
	<title>Dodawanie/Edycja towaru</title>
</head>
<body>
<div class="tytul edit">Edycja towaru</div>
<div>
	<form action="#" method="POST">
		<input type="hidden" name="id" value="<?= $towar['id'] ?>">
		<table>
			<tr>
				<td>
					<label>Nazwa</label>
				</td>
				<td>
					<input class="long" type="text" name="nazwa" max="50" maxlength=50 required value="<?= $towar['nazwa'] ?>">
				</td>
			</tr>
			<tr>
				<td>
					<label>Dział:</label> 
				</td>
				<td>
					<select name="idDzial" >
						<option value="0"></option>
						<?php foreach ($dzialy as $dzial) : ?>
							<option value="<?= $dzial['id'] ?>" <?= ($towar['idDzial'] == $dzial['id']) ? " selected" :"" ?> >
								<?= $dzial['nazwa'] ?>
							</option>
						<?php endforeach ?>
					</select><br>
				</td>
			</tr>
			<tr>
				<td>
					<label>Cena zakupu:</label>
				</td>
				<td>
					<input class="short" type="text" name="cenaZak" maxlength="8" required value="<?= $towar['cenaZak'] ?>">
				</td>
			</tr>
			<tr>
				<td>
					<label>Dostawca:</label>
				</td>
				<td>
					<input class="long" type="text" name="dostawca" maxlength="40" value="<?= $towar['dostawca'] ?>">
				</td>
			</tr>
			<tr>
				<td>
					<label>Uwagi:</label>
				</td>
				<td>
					<input type="text" name="uwagi" maxlength="40" value="<?= $towar['uwagi'] ?>">
				</td>
			</tr>
			<tr>
				<td>
					<label>Biurowy:</label>
				</td>
				<td>
					<input type="checkbox" name="biurowy" value="1" <?= ($towar['biurowy'] == '1')? "checked":"" ?>>
				</td>
			</tr>
			<tr>
				<td>
					<button type="submit" class="btn-success">Zapisz</button>
				</td>
			</tr>
		</table>
	</form>
</div>
<?php include "lista.inc.php" ?>
<script type="text/javascript">
	<?php
		include APP_DIR . "/jquery/towary/dodaj.js";
		include APP_DIR . "/jquery/dataTable.inc.js";
	?>
</script>
</body>
</html>