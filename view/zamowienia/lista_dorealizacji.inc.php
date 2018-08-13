<form method="POST">
	<input type="hidden" name="id" value="<?= $zamowienie['id'] ?>">
	<input type="hidden" name="ilosc" value="<?= $zamowienie['ilosc'] ?>">
	<input type="hidden" name="iloscZreal" value="<?= $zamowienie['iloscZreal'] ?>">
	<td><?= $zamowienie['dataZam'] ?></td>
	<td><?= $zamowienie['imie'] . ' ' . $zamowienie['nazwisko'] ?></td>
	<td><?= $zamowienie['nazwa'] ?></td>
	<td class="center"><?= $zamowienie['ilosc'] ?></td>
	<td class="center"><?= $zamowienie['iloscZreal'] ?></td>
	<td class="money"><?= $zamowienie['cenaZak'] ?> zł</td>
	<td class="money"><?= $zamowienie['cenaZak'] * $zamowienie['ilosc'] ?> zł</td>
	<td class="money"><?= $zamowienie['kosztCena'] ?> zł</td>
	<?php if (($_SESSION[APP_NAME]['upr']  & ZAM_PUB) > 0) : ?>
		<td><input class="short" name="iloscZak" type="number" value="<?= $zamowienie['ilosc'] - $zamowienie['iloscZreal'] ?>" 
			min="1" max="<?= $zamowienie['ilosc'] - $zamowienie['iloscZreal'] ?>"></td>
		<td><button class="btn-success" type="submit" name="">realizuj</td>
	<?php endif ?>
</form>

