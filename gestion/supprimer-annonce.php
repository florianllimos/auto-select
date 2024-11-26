<?php

require_once("../composants/header-gestion.php");

require_once("../composants/background-fixed.php");

require_once("../composants/utilisateur-connecte.php");

require_once("../composants/database.php");

require_once("../composants/navigation-gestion.php");

$annonceSupprimee = false;

?>

<div class="container-vente">

  <?php

  $sql = "SELECT * FROM voitures ORDER BY id DESC";
  $requete = $db->query($sql);
  $voitures = $requete->fetchAll();

  foreach ($voitures as $voiture):

    $imageData = base64_encode($voiture['photo']);
    $imageType = 'jpeg';

  ?>

  <div class="card-vente">
    <h3 class="title-card"><?= $voiture["nom"] ?></h3>

    <?php 
    
      if (isset($voiture['photo']) && !empty($voiture['photo'])): 
      
    ?>

      <img src="data:image/<?= $imageType ?>;base64,<?= $imageData ?>" alt="Image" class="car-img">

    <?php 
  
      endif; 
      
    ?>

    <hr class="separator">
    <p class="caracteristiques">Caractéristiques</p>
    <hr class="separator">
    <ul class="ul-vente">
      <li>Nom du véhicule : <?= $voiture["nom"] ?></li>
      <li>Kilométrage : <?= $voiture["kilometrage"] ?></li>
      <li>Année : <?= $voiture["annee"] ?></li>
      <li>Transmission : <?= $voiture["transmission"] ?></li>
      <li>Cylindrée : <?= $voiture["cylindre"] ?></li>
      <li>Chevaux : <?= $voiture["chevaux"] ?></li>
      <li>Prix : <?= $voiture["prix"] ?></li>
    </ul>

    <form method="POST">
      <button type="submit" name="delete" class="delete" value="<?= $voiture["id"] ?>">Supprimer l'annonce</button>
      <?php 

        if (isset($_POST["delete"])) {

          $idToDelete = $_POST["delete"];
      
          $deletesql = "DELETE FROM voitures WHERE id = :id";
          $stmt = $db->prepare($deletesql);
          $stmt->bindParam(':id', $idToDelete, PDO::PARAM_INT);
      
          if ($stmt->execute()) {

              $annonceSupprimee = true;
              echo "<h2 class='success'>Annonce supprimé !</h2>";

          } else {
      
            echo "<h2 class='error'>Erreur lors de la suppression de l'annonce !</h2>";
      
          }
        }

      ?>
      
    </form>
  </div>

  <?php endforeach; ?>

  <?php if ($annonceSupprimee): ?>

  <?php endif; ?>

</div>
