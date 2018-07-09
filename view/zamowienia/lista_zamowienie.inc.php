<td><?= $zamowienie['dataZam'] ?></td>
<td><?= $zamowienie['imie'] . ' ' . $zamowienie['nazwisko'] ?></td>
<td><?= $zamowienie['nazwa'] ?></td>
<td class="center"><?= $zamowienie['ilosc'] ?></td>
<td class="money"><?= $zamowienie['cenaZak'] ?> zł</td>
<td class="money"><?= $zamowienie['cenaZak'] * $zamowienie['ilosc'] ?> zł</td>
<td class="money"><?= $zamowienie['kosztCena'] ?> zł</td>
<td>
	<button class="btn" value="komentarz" data-idzam='<?= $zamowienie['id'] ?>' >komentarz</button>
	<button class="btn" value="pokaz" data-idzam='<?= $zamowienie['id'] ?>' >pokaż</button>
</td>
<?php foreach ($akc as $value) : ?> 
	<td class="center">
		<?php if ($zamowienie[$value] > 0) : ?>
			<i class="fas fa-thumbs-up fa-lg" style="color: green"></i>
		<?php elseif ($zamowienie[$value] < 0) : ?>						
			<i class="fas fa-thumbs-down fa-lg" style="color: red"></i>
		<?php endif ?>
	</td>
<?php endforeach ?>
