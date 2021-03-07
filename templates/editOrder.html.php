 	<form id="editOrder" method="post" action="">
 	<h2>Edit Order# <?= $orderId ?> </h2>
		<table class="order">
			<tr>
				<th>Scout</th>
				<th>Customer</th>	
			</tr>
			<tr>
	 			<td>
				 <div class="select">
					<select id="scout" name="scout" autofocus="autofocus" required>
						<?php foreach($scouts as $scout): ?>
							<option value=<?=$scout[0]?>
								<?php if($scout[0] == $scoutId) : ?>
									selected
								<?php endif; ?> >
								<?= $scout[1] . ', ' . $scout[2] ?>
							</option>
						<?php endforeach; ?>
					</select>
					</div>
	 			</td>
				<td>
					<div class="select">
						<select id="customer" name="customer" required>
							<?php foreach($customers as $customer): ?>
								<option value=<?=$customer[0]?>
									<?php if($customer[0] == $custId) : ?>
										selected
									<?php endif; ?> >
									<?= $customer[1] . ', ' . $customer[2] ?>
								</option>
							<?php endforeach; ?>
						</select>
					</div>
				</td>
			</tr>
			<tr>
				<th>Check or Cash</th>
				<th>Paid</th>
				<th>Total</th>
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
				<td>
					<div class="display med"><?= $orderTotal[0]['total'] ?></div>
					<!-- <input class="payment" name="foo" readonly -->
								<!-- value="<?= $orderTotal[0]['total'] ?>"> -->
				</td>	
				<td>
				<input type="hidden" name="oid" value=<?= $orderId ?>>
				</td>
			</tr>
		<table class="order flowers">
			<tr>
				<th>Quantity</th>
				<th>Flower</th>
				<th>Variety</th>
				<th>Container</th>
				<th></th>
			</tr>
		
			<?php foreach ($orderFlowers as $key => $value): ?>

				<tr id=<?= '"row_'.$key.'"' ?>>
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
					<td>
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
</form>	