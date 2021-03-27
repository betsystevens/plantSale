<h2><?= $title ?></h2>
<?php foreach ($totalsRecords as $scoutRecord): ?>
  <div class="grid five-col">
    <div class="right"><?=$scoutRecord['ID']?></div>
    <div></div>
    <div><?=$scoutRecord['Scout']?></div>
    <div class="right"><?='$'.$scoutRecord['Total']?></div>
    <div class="right"><?=$scoutRecord['Orders']?></div>
</div>
<?php endforeach; ?>