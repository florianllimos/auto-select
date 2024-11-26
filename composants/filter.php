<?php

require_once("../composants/database.php");

$prix = $_GET['prix'];
$annee = $_GET['annee'];
$kilometrage = $_GET['kilometrage'];

$sql = "SELECT * FROM voitures WHERE prix <= :prix AND (:annee IS NULL OR annee >= :annee) AND kilometrage <= :kilometrage";

$stmt = $db->prepare($sql);

$stmt->bindParam(':prix', $prix, PDO::PARAM_INT);
$stmt->bindParam(':annee', $annee, PDO::PARAM_INT);
$stmt->bindParam(':kilometrage', $kilometrage, PDO::PARAM_INT);

$stmt->execute();

$voitures = $stmt->fetchAll();

foreach ($voitures as $voiture) {

    echo "<p>Nom: " . $voiture['nom'] . "</p>";
    echo "<p>Prix: " . $voiture['prix'] . "</p>";
    echo "<p>Année: " . $voiture['annee'] . "</p>";

}

?>