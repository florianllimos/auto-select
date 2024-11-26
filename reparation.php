<?php

  require_once("composants/header.php");

  require_once("composants/background-fixed.php");

  require_once("composants/database.php");
  
  require_once("composants/boucle-bandeau.php");
  
  
  
  require_once("composants/boucle-description.php");
  
  ?>
  <form class="form-fix" method="POST">
    <h3 class="title-form">Contacter l'atelier</h3>
    <div class="bloc-form">
      <input type="text" name="nom" id="nom" placeholder="Nom *" required>
    </div>
    <div class="bloc-form">
      <input type="text" name="prenom" id="prenom" placeholder="Prénom *" required>
    </div>
    <div class="bloc-form">
      <input type="email" name="email" id="email" placeholder="Adresse e-mail *" required>
    </div>
    <div class="bloc-form">
      <input type="number" name="telephone" id="telephone" placeholder="Numéro de téléphone *" required>
    </div>
    <div class="bloc-form">
      <select name="raison" id="raison" style="width: 80%; height: 40px">

        <?php

          $sqlRaison = "SELECT * FROM reparation";
          $requetes = $db->prepare($sqlRaison);
          $requetes->execute();
  
          $raisons = $requetes->fetchAll();
  
          foreach($raisons as $raison):
            
            ?>

<option value="<?= $raison["title"] ?>"><?= $raison["title"] ?></option>

<?php

endforeach;

?>

</select>
</div>
<div class="bloc-form">
  <textarea type="text" name="message" id="message" rows="5" placeholder="Votre message" required></textarea>
</div>
<button type="submit" class="validate">Nous contacter</button>

<?php

  if (!empty($_POST)) {
    if (isset($_POST["nom"], $_POST["prenom"], $_POST["email"], $_POST["telephone"], $_POST["raison"], $_POST["message"]) 
    && !empty($_POST["nom"]) && !empty($_POST["prenom"]) && !empty($_POST["email"]) && !empty($_POST["telephone"]) && !empty($_POST["raison"]) && !empty($_POST["message"])) {

      if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
        die("L'adresse email est incorrecte !");
      }

      $sql = "INSERT INTO `formulaire_atelier`(`nom`, `prenom`, `email`, `telephone`, `raison`, `message`) VALUES (:nom, :prenom, :email, :telephone, :raison, :message)";

      $nom = strip_tags($_POST["nom"]);
      $prenom = strip_tags($_POST["prenom"]);
      $email = strip_tags($_POST["email"]);
      $telephone = strip_tags($_POST["telephone"]);
      $raison = strip_tags($_POST["raison"]);
      $message = strip_tags($_POST["message"]);

      $query = $db->prepare($sql);
    
      $query->bindValue(":nom", $nom, PDO::PARAM_STR);
      $query->bindValue(":prenom", $prenom, PDO::PARAM_STR);
      $query->bindValue(":email", $email, PDO::PARAM_STR);
      $query->bindValue(":telephone", $telephone, PDO::PARAM_STR);
      $query->bindValue(":raison", $raison, PDO::PARAM_STR);
      $query->bindValue(":message", $message, PDO::PARAM_STR);

      $query->execute();

      if($query->execute()){

        echo "<h2 class='success'>Envoyé !</h2>";

      } else {

        echo "<h2 class='error'>Erreur lors de l'envoie</h2>";

      }

    }

  }

?>
  
</form>

<?php

require_once("composants/footer.php");

?>
