<!-- <div class="scout-orders flex flex-col"> -->
<div class="scout-orders">
  <h2 class="flex space-between scout-orders">
    <?= $title ?>
    <a href=<?='exportFile.php?report=scoutOrders&scoutId='.$selectedScout ?>> download </a>
  </h2>
  <form method="GET" action="">
      <select id="scout" name="scoutid" onchange="this.form.submit()">
        <?php foreach($scouts as $scout): ?>
          <option value=<?=$scout['scoutid']?>
            <?php if($scout['scoutid'] == $selectedScout) : ?>
              selected
            <?php endif; ?> >
            <?= $scout['lastname'].', '.$scout['firstname'] ?>
          </option>
        <?php endforeach; ?>
      </select>
  </form>

<h2><?= 'Total Orders: '.$count ?></h2>
	<?php foreach ($orders as $customer => $order): ?>
    <br />
    <h4><?= $customer ?><h4>
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