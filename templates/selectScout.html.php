<h2><?= $title ?></h2>
<form class="h-half" method="post" action="">
  <div class="flex flex-col space-around h-third">
    <label for="scout" class="font-semi">Choose a Scout</label>
    <select id="scout" name="scoutid">
      <?php foreach($scouts as $scout): ?>
        <option class="" value=<?=$scout['scoutid']?>>
          <?= $scout['lastname'].', '.$scout['firstname'] ?>
        </option>
      <?php endforeach; ?>
    </select>
  </div>
  <input class="btn" type="submit" value="Submit">
</form>