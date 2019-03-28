<!-- editCustomer.php -->
<?php 
	$custid = htmlspecialchars($customer['custID'], ENT_QUOTES, 'UTF-8');
	$lastname = htmlspecialchars($customer['lastname'], ENT_QUOTES, 'UTF-8');
	$firstname = htmlspecialchars($customer['firstname'], ENT_QUOTES, 'UTF-8');
	$email = htmlspecialchars($customer['email'], ENT_QUOTES, 'UTF-8');
	$address = htmlspecialchars($customer['address'], ENT_QUOTES, 'UTF-8');
	$telno = htmlspecialchars($customer['telno'], ENT_QUOTES, 'UTF-8');

?>	
<form accept="" method="post">
	<fieldset>
		<legend>Edit Customer</legend>
		<p>
			<label for="custid">Customer Id</label>
			<input type="text" name="id" size="4"
					value="<?=$custid?>" readonly>
		</p>
		<p>
			<label for="lastname">Last name</label>
			<input type="text" name="lastname"
					value="<?=$lastname?>" size="40">
		</p>
		<p>
			<label for="firstname">First Name</label>
			<input type="text" name="firstname"
					value="<?=$firstname?>" size="40">
		</p>
		<p>
			<label for="email">Email</label>
			<input type="text" name="email"
					value="<?=$email?>" size=60>
		</p>
		<p>
			<label for="address">Address</label>
			<input type="text" name="address"
					value="<?=$address?>" size="60">
		</p>
		<p>
			<label for="telno">Telephone</label>
			<input type="text" name="telno"
					value="<?=$telno?>" size="15">
		</p>
	</fieldset>
	<input class="btn" type="submit" name="submit" value="Submit">
	<a class="btn" href="customers.php">Cancel</a>
</form>