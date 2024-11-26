<?php

require_once("../composants/database.php");

require_once("../composants/background-fixed.php");

require_once("../composants/header-gestion.php");

require_once("../composants/navigation-gestion.php");

require_once("../composants/verifier-admin.php");

?>

<h2 class="big-title">Bandeau</h2>

<div>

<?php

  require_once("../composants/modifier-bandeau.php");

?>

<h2 class="big-title">Réparation</h2>

<div>

  <?php

    $sql = "SELECT * FROM reparation ORDER BY 'id' DESC";
    $requete = $db->query($sql);
    $reparations = $requete->fetchAll();
    
    echo "<div class='container-vente'>";
    
    foreach($reparations as $reparation): ?>

      <form class="form" method="POST">
        <h3 class="title-form"><?= $reparation["title"] ?></h3>
        <div class="bloc-form">
          <input type="hidden" id="id" name="id" value="<?= $reparation["id"] ?>" readonly>
        </div>
        <div class="bloc-form">
          <input type="text" id="title" name="title" value="<?= $reparation["title"] ?>" >
        </div>
        <div class="bloc-form">
          <textarea id="content" name="content" rows="5"><?= $reparation["content"] ?></textarea>
        </div>
        <button type="submit" class="validate">Changer pour <?= $reparation["title"] ?></button>

        <?php

          if(!empty($_POST)){

            if(isset($_POST["id"], $_POST["title"], $_POST["content"])
            
            && !empty($_POST["id"]) && !empty($_POST["title"]) && !empty($_POST["content"])){
          
              $id = $_POST["id"];
              $title = $_POST["title"];
              $content = $_POST["content"];
          
              $newSql = "UPDATE reparation SET title = :title, content = :content WHERE id = :id";
          
              $newQuery = $db->prepare($newSql);
              $newQuery->bindValue(":id", $id, PDO::PARAM_INT);
              $newQuery->bindValue(":title", $title, PDO::PARAM_STR);
              $newQuery->bindValue(":content", $content, PDO::PARAM_STR);
          
              $newQuery->execute();
          
              if($newQuery->execute()){
          
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


