<?php

require_once("../composants/verifier-admin.php");


$sql = "SELECT * FROM horaires WHERE id = 2";
$requete = $db->query($sql);
$horaires = $requete->fetchAll();

foreach($horaires as $horaire):

  ?>

<form method="POST" class="form">
  <h3 class="title-form">Mardi</h3>
  <div class="bloc-form">
    <label for="mardiam">Matin</label>
  </div>
  <div class="bloc-form">
    <input type="text" name="mardiam" id="mardiam" value="<?= $horaire["matin"] ?>">
  </div>
  <div class="bloc-form">
    <label for="mardipm">Après-midi</label>
  </div>
  <div class="bloc-form">
    <input type="text" name="mardipm" id="mardipm" value="<?= $horaire["apresmidi"] ?>">
  </div>
  <button type="submit" class="validate">Changer pour le Mardi</button>

  <?php

    if(!empty($_POST)) {
      if (isset($_POST["mardiam"], $_POST["mardipm"]) && !empty($_POST["mardiam"]) && !empty($_POST["mardipm"])) {
    
        $mardiam = $_POST["mardiam"];
    
        $mardipm = $_POST["mardipm"];
    
        require_once("Database.php");
    
        $id = 2;
    
        $sql = "UPDATE horaires SET matin = :mardiam, apresmidi = :mardipm WHERE id = :id";
        $query = $db->prepare($sql);
        $query->bindValue(':mardiam', $mardiam);
        $query->bindValue(':mardipm', $mardipm);
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