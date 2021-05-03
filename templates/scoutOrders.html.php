<div class="scout-orders">
  <?php require __DIR__ . '/selectScoutGroupBy.html.php'; ?>
  <h2><?= 'Total Orders: '.$count ?></h2>
  
	<?php foreach ($orders as $customer => $order): ?>
    <br />
    <h2><?= $customer ?></h2>

    <div class="customer-info">
      <p><?= $order[0]['address'] ?></p>
      <?php if(empty($order[0]['telno'])): ?>
        <p><?= $order[0]['email'] ?></p>
      <?php elseif( empty($order[0]['email'])  ): ?>
        <p><?= $order[0]['telno'] ?></p>
      <?php else: ?>
        <p><?= $order[0]['telno']. ' / ' . $order[0]['email']?></p>
      <?php endif; ?>
    </div>

    <?php foreach ($order as $item): ?>
	  	<div class="grid">
        <div class="qty"><?= $item['qty'] ?></div>
        <div class="fname"><?= $item['flower'] ?></div>
        <div><?= $item['variety'] ?></div>
        <div><?= $item['container'] ?></div>
		  </div>
	  <?php endforeach; ?>
	<?php endforeach; ?>
</div>