<?php
	$scoutid = htmlspecialchars($scout['scoutid'], ENT_QUOTES, 'UTF-8');
	$lastname = htmlspecialchars($scout['lastname'], ENT_QUOTES, 'UTF-8');
	$firstname = htmlspecialchars($scout['firstname'], ENT_QUOTES, 'UTF-8');
?>
<form action="" method="post">
<h2>Edit Scout</h2>
		<p>
			<label for="scoutid">Scout Id</label>
			<input class="small id" type="text" name="id" size="4"
					value="<?= $scoutid ?>" readonly>
		</p>
		<p>
			<label for="lastname">Last Name</label>
			<input type="text" name="lastname" 
					value="<?= $lastname ?>" size="40">
		</p>
		<p>
			<label for="firstname">First Name</label>
			<input type="text" name="firstname"
					value="<?= $firstname ?>" size="40">
		</p>
	<input class="btn" type="submit" name="submit" value="Submit">
	<a class="btn" href="scouts.php">Cancel</a>
</form>