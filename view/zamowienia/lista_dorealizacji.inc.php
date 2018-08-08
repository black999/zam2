<form method="POST">
	<input type="hidden" name="id" value="<?= $zamowienie['id'] ?>">
	<td><?= $zamowienie['dataZam'] ?></td>
	<td><?= $zamowienie['imie'] . ' ' . $zamowienie['nazwisko'] ?></td>
	<td><?= $zamowienie['nazwa'] ?></td>
	<td class="center"><?= $zamowienie['ilosc'] ?></td>
	<td class="money"><?= $zamowienie['cenaZak'] ?> zł</td>
	<td class="money"><?= $zamowienie['cenaZak'] * $zamowienie['ilosc'] ?> zł</td>
	<td class="money"><?= $zamowienie['kosztCena'] ?> zł</td>
	<td><input class="short" type="" name=""></td>
	<td><button class="btn-success" type="submit" name="">realizuj</td>
</form>

