  <h2 class="flex space-between scout-orders">
    <?= $title ?>
    <a href=<?='exportFile.php?report=scoutOrders&scoutId='.$selectedScout.'&groupBy='.$groupBy ?>> download </a>
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
      <select id="groupBy" name="groupBy" onchange="this.form.submit()">
        <option value=<?= "customer" ?>
          <?php if($groupBy == "customer") : ?>
            selected
          <?php endif; ?> > by customer </option>
        </option>
        <option value=<?= "flower" ?> 
          <?php if($groupBy == "flower") : ?>
            selected
          <?php endif; ?> > by flower </option>
      </select>
  </form>