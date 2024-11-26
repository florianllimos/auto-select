<div class="container-reparation">

  <?php

    require_once("composants/database.php");

    $sqlBandeau = "SELECT * FROM bandeau_reparation";
    $requeteBandeau = $db->query($sqlBandeau);
    $listeBandeau = $requeteBandeau->fetchAll();

    foreach($listeBandeau as $bandeaux):

      $imageData = base64_encode($bandeaux["image"]);
      $imageType = 'png';

    ?>

    <div class="bloc-reparation">
      <h3 class="title-reparation"><?= $bandeaux["nom"] ?></h3>

      <?php

        echo "<img src='data:image/" . $imageType . ';base64,' . $imageData . "' alt='Image' class='img-reparation''";

      ?>

    </div>
  </div>

  <?php

    endforeach;

  ?>

</div>    

