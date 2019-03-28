<h2>Total Orders<?= ': ' .$total ?></h2>

<?php foreach ($orders as $orderId => $order): ?>
	
	<div class="across">
		<h5 class="item">
		<?= 'Order# ' . $orderId; ?>
		</h5>
		<h5 class="item">
			<?= $order[0]['scoutLast'] . ', ' .
			    $order[0]['scoutFirst'] ?>
		</h5>
		<h5 class="item">	    
			<?= $order[0]['custLast'] . ', ' . 
				$order[0]['custFirst'] ?>
		</h5>		
	</div>
	<div class="across">
		<h5 class="item">
			<?= 'Total $'. $order[0]['total'] ?>
		</h5>
	</div>
	<div class="across">
		<h5 class="item">
			<?= 'Paid: $'. $order[0]['amount'] ?>
		</h5>
		<h5 class="item">
			<?= 'Cash/Check: '. $order[0]['paytype'] ?>
		</h5>
	</div>

	<?php foreach ($order as $key => $value): ?>
		<div class="flower container">
			<div class="qty"><?= $value['qty'] ?></div>
			<div class="fname"><?= $value['fname'] ?></div>
			<div><?= $value['fvariety'] ?></div>
			<div><?= $value['fcontainer'] ?></div>
		</div>
	<?php endforeach; ?>
	<div class="flowers">
		<a class="btn" href="editOrder.php?id=<?=$orderId?>">edit</a>

		<form class="flowers" action="deleteOrder.php" method="post">
			<input type="hidden" name="oid" value=<?= $orderId ?>>
			<input class="btn" type="submit" value="delete">
		</form>	
	</div>	
<?php endforeach; ?>