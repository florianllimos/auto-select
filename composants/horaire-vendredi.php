<?php

require_once("../composants/verifier-admin.php");


$sql = "SELECT * FROM horaires WHERE id = 5";
$requete = $db->query($sql);
$horaires = $requete->fetchAll();

foreach($horaires as $horaire):
  
  ?>

<form method="POST" class="form">
  <h3 class="title-form">Vendredi</h3>
  <div class="bloc-form">
    <label for="vendrediam">Matin</label>
  </div>
  <div class="bloc-form">
    <input type="text" name="vendrediam" id="vendrediam" value="<?= $horaire["matin"] ?>">
  </div>
  <div class="bloc-form">
    <label for="vendredipm">Après-midi</label>
  </div>
  <div class="bloc-form">
    <input type="text" name="vendredipm" id="vendredipm" value="<?= $horaire["apresmidi"] ?>">
  </div>
  <button type="submit" class="validate">Changer pour le Vendredi</button>

  <?php

    if(!empty($_POST)) {
      if (isset($_POST["vendrediam"], $_POST["vendredipm"]) && !empty($_POST["vendrediam"]) && !empty($_POST["vendredipm"])) {
    
        $vendrediam = $_POST["vendrediam"];
    
        $vendredipm = $_POST["vendredipm"];
    
        require_once("Database.php");
    
        $id = 5;
    
        $sql = "UPDATE horaires SET matin = :vendrediam, apresmidi = :vendredipm WHERE id = :id";
        $query = $db->prepare($sql);
        $query->bindValue(':vendrediam', $vendrediam);
        $query->bindValue(':vendredipm', $vendredipm);
        $query->bindValue(':id', $id);
        $query->execute();
    
        if($query->execute()) {
    
          echo "<h2 class='success'>Changements prit en compte avec succès</h2>";
    
        } else {
    
          echo "<h2 class='error'>Erreur lors des changements</h2>";
    
        }
      }
    }

  ?>
  
</form>

<?php

endforeach; 

?>