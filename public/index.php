<?php
include "../src/Loucherbem.php";
$loucherbem = new Loucherbem();
$loucherbem->execute();
?>
<html>
<body>
<h1>Bienvenue sur le Traducteur de mots en Louchébem !!!</h1>
<hr/>

<h3>CONSEIL : si votre mot commence par une voyelle il est préférable de choisir la terminaison "me" ou "ji"</h3>
<hr/>

<form method="post">

  <div>
    <label for="word">Quel est le mot à traduire ?</label>
    <input type="text" name="word" id="word" value="<?php echo $loucherbem->getRequest()->get('word') ?>">
    <div><?php echo $loucherbem->getErrorByFieldname("word") ?></div>
  </div>

  <div>
    <label for="terminaison-select">Choisissez une terminaison:</label>
    <select name="terminaison" id="terminaison-select">
      <option value="">--veuillez choisir--</option>
      <?php foreach ($loucherbem->getTerminaisons() as $key => $terminaison) : ?>
        <option <?php echo ($loucherbem->getRequest()->get('terminaison') === $key) ? "selected" : "" ?> value="<?php echo $key ?>"><?php echo $terminaison ?></option>
      <?php endforeach;?>
    </select>
    <div><?php echo $loucherbem->getErrorByFieldname("terminaison") ?></div>
  </div>

  <button type="submit">Envoyer</button>
</form>


<div>
  <?php echo $loucherbem->viewTransformWords() ?>
</div>


</body>
</html

