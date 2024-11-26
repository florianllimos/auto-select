<?php

require_once("composants/header.php");

require_once("composants/background-fixed.php");

?>


<div class="page">
  <form class="form-fix" method="POST">
    <h3 class="title-form">Nous contacter</h3>
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
      <input type="text" name="raison" id="raison" placeholder="Raison du contact *" required>
    </div>
    <div class="bloc-form">
      <textarea type="text" name="message" id="message" required rows="5" style="width: 80%; font-family: 'Belanosima', sans-serif; padding: 5px;" placeholder="Votre message"></textarea>
    </div>
    <button type="submit" class="validate">Nous contacter</button>

    <?php

    if (!empty($_POST)) {

      if (isset($_POST["nom"], $_POST["prenom"], $_POST["email"], $_POST["telephone"], $_POST["raison"], $_POST["message"]) 
      && !empty($_POST["nom"]) && !empty($_POST["prenom"]) && !empty($_POST["email"]) && !empty($_POST["telephone"]) && !empty($_POST["raison"]) && !empty($_POST["message"])) {
    
        $nom = strip_tags($_POST["nom"]);
        $prenom = strip_tags($_POST["prenom"]);
        $email = strip_tags($_POST["email"]);
        $telephone = strip_tags($_POST["telephone"]);
        $raison = strip_tags($_POST["raison"]);
        $message = strip_tags($_POST["message"]);
    
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {

          echo"<h2 class='error'>L'adresse e-mail est incorrect</h2>";

        }
    
        require_once("composants/database.php");
    
        $sql = "INSERT INTO `formulaire_contact`(`nom`, `prenom`, `email`, `telephone`, `raison`, `message`) VALUES (:nom, :prenom, :email, :telephone, :raison, :message)";
    
        $query = $db->prepare($sql);
    
        $query->bindValue(":nom", $nom, PDO::PARAM_STR);
        $query->bindValue(":prenom", $prenom, PDO::PARAM_STR);
        $query->bindValue(":email", $email, PDO::PARAM_STR);
        $query->bindValue(":telephone", $telephone, PDO::PARAM_STR);
        $query->bindValue(":raison", $raison, PDO::PARAM_STR);
        $query->bindValue(":message", $message, PDO::PARAM_STR);
    
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
</div>

<?php

require_once("composants/footer.php");

