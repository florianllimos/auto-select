<?php

require_once("../composants/utilisateur-connecte.php");

require_once("../composants/database.php");

require_once("../composants/header-gestion.php");

require_once("../composants/background-fixed.php");

require_once("../composants/navigation-gestion.php");

$sql = "SELECT * FROM formulaire_atelier ORDER BY 'id' DESC";
$requete = $db->query($sql);
$formulaires = $requete->fetchAll();

?>

<div>
  <div class="container-vente">
    <?php 

      foreach($formulaires as $formulaire):

    ?>
    
    <form class="form" method="POST">
      <h3 class="title-form"><?= $formulaire["prenom"] . ' ' . $formulaire["nom"] ?></h3>
      <div class="bloc-form">
        <input type="hidden" value="<?= $formulaire["id"] ?>" name="ide" id="ide" readonly/>
      </div>
      <div class="bloc-form">
        <p class="black">Nom : <?= $formulaire["nom"] ?></p>
      </div>
      <div class="bloc-form">
        <p class="black">Prénom : <?= $formulaire["prenom"] ?></p>
      </div>
      <div class="bloc-form">
        <p class="black">E-mail : <?= $formulaire["email"] ?></p>
      </div>
      <div class="bloc-form">
        <p class="black">Téléphone : 0<?= $formulaire["telephone"] ?></p>
      </div>
      <div class="bloc-form">
        <p class="black">Raison : <?= $formulaire["raison"] ?></p>
      </div>
      <div class="bloc-form">
        <p class="black">Message : <?= $formulaire["message"] ?></p>
      </div>
      <button type="submit" class="delete" name="delete" value="<?= $formulaire["id"] ?>">Supprimer ce formulaire</button>

      <?php

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
        
          if(isset($_POST["delete"])) {
        
            $id = $_POST["delete"];
            $deletesql = "DELETE FROM formulaire_atelier WHERE id = :id";
            $stmt = $db->prepare($deletesql);
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        
            if($stmt->execute()) {
        
              echo "<h2 class='success'>Formulaire supprimé</h2>";
                      
            } else {
        
              echo "<h2 class='error'>Erreur lors de la suppresion du formulaire</h2>";
        
            }
          }
        }

      ?>

    </form>

    <?php 

      endforeach;
      
    ?>

  </div>
</div>    