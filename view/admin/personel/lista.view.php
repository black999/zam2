<!DOCTYPE html>
<html>
<head>
	<?php 
    	require APP_DIR . "/inc/naglowek.inc.php";
  	?>	
	<title>Lista personelu</title>
</head>
<body>
<div class="tytul">Lista personelu</div>
<div>
	<form action="#" method="POST">
		<input type="hidden" name="id" value="<?= $pracownik['id'] ?>">
		<table>
			<tr>
				<td>
					<label>Imię</label>
				</td>
				<td>
					<input class="long" type="text" name="imie" max="50" maxlength=50 value="<?= $pracownik['imie'] ?>" required>
				</td>
			</tr>
			<tr>
				<td>
					<label>Nazwisko</label>
				</td>
				<td>
					<input class="long" type="text" name="nazwisko" max="50" maxlength=50 value="<?= $pracownik['nazwisko'] ?>" required>
				</td>
			</tr>
			<tr>
				<td>
					<label>email</label>
				</td>
				<td>
					<input class="long" type="text" name="email" max="50" maxlength=50 value="<?= $pracownik['email'] ?>">
				</td>
			</tr>
			<tr>
				<td>
					<label>Login</label>
				</td>
				<td>
					<input class="long" type="text" name="login" max="50" maxlength=50 value="<?= $pracownik['login'] ?>" required >
				</td>
			</tr>
			<tr>
				<td>
					<label>Hasło</label>
				</td>
				<td>
					<input class="long" type="password" name="haslo" max="50" maxlength=50 <?php if($pracownik['id'] == '0') echo "required" ?> >
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
							<option value="<?= $dzial['id'] ?>" 
								<?php if($dzial['id'] == $pracownik['idDzial']) echo "selected" ; ?> > 
								<?= $dzial['nazwa'] ?>
							</option>
						<?php endforeach ?>
					</select><br>
				</td>
			</tr>
			<tr>
				<td>
					<input type="checkbox" name="uPrac" value="1" <?php if($pracownik['uPrac'] == '1') echo "checked" ?> >
				</td>
				<td>
					<label>pracownik</label>
				</td>
			</tr>
			<tr>
				<td>
					<input type="checkbox" name="uKier" value="1" <?php if($pracownik['uKier'] == '1') echo "checked" ?> >
				</td>
				<td>
					<label>kierownik</label>
				</td>
			</tr>
			<tr>
				<td>
					<input type="checkbox" name="uKsieg" value="1" <?php if($pracownik['uKsieg'] == '1') echo "checked" ?> >
				</td>
				<td>
					<label>księgowosc</label>
				</td>
			</tr>
			<tr>
				<td>
					<input type="checkbox" name="uZampub" value="1" <?php if($pracownik['uZampub'] == '1') echo "checked" ?> >
				</td>
				<td>
					<label>zamówienia publiczne</label>
				</td>
			</tr>
			<tr>
				<td>
					<input type="checkbox" name="uPrez" value="1" <?php if($pracownik['uPrez'] == '1') echo "checked" ?> >
				</td>
				<td>
					<label>prezes</label>
				</td>
			</tr>
			<tr>
				<td>
					<input type="checkbox" name="uAdmin" value="1" <?php if($pracownik['uAdmin'] == '1') echo "checked" ?> >
				</td>
				<td>
					<label>admin</label>
				</td>
			</tr>
			<tr>
				<td>
					<input type="checkbox" name="realBiuro" value="1" <?php if($pracownik['realBiuro'] == '1') echo "checked" ?> >
				</td>
				<td>
					<label>realizacja zamówień biurowych</label>
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

<div>
	<table id="tabela1" class="lista compact">
		<thead>
			<tr>
				<th>Imię</th>
				<th>Nazwisko</th>
				<th>e-mail</th>
				<th>Login</th>
				<th>Real. biurowych</th>
				<th>Opcje</th>
			</tr>
		</thead>
		<?php foreach ($personel as $osoba) : ?>
			<tr>
				<td><?= $osoba['imie'] ?></td>
				<td><?= $osoba['nazwisko'] ?></td>
				<td><?= $osoba['email'] ?></td>
				<td><?= $osoba['login'] ?></td>
				<td class="center"><?= $osoba['realBiuro'] ?></td>
				<td>
					<a href="lista.php?id=<?= $osoba['id'] ?>"><button class="btn-edit">edytuj</button></a>
				</td>
			</tr>
		<?php endforeach ?>			
	</table>
</div>
<script type="text/javascript">
	<?php
		include APP_DIR . "/jquery/dataTable.inc.js";
	?>
</script>
</body>
</html>