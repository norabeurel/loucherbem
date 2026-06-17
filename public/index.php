<?php
include "../src/Louchebem.php";
$louchebem = new Louchebem();
$louchebem->execute();
?>
<html lang="fr" xmlns="http://www.w3.org/1999/html">
<head>
  <title>Traducteur de mots en louchebem</title>
  <link href="style.css" rel="stylesheet">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Coiny&display=swap" rel="stylesheet">
</head>

<body>
<header class="header"><h1 class="title">Traducteur de mots en louchebem</h1></header>

<div>
  <h3>CONSEIL : si votre mot commence par une voyelle, il est préférable de choisir la terminaison "me" ou "ji"</h3>
  <hr/>
<div class="form-container">
    <form method="post">

      <div class="word-input">
        <label for="word" class="label">Quel est le mot à traduire ?</label>
        <input class="input" type="text" name="word" id="word" value="<?php echo $louchebem->getRequest()->getValueByFieldname('word') ?>">
        <div class="missingValue"><?php echo $louchebem->getErrorByFieldname("word") ?></div>
      </div>

      <div class="terminaison-input">
        <label for="terminaison-select" class="label">Choisissez une terminaison:</label>
        <select class="select" name="terminaison" id="terminaison-select">
          <option value="">--veuillez choisir--</option>
          <?php foreach ($louchebem->getTerminaisons() as $key => $terminaison) : ?>
            <option <?php echo ($louchebem->getRequest()->getValueByFieldname('terminaison') === $key) ? "selected" : "" ?> value="<?php echo $key ?>"><?php echo $terminaison ?></option>
          <?php endforeach;?>
        </select>
        <div class="missingValue"><?php echo $louchebem->getErrorByFieldname("terminaison") ?></div>
      </div>
    <button class="send-button" type="submit">Envoyer</button>
      <div class="response">
        <?php echo $louchebem->viewTransformWords() ?>
      </div>
</div>



<footer class="footer">
  <p>Created by Nora</p>
  <p> Find the code on <a href="">Github</a></p>
  <p>(date)</p>
</footer>
</body>
</html>

