<h2><?= $title ?></h2>
<form action="" method="post">
	<p>
		<label for="lastname">Last Name</label>
		<input type="text" name="lastname" autofocus="autofocus"  
						size="40" required>
	</p> 
	<p>
		<label for="firstname">First Name</label>
		<input type="text" name="firstname" size="40">
	</p>
	<input class="btn" type="submit" name="submit" value="Submit">
	<a class="btn" href="scouts.php">Cancel</a>
</form>