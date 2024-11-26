<?php

require_once("composants/header.php");

require_once("composants/database.php");

require_once("composants/background-fixed.php");

echo "<div class='page-vente'>";

if (isset($_GET['id'])) {

    $carId = $_GET['id'];

    $sql = "SELECT * FROM voitures WHERE id = :carId";
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':carId', $carId, PDO::PARAM_INT);
    $stmt->execute();

    if ($voiture = $stmt->fetch(PDO::FETCH_ASSOC)) {

      $imageData = base64_encode($voiture['photo']);
      $imageType = 'jpeg';

      echo "<div class='card-vente details'>";
      echo '<h3 class="title-card">' . $voiture["nom"] . '</h3>';

      if (isset($voiture['photo']) && !empty($voiture['photo'])) {

        echo '<img src="data:image/' . $imageType . ';base64,' . $imageData . '" alt="Image" class="car-img">';

    }

  ?>

    <hr class='separator'>
    <p class='caracteristiques'>Caractéristiques</p>
    <hr class='separator'>
      <ul class='ul-vente'>
      <li>Nom du véhicule : <?= $voiture["nom"] ?></li>
      <li>Kilométrage : <?= $voiture["kilometrage"] ?></li>
      <li>Année : <?= $voiture["annee"] ?></li>
      <li>Transmission : <?= $voiture["transmission"] ?></li>
      <li>Cylindré : <?= $voiture["cylindre"] ?></li>
      <li>Chevaux : <?= $voiture["chevaux"] ?></li>
      <li>Prix : <?= $voiture["prix"] ?></li>
    </ul>

<?php

    } else {

      echo '<h2 class="error">Voiture non trouvée.</h2>';

    }

    } else {

      echo '<h2 class="error">ID de voiture non spécifié.</h2>';

    }
    
echo "</div>";

?>

<form class="form-fix" method="POST">
  <h3 class="title-form"><?= $voiture["nom"] ?></h3>
  <div class="bloc-form">
    <input type="text" id="vehicule" name="vehicule" value="<?= $voiture["nom"] ?> " readonly>
  </div>
  <div class="bloc-form">
    <input type="text" id="nom" placeholder="Nom *" name="nom" required>
  </div>
  <div class="bloc-form">
    <input type="number" id="telephone" placeholder="Numéro de téléphone *" name="telephone" required>
  </div>
  <button type="submit" class="validate">Envoyer</button>

  <?php

  if(!empty($_POST)){
    if(isset($_POST["vehicule"], $_POST["nom"], $_POST["telephone"])
    && !empty($_POST["vehicule"]) && !empty($_POST["nom"]) && !empty($_POST["telephone"])){
  
      $insert = "INSERT INTO formulaire_vente(`vehicule`, `nom`, `telephone`) VALUES (:vehicule, :nom, :telephone)";
      $query = $db->prepare($insert);
  
      $query->bindValue(":vehicule", $_POST["vehicule"], PDO::PARAM_STR);
      $query->bindValue(":nom", $_POST["nom"], PDO::PARAM_STR);
      $query->bindValue(":telephone", $_POST["telephone"], PDO::PARAM_INT);
  
      $query->execute();
  
      if($query->execute()){
  
        echo "<h2 class='success'>Le formulaire a bien été envoyé !</h2>";
  
      } else {
  
        echo "<h2 class='error'>Erreur lors de l'envoie du formulaire !</h2>";
  
      }
  
    }

  }

  ?>

</form>

<?php 

echo "</div>";

require_once("composants/footer.php");