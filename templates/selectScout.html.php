<form method="post" action="">
  <h2><?= $title ?></h2>
  <div class="select container">
    <label for="scout">Choose a Scout</label>
    <select id="scout" name="scoutid">
      <?php foreach($scouts as $scout): ?>
        <option value=<?=$scout['scoutid']?>>
          <?= $scout['lastname'].', '.$scout['firstname'] ?>
        </option>
      <?php endforeach; ?>
    </select>
  </div>
  <input class="btn" type="submit" value="Submit">
</form>