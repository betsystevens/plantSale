<h2>Total Orders<?= ': ' .$total ?></h2>
<?php foreach ($orders as $orderId => $order): ?>
	<div class="grid three-col">
		<h4>
			<?= $order[0]['scoutLast'] . ', ' .
			    $order[0]['scoutFirst'] ?>
		</h4>
		<h4>	    
			<?= $order[0]['custLast'] . ', ' . 
				$order[0]['custFirst'] ?>
		</h4>		
		<h4>
			<?= 'Order# ' . $orderId; ?>
		</h4>
		<div>
		  <span class="bold size-15">Cash/Check:</span> 
		  <span class="size-15"><?= $order[0]['paytype'] ?></span> 
		</div>
		<div>
		  <span class="bold size-15">Paid </span> 
		  <span class="size-15 <?=$order[0]['alert']?>"><?= '$'.$order[0]['amount'] ?></span> 
		</div>
		<div>
		  <span class="bold size-15">Total </span> 
			<span class="size-15"><?= '$'.$order[0]['total'] ?></span>
		</div>
	</div>

	<?php foreach ($order as $key => $value): ?>
		<div class="grid four-col">
			<div class="qty"><?= $value['qty'] ?></div>
			<div class="fname"><?= $value['fname'] ?></div>
			<div><?= $value['fvariety'] ?></div>
			<div><?= $value['fcontainer'] ?></div>
		</div>
	<?php endforeach; ?>
		<form class="flowers" action="deleteOrder.php" method="post">
			<a class="btn" href="editOrder.php?id=<?=$orderId?>">edit</a>
			<input type="hidden" name="oid" value=<?= $orderId ?>>
			<input class="btn" type="submit" value="delete">
		</form>	
	<?php endforeach; ?>