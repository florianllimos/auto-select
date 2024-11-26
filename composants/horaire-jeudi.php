<?php

require_once("../composants/verifier-admin.php");

$sql = "SELECT * FROM horaires WHERE id = 4";
$requete = $db->query($sql);
$horaires = $requete->fetchAll();

foreach($horaires as $horaire):

?>

<form method="POST" class="form">
  <h3 class="title-form">Jeudi</h3>
  <div class="bloc-form">
    <label for="jeudiam">Matin</label>
  </div>
  <div class="bloc-form">
    <input type="text" name="jeudiam" id="jeudiam" value="<?= $horaire["matin"] ?>">
  </div>
  <div class="bloc-form">
    <label for="jeudipm">Après-midi</label>
  </div>
  <div class="bloc-form">
    <input type="text" name="jeudipm" id="jeudipm" value="<?= $horaire["apresmidi"] ?>">
  </div>
  <button type="submit" class="validate">Changer pour le Jeudi</button>

  <?php

    if(!empty($_POST)) {
      if (isset($_POST["jeudiam"], $_POST["jeudipm"]) && !empty($_POST["jeudiam"]) && !empty($_POST["jeudipm"])) {
    
        $jeudiam = $_POST["jeudiam"];
    
        $jeudipm = $_POST["jeudipm"];
    
        require_once("Database.php");
    
        $id = 4;
    
        $sql = "UPDATE horaires SET matin = :jeudiam, apresmidi = :jeudipm WHERE id = :id";
        $query = $db->prepare($sql);
        $query->bindValue(':jeudiam', $jeudiam);
        $query->bindValue(':jeudipm', $jeudipm);
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