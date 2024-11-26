<?php

require_once("../composants/verifier-admin.php");


$sql = "SELECT * FROM horaires WHERE id = 6";
$requete = $db->query($sql);
$horaires = $requete->fetchAll();

foreach($horaires as $horaire):

?>

<form method="POST" class="form">
  <h3 class="title-form">Samedi</h3>
  <div class="bloc-form">
    <label for="samediam">Matin</label>
  </div>
  <div class="bloc-form">
    <input type="text" name="samediam" id="samediam" value="<?= $horaire["matin"] ?>">
  </div>
  <div class="bloc-form">
    <label for="samedipm">Après-midi</label>
  </div>
  <div class="bloc-form">
    <input type="text" name="samedipm" id="samedipm" value="<?= $horaire["apresmidi"] ?>">  
  </div>
  <button type="submit" class="validate">Changer pour le Samedi</button>

  <?php

    if(!empty($_POST)) {
      if (isset($_POST["samediam"], $_POST["samedipm"]) && !empty($_POST["samediam"]) && !empty($_POST["samedipm"])) {
    
        $samediam = $_POST["samediam"];
    
        $samedipm = $_POST["samedipm"];
    
        require_once("Database.php");
    
        $id = 6;
    
        $sql = "UPDATE horaires SET matin = :samediam, apresmidi = :samedipm WHERE id = :id";
        $query = $db->prepare($sql);
        $query->bindValue(':samediam', $samedipm);
        $query->bindValue(':samediam', $samedipm);
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