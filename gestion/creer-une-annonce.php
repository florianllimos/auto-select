<?php

require_once("../composants/utilisateur-connecte.php");

require_once("../composants/database.php");

require_once("../composants/header-gestion.php");

require_once("../composants/background-fixed.php");

require_once("../composants/navigation-gestion.php");


?>

<div>
  <form method="POST" enctype="multipart/form-data" class="form-fix">
    <h3 class="title-form">Vendre une voiture</h3>
    <div class="bloc-form">
      <input type="text" name="nom" id="nom" placeholder="Nom de la voiture *">
    </div>    
    <div class="bloc-form">
      <input type="text" name="kilometrage" id="kilometrage" placeholder="Kilométrage du véhicule *">
    </div>
    <div class="bloc-form">
      <input type="text" name="annee" id="annee" placeholder="Année *">
    </div>
    <div class="bloc-form">
      <input type="text" name="transmission" id="transmission" placeholder="Transmission *">
    </div>
    <div class="bloc-form"> 
      <input type="text" name="cylindre" id="cylindre" placeholder="Cylindré *">
    </div>
    <div class="bloc-form"> 
      <input type="text" name="chevaux" id="chevaux" placeholder="Chevaux *">
    </div>
    <div class="bloc-form">
      <input type="text" name="prix" id="prix" placeholder="Prix *">
    </div>
    <div class="bloc-form">
      <input type="file" name="photo" id="photo" accept="image/jpg, image/png, image/jpeg" placeholder="Photo de la voiture *">
    </div>
    <button type="submit" class="validate">Vendre la voiture</button>

    <?php

      if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      
        if (isset($_POST["nom"], $_POST["kilometrage"], $_POST["annee"], $_POST["transmission"], $_POST["cylindre"], $_POST["chevaux"], $_POST["prix"], $_FILES['photo']) 
      
          && !empty($_POST["nom"]) && !empty($_POST["kilometrage"]) && !empty($_POST["annee"]) && !empty($_POST["transmission"]) && !empty($_POST["cylindre"]) 
          && !empty($_POST["chevaux"]) && !empty($_POST["prix"])) {
      
            $nom = strip_tags($_POST["nom"]);
            $kilometrage = strip_tags($_POST["kilometrage"]);
            $annee = strip_tags($_POST["annee"]);
            $transmission = strip_tags($_POST["transmission"]);
            $cylindre = strip_tags($_POST["cylindre"]);
            $chevaux = strip_tags($_POST["chevaux"]);
            $prix = strip_tags($_POST["prix"]);
      
            if (isset($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK) {
      
              $imageData = file_get_contents($_FILES['photo']['tmp_name']);
      
              $sql = "INSERT INTO voitures 
                (nom, kilometrage, annee, transmission, cylindre, chevaux, prix, photo) 
                VALUES 
                (:nom, :kilometrage, :annee, :transmission, :cylindre, :chevaux, :prix, :photo)"
              ;
      
              $query = $db->prepare($sql);
      
              $query->bindParam(':nom', $nom, PDO::PARAM_STR);
              $query->bindParam(':kilometrage', $kilometrage, PDO::PARAM_STR);
              $query->bindParam(':annee', $annee, PDO::PARAM_STR);
              $query->bindParam(':transmission', $transmission, PDO::PARAM_STR);
              $query->bindParam(':cylindre', $cylindre, PDO::PARAM_STR);
              $query->bindParam(':chevaux', $chevaux, PDO::PARAM_STR);
              $query->bindParam(':prix', $prix, PDO::PARAM_STR);
              $query->bindParam(':photo', $imageData, PDO::PARAM_LOB);
      
              if ($query->execute()) {
      
                echo "<h2 class='success'>Voiture mise en vente avec succès</h2>";
      
              } else {
      
                echo "<h2 class='error'>Erreur lors de la mise en vente de la voiture</h2>";
      
              }
            }
          } 
      
          else {
      
            echo "<h2 class='error'>Veuillez remplir tous les champs obligatoires.</h2>";
      
          }
        }

    ?>
    
  </form>
</div>