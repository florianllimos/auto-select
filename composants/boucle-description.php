<div class="container-repa-about">

  <?php

    $sql = "SELECT * FROM reparation ORDER BY 'id' DESC";
    $requete = $db->query($sql);
    $reparations = $requete->fetchAll();

    foreach($reparations as $reparation):

  ?>

  <div class="bloc-repa-about">
    <h3 class="title-repa-about"><?= $reparation["title"] ?></h3>
    <p><?= $reparation["content"] ?></p>
  </div>

  <?php

    endforeach;

  ?>
  
</div>