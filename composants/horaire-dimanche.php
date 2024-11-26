<?php

require_once("../composants/verifier-admin.php");


$sql = "SELECT * FROM horaires WHERE id = 7";
$requete = $db->query($sql);
$horaires = $requete->fetchAll();

foreach($horaires as $horaire):
  
  ?>

<form method="POST" class="form">
  <h3 class="title-form">Dimanche</h3>
  <div class="bloc-form">
    <label for="dimancheam">Matin</label>
  </div>
  <div class="bloc-form">
    <input type="text" name="dimancheam" id="dimancheam" value="<?= $horaire["matin"] ?>">
  </div>
  <div class="bloc-form">
    <label for="dimanchepm">Après-midi</label>
  </div>
  <div class="bloc-form">
    <input type="text" name="dimanchepm" id="dimanchepm" value="<?= $horaire["apresmidi"] ?>">
  </div>
  <button type="submit" class="validate">Changer pour le Dimanche</button>

  <?php

    if(!empty($_POST)) {
      if (isset($_POST["dimancheam"], $_POST["dimanchepm"]) && !empty($_POST["dimancheam"]) && !empty($_POST["dimanchepm"])) {
    
        $dimancheam = $_POST["dimancheam"];
    
        $dimanchepm = $_POST["dimanchepm"];
    
        require_once("database.php");
    
        $id = 7;
    
        $sql = "UPDATE horaires SET matin = :dimancheam, apresmidi = :dimanchepm WHERE id = :id";
        $query = $db->prepare($sql);
        $query->bindValue(':dimancheam', $dimanchepm);
        $query->bindValue(':dimancheam', $dimanchepm);
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