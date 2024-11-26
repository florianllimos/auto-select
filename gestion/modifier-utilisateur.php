<?php

require_once("../composants/header-gestion.php");

require_once("../composants/database.php");

require_once("../composants/background-fixed.php");

require_once("../composants/navigation-gestion.php");

require_once("../composants/verifier-admin.php");

$sql = "SELECT * FROM users ORDER BY id DESC";
$requete = $db->query($sql);
$users = $requete->fetchAll();

?>

<div>
  <div class="container-vente">

    <?php 
    
      foreach ($users as $user) : 
    
    ?>

      <form method="POST" class="form">
        <h3 class="title-form"><?= $user["nom"] ?></h3>
        <div class="bloc-form">
          <input type="hidden" value="<?= $user["id"] ?>" name="id" id="id" readonly />
        </div>
        <div class="bloc-form">
          <input type="text" value="<?= $user["nom"] ?>" name="nom" id="nom" />
        </div>
        <div class="bloc-form">
          <input type="text" value="<?= $user["email"] ?>" name="email" id="email" />
        </div>
        <div class="bloc-form">
          <input type="text" value="<?= $user["role"] ?>" name="role" id="role" />
        </div>
        <button type="submit" class="validate">Modifier cet utilisateur</button>

        <?php

        if (!empty($_POST)) {

          if (
            isset($_POST["id"], $_POST["nom"], $_POST["email"], $_POST["role"]) &&
            !empty($_POST["id"]) && !empty($_POST["nom"]) && !empty($_POST["email"]) && !empty($_POST["role"])
          ) {
        
            $id = $_POST["id"];
            $nom = $_POST["nom"];
            $email = $_POST["email"];
            $role = $_POST["role"];
        
            $newSql = "UPDATE users SET nom = :nom, email = :email, role = :role WHERE id = :id";
            $newQuery = $db->prepare($newSql);
            $newQuery->bindValue(":nom", $nom, PDO::PARAM_STR);
            $newQuery->bindValue(":email", $email, PDO::PARAM_STR);
            $newQuery->bindValue(":role", $role, PDO::PARAM_STR);
            $newQuery->bindValue(":id", $id, PDO::PARAM_INT);
        
            $newQuery->execute();
        
            if($newQuery->execute()) {

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
      
  </div>
</div>