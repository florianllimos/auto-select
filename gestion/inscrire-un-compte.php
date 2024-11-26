<?php

require_once("../composants/utilisateur-connecte.php");

require_once("../composants/header-gestion.php");

require_once("../composants/background-fixed.php");

require_once("../composants/database.php");

require_once("../composants/navigation-gestion.php");

require_once("../composants/verifier-admin.php");


?>

<div>
  <form method="POST" class="form-fix">
    <h3 class="title-form">Inscription</h3>
    <div class="bloc-form">
      <input type="text" name="nom" id="nom" placeholder="Nom *" required>
    </div>
    <div class="bloc-form">
      <input type="email" name="email" id="email" placeholder="Adresse e-mail *" required>
    </div>
    <div class="bloc-form">
      <input type="password" name="password" id="password" placeholder="Mot de passe *" required>
    </div>
    <button type="submit" class="validate">Inscrire</button>

    <?php

      if(isset($_POST["nom"], $_POST["email"], $_POST["password"]) && !empty($_POST["nom"]) && !empty($_POST["email"]) && !empty($_POST["password"])) {
        
        $nom = strip_tags($_POST["nom"]);
        $email = strip_tags($_POST["email"]);
        $password = password_hash($_POST["password"], PASSWORD_ARGON2ID);
        $role = 'Employé';
      
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
          $inscription = "INSERT INTO users(`nom`, `email`, `password`, `role`) VALUES (:nom, :email, :password, :role)";
      
          $query = $db->prepare($inscription);
          $query->bindValue(":nom", $nom, PDO::PARAM_STR);
          $query->bindValue(":email", $email, PDO::PARAM_STR);
          $query->bindValue(":password", $password, PDO::PARAM_STR);
          $query->bindValue(":role", $role, PDO::PARAM_STR);
          
          $query->execute();
      
          if ($query->rowCount() > 0) {
      
            echo "<h2 class='success'>L'employé a été inscrit avec succès.</h2>";
      
          } else {
      
            echo "<h2 class='error'>Une erreur s'est produite lors de l'inscription de l'employé.</h2>";
      
          }
      
        }

      }
  
    ?>
    
  </form>
</div>
