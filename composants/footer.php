<?php

require_once("database.php");

$sql = "SELECT * FROM horaires ORDER BY 'id' DESC";
$requete = $db->query($sql);
$horaires = $requete->fetchAll();

?>

<footer class="footer">
  <div class="hourly foot-bloc">
    <h3 class="footer-title">Horaires</h3>

    <?php

      foreach($horaires as $horaire): 

    ?>

    <li class="hourly-li"><?= $horaire["jour"]?> : <?= $horaire["matin"] ?> | <?= $horaire["apresmidi"] ?></li>

    <?php

      endforeach; 

    ?>
    
  </div>
  <div class="social-link foot-bloc">
    <h3 class="footer-title">Liens</h3>
    <a href="https://www.florianllimos.fr"><img src="media/linternet.png" class="logo-social"></a>
    <a href="https://www.florianllimos.fr"><img src="media/linternet.png" class="logo-social"></a>
    <a href="https://www.florianllimos.fr"><img src="media/linternet.png" class="logo-social"></a>
    <p>06 22 00 55 84</p>
  </div>
  <div class="copyright foot-bloc">
    <p>Copyright 2023 Vincent Parrot GARAGE</p>
  </div>
</footer>
</body>
</html>