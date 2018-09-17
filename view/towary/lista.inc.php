<div>
	<table id="tabela1" class="lista compact">
		<thead>
			<tr>
				<th>Nazwa</th>
				<th>Dział</th>
				<th>Cena zakupu</th>
				<th>Dostawca</th>
				<th>Biurowy</th>
				<th>Uwagi</th>
				<th>Opcje</th>
			</tr>
		</thead>
		<?php foreach ($towary as $towar) : ?>
			<tr>
				<td><?= $towar['nazwa'] ?></td>
				<td><?= $towar['dzial'] ?></td>
				<td><?= $towar['cenaZak'] ?></td>
				<td><?= $towar['dostawca'] ?></td>
				<td><?= $towar['biurowy'] ?></td>
				<td><?= $towar['uwagi'] ?></td>
				<td>
					<a href="edycja.php?id=<?= $towar['id'] ?>"><button class="btn-edit">edytuj</button></a>
				</td>
			</tr>
		<?php endforeach ?>			
	</table>
</div>