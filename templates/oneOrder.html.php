<h2>Order# <?= $orderId ?> </h2>
  <div class="grid three-col">
		<h4>
			<?= $scout[0]['lastname'].', '.$scout[0]['firstname'] ?>
		<h4>	
			<?= $customer[0]['lastname'] . ', ' . $customer[0]['firstname'] ?>
		</h4>
		<h4>
		</h4>
	 	
		<div>
			<span class="bold size-15">Cash/Check:</span>
			<span class="size-15"><?= '$' .$order['paytype'] ?>	</span>
		</div>
		<div>
			<span class="bold size-15">Paid</span>
			<span class="size-15"><?= '$' .$order['amount'] ?>	</span>
		</div>	
		<div>
			<span class="bold size-15">Total</span>
			<span class="size-15"><?= '$' .$orderTotal[0]['total'] ?></span>
		</div>		
	</div>			
				

	<?php foreach ($orderFlowers as $key => $value): ?>
		<div class="grid four-col">
			<div class="qty"><?= $value['qty'] ?></div>
			<div class="fname"><?= $value['fname'] ?></div>
			<div><?= $value['fvariety'] ?></div>
			<div><?= $value['fcontainer'] ?></div>
		</div>								
	<?php endforeach; ?>

	<!-- <div class="one"> -->
	<div class="grid three-btn"> 
	<!-- <div> -->
		<a class="btn" href="addCustomer.php">Add Customer</a>
		<a class="btn" href="addOrder.php?sid=<?=$scout[0]['scoutid']?>">
				Add Order</a>
		<a class="btn" href="editOrder.php?id=<?=$orderId?>">Edit</a>
	</div>				
	