<h2><?= $title ?></h2>
<h4>
  <?= $scout['lastname'] . ', ' .
      $scout['firstname'] ?>
</h4>
	<?php foreach ($orders as $customer => $order): ?>
    <h4><?= $customer ?><h4>
    <?php foreach ($order as $item): ?>
	  	<div class="grid five-col">
        <div class="qty"><?= $item['qty'] ?></div>
        <div class="fname"><?= $item['flower'] ?></div>
        <div><?= $item['variety'] ?></div>
        <div><?= $item['container'] ?></div>
		  </div>
	  <?php endforeach; ?>
	<?php endforeach; ?>