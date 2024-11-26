<?php

require_once("utilisateur-connecte.php");

require_once("database.php");

  $commentaires = "commentaires";
  $stmt = $db->query("SELECT COUNT(*) as total FROM $commentaires");
  $countCommentaires = $stmt->fetchColumn();

  $commentairesAttente = "commentaires_attente";
  $cmtatt = $db->query("SELECT COUNT(*) as total FROM $commentairesAttente");
  $countCommentairesAttente = $cmtatt->fetchColumn();

  $utilisateur = "users";
  $cntUtilisateur = $db->query("SELECT COUNT(*) as total FROM $utilisateur");
  $countUtilisateur = $cntUtilisateur->fetchColumn();

  $formulaireAtelier = "formulaire_atelier";
  $cntFormulaireAtelier = $db->query("SELECT COUNT(*) as total FROM $formulaireAtelier");
  $countFormulaireAtelier = $cntFormulaireAtelier->fetchColumn();

  $formulaireVente = "formulaire_vente";
  $cntFormulaireVente = $db->query("SELECT COUNT(*) as total FROM $formulaireVente");
  $countFormulaireVente = $cntFormulaireVente->fetchColumn();

  $formulaireContact = "formulaire_contact";
  $cntFormulaireContact = $db->query("SELECT COUNT(*) as total FROM $formulaireContact");
  $countFormulaireContact = $cntFormulaireContact->fetchColumn();

  $voitures = "voitures";
  $cntVoitures = $db->query("SELECT COUNT(*) as total FROM $voitures");
  $countVoitures = $cntVoitures->fetchColumn();

?>

<div class="header1">
    <nav class="navbar1 container1">
      <h1></h1>
      <input type="checkbox" id="toggler1" />
      <label for="toggler1"><img src="../media/burger.png" class="burgerLogo1"></img></label>
      <div class="menu1">
        <ul class="list1">
          <a href="connexion.php"><li class="none">Connexion</li></a>
          <a href="creer-une-annonce.php"><li class="none">Vendre véhicule</li></a>
          <a href="supprimer-annonce.php"><li>Supprimer annonce</li></a>            
          <a href="modifier-annonce.php"><li>Véhicules en vente : | <?= $countVoitures ?> | </li></a>            
          <a href="commentaire-en-attente.php"><li>Commentaires en attente : | <?= $countCommentairesAttente ?> | </li></a>
          <a href="supprimer-commentaires.php"><li>Commentaires : | <?= $countCommentaires ?> | </li></a>
          <a href="formulaire-atelier.php"><li>Atelier formulaire : | <?= $countFormulaireAtelier ?> | </li></a>
          <a href="formulaire-vente.php"><li>Vente formulaire : | <?= $countFormulaireVente ?> | </li></a>
          <a href="formulaire-contact.php"><li>Contact : | <?= $countFormulaireContact ?> | </li></a>
          <a href="modifier-horaires.php"><li>Modifier les horaires</li></a>
          <a href="modifier-reparation.php"><li class="none">Réparation</li></a>
          <a href="inscrire-un-compte.php"><li>Inscrire un employé</li></a>
          <a href="modifier-utilisateur.php"><li>Modifier utilisateur : | <?= $countUtilisateur ?> | </li></a>
          <a href="supprimer-utilisateur.php"><li>Supprimer utilisateur</li></a>
        </ul>
      </div>
    </nav>
</div>