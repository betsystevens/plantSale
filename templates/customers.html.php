<h2>Total Customers: <?= $total ?></h2>
<?php foreach ($customers as $customer): ?>
		<div class="custOuter">
			<div class="custInner">
				<div>
					<a class="btn" 
						href="editCustomer.php?id=<?=$customer['custID']?>">edit</a>
					</div>
				<div class="innerFields">	
					<?=prepOutput($customer['lastname']) . ", "?>
					<?=prepOutput($customer['firstname'])?>
					<?=prepOutput($customer['address'], '/ ')?>
					<?=prepOutput($customer['telno'], '/ ')?>
					<?=prepOutput($customer['email'], '/ ')?>
				</div>
				<div>
					<form action="deleteCustomer.php" method="post">
						<input type="hidden" name="id" value=<?=$customer['custID']?>>
						<input class="btn" type="submit" value="delete">
					</form>
			</div>
		</div>	
<?php endforeach; ?>