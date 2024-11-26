<?php

require_once("../composants/verifier-admin.php");


$sql = "SELECT * FROM horaires WHERE id = 1";
$requete = $db->query($sql);
$horaires = $requete->fetchAll();

foreach($horaires as $horaire):
  
  ?>

<form method="POST" class="form">
  <h3 class="title-form">Lundi</h3>
  <div class="bloc-form">
    <label for="lundiam">Matin</label>
  </div>
  <div class="bloc-form">
    <input type="text" name="lundiam" id="lundiam" value="<?= $horaire["matin"] ?>">
  </div>
  <div class="bloc-form">
    <label for="lundipm">Après-midi</label>
  </div>
  <div class="bloc-form">
    <input type="text" name="lundipm" id="lundipm" value="<?= $horaire["apresmidi"] ?>">
  </div>
  <button type="submit" class="validate">Changer pour le Lundi</button>

  <?php

    if(!empty($_POST)) {
      if (isset($_POST["lundiam"], $_POST["lundipm"]) && !empty($_POST["lundiam"]) && !empty($_POST["lundipm"])) {
    
        $lundiam = $_POST["lundiam"];
    
        $lundipm = $_POST["lundipm"];
    
        require_once("Database.php");
    
        $id = 1;
    
        $sql = "UPDATE horaires SET matin = :lundiam, apresmidi = :lundipm WHERE id = :id";
        $query = $db->prepare($sql);
        $query->bindValue(':lundiam', $lundiam);
        $query->bindValue(':lundipm', $lundipm);
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