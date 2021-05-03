<div class="scout-orders">
  <?php require __DIR__ . '/selectScoutGroupBy.html.php'; ?>
  <h2><?= 'All Flowers' ?></h2>
  <br />
  <?php foreach ($orders as $scout => $flowers): ?>
    <?php foreach ($flowers as $item): ?>
      <div class="grid">
        <div class="qty"><?= $item['qty'] ?></div>
        <div class="fname"><?= $item['flower'] ?></div>
        <div><?= $item['variety'] ?></div>
        <div><?= $item['container'] ?></div>
      </div>
	  <?php endforeach; ?>
	<?php endforeach; ?>
</div>