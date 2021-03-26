<h2><?= $title ?></h2>
<?php foreach ($totalsRecords as $scoutRecord): ?>
  <div class="grid four-col">
    <div><?=$scoutRecord['ID']?></div>
    <div><?=$scoutRecord['Scout']?></div>
    <div><?=$scoutRecord['Total']?></div>
    <div><?=$scoutRecord['Orders']?></div>
</div>
<?php endforeach; ?>