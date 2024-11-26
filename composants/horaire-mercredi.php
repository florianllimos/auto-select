<?php

require_once("../composants/verifier-admin.php");


$sql = "SELECT * FROM horaires WHERE id = 3";
$requete = $db->query($sql);
$horaires = $requete->fetchAll();

foreach($horaires as $horaire):

?>

<form method="POST" class="form">
  <h3 class="title-form">Mercredi</h3>
  <div class="bloc-form">
    <label for="mercrediam">Matin</label>
  </div>
  <div class="bloc-form">
    <input type="text" name="mercrediam" id="mercrediam" value="<?= $horaire["matin"] ?>">
  </div>  
  <div class="bloc-form">
    <label for="mercredipm">Après-midi</label>
  </div>
  <div class="bloc-form">
    <input type="text" name="mercredipm" id="mercredipm" value="<?= $horaire["apresmidi"] ?>">
  </div>
  <button type="submit" class="validate">Changer pour le Mercredi</button>

  <?php

    if(!empty($_POST)) {
      if (isset($_POST["mercrediam"], $_POST["mercredipm"]) && !empty($_POST["mercrediam"]) && !empty($_POST["mercredipm"])) {
    
        $mercrediam = $_POST["mercrediam"];
    
        $mercredipm = $_POST["mercredipm"];
    
        require_once("Database.php");
    
        $id = 3;
    
        $sql = "UPDATE horaires SET matin = :mercrediam, apresmidi = :mercredipm WHERE id = :id";
        $query = $db->prepare($sql);
        $query->bindValue(':mercrediam', $mercrediam);
        $query->bindValue(':mercredipm', $mercredipm);
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