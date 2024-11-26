<?php

require_once("database.php");

?>

<div class="container-form">
  <div class="about-commentaire about-commentaire1">
    <p>Parce que votre avis compte, laissez nous un avis sur les préstations que vous avez récu
      de notre part.
    </p>
  </div>
  <div class="about-commentaire about-commentaire2">
    <p>
      Toute l'équipe vous remercie pour votre commentaire !
    </p>
  </div>
  <div class="form-about">
    <form method="POST" class="form-fix">
      <h3 class="title-form">Laisser un commentaire</h3>
      <div class="bloc-form">
        <input type="text" name="nom" id="nom" placeholder="Votre nom *" required>
      </div>
      <div class="bloc-form">
        <input type="textarea" name="content" id="content" placeholder="Votre commentaire *" required>  
      </div>
      <div class="bloc-form">
        <input type="number" name="note" id="note" min="1" max="5" placeholder="Votre note sur 5 *" required>  
      </div>
      <button type="submit" class="validate">Envoyer mon commentaire</button>

      <?php

        if(!empty($_POST)) {

          if(isset($_POST["nom"], $_POST["content"])
          && !empty($_POST["nom"]) && !empty($_POST["content"])) {
        
            $sql = "INSERT INTO `commentaires_attente`(nom, content, note) VALUES (:nom, :content, :note)";
              
            $query = $db->prepare($sql);
            $query->bindValue(":nom", $_POST["nom"], PDO::PARAM_STR);
            $query->bindValue(":content", $_POST["content"], PDO::PARAM_STR);
            $query->bindValue(":note", $_POST["note"], PDO::PARAM_INT);
            $query->execute();
        
            if($query->execute()){
        
              echo "<h2 class='success'>Votre commentaire a bien été envoyé !</h2>";
        
            } else {
        
              echo "<h2 class='error'>Erreur lors de l'envoie du commentaire !</h2>";
        
            }
        
          }
        }
      ?>
      
    </form>
  </div>  
</div>