<!-- scouts.html.php -->
<h2>Total Scouts: <?= $total ?></h2>
<?php foreach ($scouts as $scout): ?>
	<blockquote>
		<p>
			<a class="btn" href="editScout.php?id=<?=$scout['scoutid']?>">edit</a>

			<?=htmlspecialchars($scout['firstname'], ENT_QUOTES, 'UTF-8')?>
			<?=htmlspecialchars($scout['lastname'], ENT_QUOTES, 'UTF-8')?>
			<form action="deleteScout.php" method="post">
				<input type="hidden" name="id" value=<?=$scout['scoutid']?>>
				<input class="btn" type="submit" value="delete">
			</form>
		</p>
	</blockquote>
<?php endforeach; ?>		
