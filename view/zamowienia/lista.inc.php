<div>
	<table class="lista">
		<thead>
			<tr>
				<th>Data</th>
				<th>Towar</th>
				<th>Ilość</th>
				<th>Cena zakupu</th>
				<th>Wartość </th>
				<th>Koszt Opis</th>
				<th>Koszt realizacji</th>
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
						<button class="btn btn-success" value="zatwierdz" data-id='<?= $zamowienie['id'] ?>' >zatwierdz</button>
						<button class="btn btn-danger" value="usun" data-id='<?= $zamowienie['id'] ?>' >usuń</button>
						<!-- <button class="btn" value="edycja" data-id='<?= $zamowienie['id'] ?>' >edycja</button> -->
						<!-- <a href="edycja.php?id=<?= $zamowienie['id'] ?>" class="button btn btn-success">Edycja</a> -->
						<a href="edycja.php?id=<?= $zamowienie['id'] ?>"><button class="btn-edit">edytuj</button></a>
						<button class="btn" value="komentarz" data-id='<?= $zamowienie['id'] ?>' >komentarz</button>
					</td>
				</tr>
			<?php endforeach; ?>					
		</tbody>
	</table>	
</div>
