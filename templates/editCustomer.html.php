<!-- editCustomer.php -->
<?php 
	$custid = htmlspecialchars($customer['custID'], ENT_QUOTES, 'UTF-8');
	$lastname = htmlspecialchars($customer['lastname'], ENT_QUOTES, 'UTF-8');
	$firstname = htmlspecialchars($customer['firstname'], ENT_QUOTES, 'UTF-8');
	$email = htmlspecialchars($customer['email'], ENT_QUOTES, 'UTF-8');
	$address = htmlspecialchars($customer['address'], ENT_QUOTES, 'UTF-8');
	$telno = htmlspecialchars($customer['telno'], ENT_QUOTES, 'UTF-8');

?>	
<form class="med" action="" method="post">
<h2>Edit Customer</h2>
		<p>
			<label for="custid">Customer Id</label>
			<input class="small id" type="text" name="id"
					value="<?=$custid?>" readonly>
		</p>
		<p>
			<label for="lastname">Last name</label>
			<input type="text" name="lastname"
					value="<?=$lastname?>">
		</p>
		<p>
			<label for="firstname">First Name</label>
			<input type="text" name="firstname"
					value="<?=$firstname?>">
		</p>
		<p>
			<label for="address">Address</label>
			<input type="text" name="address"
					value="<?=$address?>">
		</p>
		<p>
			<label for="email">Email</label>
			<input type="email" name="email"
					value="<?=$email?>">
		</p>
		<p>
			<label for="telno">Telephone</label>
			<input class="med" type="text" name="telno"
					value="<?=$telno?>">
		</p>
	<input class="btn" type="submit" name="submit" value="Submit">
	<a class="btn" href="customers.php">Cancel</a>
</form>