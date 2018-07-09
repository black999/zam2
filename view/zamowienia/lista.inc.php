<div>
	<table class="lista">
		<thead>
			<tr>
				<th>Data</th>
				<th>Towar</th>
				<th>Ilość</th>
				<th>Cena zakupu</th>
				<th>Wartość </th>
				<th>Koszty dodatkowe</th>
				<th>Wartość</th>
				<th>Opcje</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($zamowienia as $zamowienie) : ?> 
				<tr>
					<td><?= $zamowienie['dataZam'] ?></td>
					<td><?= $zamowienie['nazwa'] ?></td>
					<td class="center"><?= $zamowienie['ilosc'] ?></td>
					<td class="money"><?= $zamowienie['cenaZak'] ?> zł</td>
					<td class="money"><?= $zamowienie['cenaZak'] * $zamowienie['ilosc'] ?> zł</td>
					<td><?= $zamowienie['kosztOpis'] ?></td>
					<td class="money"><?= $zamowienie['kosztCena'] ?> zł</td>
					<td>
						<button class="btn btn-success" value="zatwierdz" data-idzam='<?= $zamowienie['id'] ?>' >zatwierdz</button>
						<button class="btn btn-danger" value="usun" data-idzam='<?= $zamowienie['id'] ?>' >usuń</button>
						<a href="edycja.php?id=<?= $zamowienie['id'] ?>"><button class="btn-edit">edytuj</button></a>
						<button class="btn" value="komentarz" data-idzam='<?= $zamowienie['id'] ?>' >komentarz</button>
					</td>
				</tr>
			<?php endforeach; ?>					
		</tbody>
	</table>	
</div>
