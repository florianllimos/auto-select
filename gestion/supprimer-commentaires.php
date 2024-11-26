<?php

include_once("../composants/header-gestion.php");

include_once("../composants/background-fixed.php");

require_once("../composants/utilisateur-connecte.php");

include_once("../composants/database.php");

require_once("../composants/navigation-gestion.php");


$sql = "SELECT * FROM commentaires ORDER BY id DESC";
$requete = $db->query($sql);
$commentaires = $requete->fetchAll();

?>

<div>
  <div class="container-vente">
    
    <?php 
    
      foreach ($commentaires as $commentaire) : 
        
        ?>

      <form method="POST" class="form">
        <h3 class="title-form"><?= $commentaire["nom"] ?></h3>
        <div class="bloc-form">
          <input type="hidden" value="<?= $commentaire["id"] ?>" name="delete" id="id" readonly />
        </div>
        <div class="bloc-form">
          <p class="black">Nom : <?= $commentaire["nom"] ?></p>
        </div>
        <div class="bloc-form">
          <p class="black">Commentaire : <?= $commentaire["content"] ?></p>
        </div>
        <div class="bloc-form">
          <p class="black">Note : <?= $commentaire["note"] ?> / 5</p>
        </div>
        <button type="submit" class="delete">Supprimer le commentaire</button>

        <?php

          if (isset($_POST["delete"])) {
          
            $idToDelete = $_POST["delete"];
          
            $deletesql = "DELETE FROM commentaires WHERE id = :id";
            $stmt = $db->prepare($deletesql);
            $stmt->bindParam(':id', $idToDelete, PDO::PARAM_INT);
          
            if ($stmt->execute()) {
          
              echo "<h2 class='success'>Commentaire supprimé !</h2>";
          
            } else {
          
              echo "<h2 class='error'>Erreur lors de la suppression du commentaire !</h2>";
          
            }
          
          }

        ?>
          
      </form>
      
      <?php 
  
endforeach; 

?>

</div>
</div>
