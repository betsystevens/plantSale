<!-- scouts.html.php -->
<h2>Total Scouts: <?= $total ?></h2>
<div class="scouts list">
	<?php foreach ($scouts as $scout): ?>
		<div>
			<a class="btn" href="editScout.php?id=<?=$scout['scoutid']?>">edit</a>
		</div>
		<div class="field">	
			<?=htmlspecialchars($scout['lastname'], ENT_QUOTES, 'UTF-8') . ", "?>
			<?=htmlspecialchars($scout['firstname'], ENT_QUOTES, 'UTF-8')?>
		</div>
		<form class="justify-end" action="deleteScout.php" method="post">
				<input type="hidden" name="id" value=<?=$scout['scoutid']?>>
				<input class="btn" type="submit" value="delete">
		</form>
	<?php endforeach; ?>		
</div>