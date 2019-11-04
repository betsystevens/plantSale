<form id="addOrder" method="post" action="">
	<fieldset class="order">
		<legend>Add Order</legend>
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
				</td>
				</tr>
				<tr>
					<th>Check or Cash</th>
					<th>Amount</th>
				</tr>
				<tr>
					<td>
						<input class="payment" name="paytype">
					</td>
					<td>
						<input class="payment" name="amount">
					</td>
				</tr>
		</table>
		<table class="order flowers">
			<tr>
				<th>Quantity</th>
				<th>Flower</th>
				<th>Variety</th>
				<th>Container</th>
				<th></th>
			</tr>
			<tr id="row_0">
				<td>
					<input id="qty_0" name="flower[0][qty]" pattern="[0-9]{1,2}"
					title="Quantity must be less than 100" size="3" required>	
				</td>
				<td>
					<select id="fname_0" name="flower[0][fname]">
					<?php foreach($flowerNames as $fname): ?>
						<option value=<?= '"' .$fname[0]. '"'?>>
							<?= $fname[0] ?>
						</option>
					<?php endforeach; ?>
					</select>
				</td>
				<td>
					<select id="variety_0" name="flower[0][variety]">
					<?php foreach($varieties as $variety): ?>
						<option value=<?='"' .$variety[0]. '"'?>>
							<?= $variety[0] ?>
						</option>
					<?php endforeach; ?>	
					</select>
				</td>
				<td>
					<select id="container_0" name="flower[0][container]">
					<?php foreach($containers as $container): ?>
						<option value=<?= '"' .$container[0]. '"'?>>
							<?= $container[0] ?>
						</option>
					<?php endforeach; ?>	
					</select>
				</td>
				<td id="addSign">
					<input id="addBtn_0" name="addBtn_0" type="button" value="(+)">
				</td>
			</tr>
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
