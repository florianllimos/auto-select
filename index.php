<?php

  require_once("composants/header.php");

  require_once("composants/background-fixed.php");

?>

<main>
  <div class="bloc-white first-container-bloc">
    <div class="try">
      <img src="media/favicon.png" alt="" class="card-1" />
    </div>
  </div>
  <div class="container-about">
    <div class="bloc-gray">
      <p class="about">Vincent est un expert passionné de l'automobile qui met son savoir-faire au service de ses clients depuis de nombreuses années. 
        Avec son garage situé au cœur de Toulouse, Vincent propose une gamme complète de services de réparation et d'entretien automobile, 
        ainsi que la vente de voitures de qualité.
      </p>
    </div>
    <div class="bloc-gray">
      <p class="about">
        Qu'il s'agisse d'une panne mécanique, d'une révision périodique ou d'une recherche de voiture d'occasion fiable, 
        Vincent est là pour vous offrir des solutions adaptées à vos besoins. Grâce à son expérience approfondie et à 
        sa connaissance approfondie des différentes marques et modèles, il saura diagnostiquer rapidement les problèmes et effectuer les 
        réparations nécessaires avec précision et efficacité.
      </p>
    </div>
</div>

<?php

  require_once("composants/boucle-bandeau.php");

  require_once("composants/ajouter-commentaire.php");

?>

<h2 class="big-title">Avis clients</h2>

<?php

  require_once("composants/commentaires.php");

?>

</main>

<?php

  require_once("composants/footer.php"); 
  
?>