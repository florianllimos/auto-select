<?php

$price = $_POST['price'];
$mileage = $_POST['mileage'];
$year = $_POST['year'];

require_once("composants/database.php");

$query = "SELECT * FROM voitures WHERE prix <= :price";

if (!empty($mileage)) {

  $query .= " AND kilometrage <= :mileage";

}

if (!empty($year)) {

  $query .= " AND annee <= :year";

}

$statement = $db->prepare($query);

$statement->bindParam(':price', $price, PDO::PARAM_INT);

if (!empty($mileage)) {

  $statement->bindParam(':mileage', $mileage, PDO::PARAM_INT);

}

if (!empty($year)) {

  $statement->bindParam(':year', $year, PDO::PARAM_INT);

}

$statement->execute();

echo '<div class="container-vente">';

while ($voiture = $statement->fetch(PDO::FETCH_ASSOC)) {

  $imageData = base64_encode($voiture['photo']);
  $imageType = 'jpeg';

  echo "<div class='card-vente'>";
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
    <li>Prix : <?= $voiture["prix"] ?> €</li>
  </ul>
  <?php

  echo "<div class='btn-div'>";
  echo '<a href="details-voiture.php?id=' . $voiture["id"] . '" class="link-car">Voir les détails</a>';
  echo "</div>";
  echo "</div>";
}

echo "</div>";
?>
