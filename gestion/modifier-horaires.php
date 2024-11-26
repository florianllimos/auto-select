<?php

require_once("../composants/utilisateur-connecte.php");

require_once("../composants/database.php");

require_once("../composants/header-gestion.php");

require_once("../composants/background-fixed.php");

require_once("../composants/navigation-gestion.php");

require_once("../composants/verifier-admin.php");

$sql = "SELECT * FROM horaires ORDER BY 'id' DESC";
$requete = $db->query($sql);
$horaires = $requete->fetchAll();

?>

<div>
  <div class="container-vente">

    <?php
    
      require_once("../composants/horaire-lundi.php");

      require_once("../composants/horaire-mardi.php");

      require_once("../composants/horaire-mercredi.php");

      require_once("../composants/horaire-jeudi.php");

      require_once("../composants/horaire-vendredi.php");

      require_once("../composants/horaire-samedi.php");

      require_once("../composants/horaire-dimanche.php");

    ?>
    
  </div>
</div>