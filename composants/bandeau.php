<?php

require_once("../composants/database.php");


?>

<div>
  <h2 class="big-title">Bandeau</h2>
  <form method="POST" enctype="multipart/form-data" class="form">
    <div class="bloc-form first-bloc">
      <label for="nom">Titre : <span>*</span></label>
    </div>
    <div class="bloc-form">
      <input type="text" name="nom" id="nom">
    </div>    
    <div class="bloc-form">
      <label for="image">Photo : <span>*</span></label>
    </div>
    <div class="bloc-form">
        <input type="file" name="image" id="image" accept="image/jpeg, image/png">
    </div>
    <button type="submit" class="btn">Ajouter la voiture</button>

    <?php

      if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      
        if (isset($_POST["nom"], $_FILES["image"]) 
      
          && !empty($_POST["nom"]) && !empty($_FILES["image"])) {
      
            $nom = strip_tags($_POST["nom"]);
      
            if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
      
              $imageData = file_get_contents($_FILES['image']['tmp_name']);
      
              $sql = "INSERT INTO bandeau_reparation(nom, image)  VALUES (:nom, :image)";
      
              $query = $db->prepare($sql);
              $query->bindParam(':nom', $nom, PDO::PARAM_STR);
              $query->bindParam(':image', $imageData, PDO::PARAM_LOB);
      
              if ($query->execute()) {
      
                echo "<h2 class='success'>Voiture ajoutée avec succès.</h2>";
      
              } else {
      
                echo "<h2 claass='error'>Erreur lors de l'ajout de la voiture</h2>";
      
              }
            }
      
          } else {
      
            echo "<h2 class='error'>Veuillez remplir tous les champs obligatoires.</h2>";
      
          }
      }

    ?>

  </form>
</div>