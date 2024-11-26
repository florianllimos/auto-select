<?php

$nextSql = "SELECT * FROM bandeau_reparation";
$requeteBandeau = $db->query($nextSql);
$bandeauxBoucle = $requeteBandeau->fetchAll();

?>
<div class="container-vente">

    <?php

        foreach($bandeauxBoucle as $bandeaux):

    ?>

    <form method="POST" enctype="multipart/form-data" class="form">

        <?php

            $imageData = base64_encode($bandeaux["image"]);
            $imageType = 'png';

        ?>

    <h3 class="title-form"><?= $bandeaux["nom"] ?></h3>
    <div class="bloc-form">

        <?php

            echo "<img src='data:image/" . $imageType . ';base64,' . $imageData . "' alt='Image' class='img-reparation''";

        ?>

    </div>
    <div class="bloc-form">
        <input type="hidden" id="id" name="id" value="<?= $bandeaux["id"] ?>" readonly>
    </div>
    <div class="bloc-form">
        <input type="text" name="nom" id="nom" value="<?= $bandeaux["nom"] ?>">
    </div>    
    <div class="bloc-form">
        <input type="file" name="image" id="image" accept="image/jpeg, image/png" value="<?= $imageType . ';base64,' . $imageData ?>">
    </div>
    <button type="submit" class="validate">Modifier <?= $bandeaux["nom"] ?></button>

    <?php

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
        if (isset($_POST["nom"], $_FILES["image"]) && !empty($_POST["nom"]) && !empty($_FILES["image"])) {
    
            $nom = strip_tags($_POST["nom"]);
            $id = $_POST["id"];
    
            if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
    
                $imageData = file_get_contents($_FILES['image']['tmp_name']);
    
                $newSql = "UPDATE bandeau_reparation SET nom = :nom, image = :image WHERE id = :id";
    
                $newQuery = $db->prepare($newSql);
    
                $newQuery->bindValue(":id", $id, PDO::PARAM_INT);
                $newQuery->bindValue(":nom", $nom, PDO::PARAM_STR);
                $newQuery->bindValue(":image", $imageData, PDO::PARAM_LOB);
                $newQuery->execute();
    
                if($newQuery->execute()){
    
                    echo "<h2 class='success'>Changements prit en compte avec succès</h2>";
    
                } else {
    
                    echo "<h2 class='error'>Erreur lors des changements</h2>";
    
                }
    
            }
        }
    }

    ?>

    </form>
</div>

<?php

    endforeach;

?>

</div>