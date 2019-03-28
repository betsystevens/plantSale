<form id="editOrder" method="post" action="">
	<fieldset class="order">
		<legend>Edit Order #<?= $orderId ?></legend>
		<h3 id="orderTotal">
			<?= "Total: $" .$orderTotal[0]['total'] ?>
		</h3>
		<table class="order">
			<tr>
				<th>Scout</th>
				<th>Customer</th>
			</tr>
			<tr>
				<td>
				<div>
					<select id="scout" name="scout" required >
						<option value=<?= $scouts[0]['scoutid'] ?> >
								<?= $scouts[0]['lastname'].', '
											.$scouts[0]['firstname'] ?>
						</option>
					</select>
				</div>
				</td>
				<td>
					<div>
						<select id="customer" name="customer" required="">
							<option value=<?= $customers[0]['custid'] ?>>
									<?= $customers[0]['lastname'].', '
												.$customers[0]['firstname'] ?>
							</option>
						</select>
					</div>
				</td>
			</tr>
			<tr>
					<th>Check or Cash</th>
					<th>Amount</th>
				</tr>
				<tr>
					<td>
						<input class="payment" name="paytype"
										value="<?=$order['paytype'] ?>">
					</td>
					<td>
						<input class="payment" name="amount"
										value="<?=$order['amount'] ?>">
					</td>
				</tr>
		</table>
		<input type="hidden" name="oid" value=<?= $orderId ?>>
		<table class="order">
			<tr>
				<th>Quantity</th>
				<th>Flower</th>
				<th>Variety</th>
				<th>Container</th>
				<th></th>
			</tr>
		
			<?php foreach ($orderFlowers as $key => $value): ?>
				<tr>
					<td> 	
						<input 	id=<?= '"qty_'.$key.'"' ?> 
										name=<?= '"flower['.$key.'][qty]"' ?>
										value=<?= '"'.$value['qty'].'"' ?>
										size="3" pattern="[0-9]{1,2}"
										title="Quantity must be less than 100">
					</td>
					<td> 	
						<select	id=<?= '"fname_'.$key.'"' ?>
										name=<?= '"flower['.$key.'][fname]"' ?> > 
						<option value=<?= '"'.$value['fname'].'"' ?> >
										<?= $value['fname'] ?>
					</td>
					<td>
						<select	id=<?= '"variety_'.$key.'"' ?> 
										name=<?= '"flower['.$key.'][variety]"' ?> >
						<option value=<?= '"'.$value['fvariety'].'"' ?> >
										<?= $value['fvariety'] ?> </option> </select>
					</td>
					<td id=<?= '"td_'.$key.'"'  ?>>
						<select	id=<?= '"container_'.$key.'"' ?> 
										name=<?= '"flower['.$key.'][container]"' ?> >
						<option	value=<?=  '"'.$value['fcontainer'].'"' ?> >
										<?= $value['fcontainer'] ?> </option> </select> 
					</td>
				</tr>
			<?php endforeach; ?>
			<tr id="submitRow">
				<td>
					<input class="btn" type="submit" value="Submit">
				</td>		
				<td>
					<a class="btn" href="orders.php">Cancel</a>
				</td>
			</tr>
		</table>
	</fieldset>
</form>	

<script type="text/javascript" defer="defer"
		src="../js/order.js">
</script>