<?php

require_once("../composants/database.php");

require_once("../composants/header-gestion.php");

require_once("../composants/utilisateur-connecte.php");

require_once("../composants/navigation-gestion.php");

require_once("../composants/background-fixed.php");

$sql = "SELECT * FROM commentaires_attente ORDER BY id DESC";
$requete = $db->query($sql);
$commentaires = $requete->fetchAll();

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    if (isset($_POST["nom"], $_POST["content"], $_POST["commentaire_id"], $_POST["action"]) &&
        !empty($_POST["nom"]) && !empty($_POST["content"]) && !empty($_POST["commentaire_id"])) {

        $action = $_POST["action"];

        if ($action === "delete") {

            $commentaire_id = $_POST["commentaire_id"];
            $sql_delete = "DELETE FROM `commentaires_attente` WHERE id = :commentaire_id";
            $query_delete = $db->prepare($sql_delete);
            $query_delete->bindValue(":commentaire_id", $commentaire_id, PDO::PARAM_INT);
            $query_delete->execute();

            header("Location: ".$_SERVER['PHP_SELF']);
            exit();

        } elseif ($action === "approve") {

            $sql_insert = "INSERT INTO `commentaires`(`nom`, `content`, `note`) VALUES (:nom, :content, :note)";
            $query_insert = $db->prepare($sql_insert);
            $query_insert->bindValue(":nom", $_POST["nom"], PDO::PARAM_STR);
            $query_insert->bindValue(":content", $_POST["content"], PDO::PARAM_STR);
            $query_insert->bindValue(":note", $_POST["note"], PDO::PARAM_INT);
            $query_insert->execute();

            $commentaire_id = $_POST["commentaire_id"];
            $sql_delete = "DELETE FROM `commentaires_attente` WHERE id = :commentaire_id";
            $query_delete = $db->prepare($sql_delete);
            $query_delete->bindValue(":commentaire_id", $commentaire_id, PDO::PARAM_INT);
            $query_delete->execute();

            header("Location: ".$_SERVER['PHP_SELF']);
            exit();

        }
    }
}

?>

<div>
    <div class="container-vente">

        <?php foreach ($commentaires as $commentaire) : ?>

            <form method="POST" class="form">
                <h3 class="title-form"><?= $commentaire["nom"] . ' ' . $commentaire["note"] . ' / 5' ?></h3>
                <div class="bloc-form">
                    <p class="black">Nom : <?= $commentaire["nom"] ?></p>
                </div>
                <div class="bloc-form">
                    <p class="black">Commentaire : <?= $commentaire["content"] ?></p>
                </div>
                <div class="bloc-form">
                    <p class="black">Note : <?= $commentaire["note"] ?> / 5</p>
                </div>
                <input type="hidden" name="commentaire_id" value="<?= $commentaire["id"] ?>">
                <input type="hidden" name="nom" value="<?= $commentaire["nom"] ?>">
                <input type="hidden" name="content" value="<?= $commentaire["content"] ?>">
                <input type="hidden" name="note" value="<?= $commentaire["note"] ?>">
                <button type="submit" class="validate" name="action" value="approve">Valider le commentaire</button>
                <button type="submit" class="delete" name="action" value="delete">Supprimer le commentaire</button>
            </form>

        <?php 
    
            endforeach; 
    
        ?>
        
    </div>
</div>
