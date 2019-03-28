<h5>
	<?= 'Total $' . $orderTotal[0]['total'] ?>
</h5>
<h5>
	<?= 'Paid $' . $order['amount'] ?>
</h5>
<h5>
		<?= 'Cash/Check: ' . $order['paytype'] ?>
</h5>
<p></p>
<div class="across">
	<h5 class="item">
		<?= 'Order# ' . $orderId ?>
	</h5>
	<h5 class="item">
		<?= $scout[0]['lastname'].', '.$scout[0]['firstname'] ?>
	</h5>
	<h5 class="item">
		<?=
		$customer[0]['lastname'] . ', ' . $customer[0]['firstname'] ?>
	</h5>
</div>
</br>
</br>
<div class="one">
	<?php foreach ($orderFlowers as $key => $value): ?>
				
		<div class="flower container"> 	
			<div><?= $value['qty'] ?></div>
			<div><?= $value['fname'] ?></div>
			<div><?= $value['fvariety'] ?></div>
			<div><?= $value['fcontainer'] ?></div>
		</div>								
	
	<?php endforeach; ?>
</div>
	<div class="one">
		<a class="btn" href="addCustomer.php">Add Customer</a>
		<a class="btn" href="addOrder.php?sid=<?=$scout[0]['scoutid']?>">
				Add Another Order</a>
		<a class="btn" href="editOrder.php?id=<?=$orderId?>">Edit</a>
	</div>				
	