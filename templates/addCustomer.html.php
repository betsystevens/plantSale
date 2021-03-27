<h2><?= $title ?></h2>
<form action="" method="post">
		<p>
			<label for="lastname">Last Name:</label>
			<input type="text" name="lastname" autofocus="autofocus"
							size="40" required>
		</p>
		<p>
			<label for="firstname">First Name:</label>
			<input type="text" name="firstname" size="40">
		</p>
		<p>
			<label for="address">Address:</label>
			<input type="text" name="address" size="60">
		</p>
		<p>
			<label for="email">Email:</label>
			<input type="email" name="email" size="60">
		</p>
		<p>
			<label for="telno">Telephone Number:</label>
			<input class="med" type="text" name="telno" >
		</p>
	<input class="btn" type="submit" name="submit" value="Submit">
	<a class="btn" href="customers.php">Cancel</a>
</form>