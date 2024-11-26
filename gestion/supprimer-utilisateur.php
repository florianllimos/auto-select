<?php

require_once("../composants/header-gestion.php");

require_once("../composants/background-fixed.php");

require_once("../composants/utilisateur-connecte.php");

require_once("../composants/database.php");

require_once("../composants/verifier-admin.php");

require_once("../composants/navigation-gestion.php");

$sql = "SELECT * FROM users ORDER BY id DESC";
$requete = $db->query($sql);
$users = $requete->fetchAll();

?>

<div>
    <div class="container-vente">


        <?php 
        
            foreach($users as $user): 
            
        ?>
        
        <form method="POST" class="form">
            <h3 class="title-form"><?= $user["nom"] ?></h3>
            <div class="bloc-form">
                <input type="hidden" value="<?= $user["id"] ?>" name="ide" id="ide" readonly/>
            </div>
            <div class="bloc-form">
                <input type="text" value="<?= $user["nom"] ?>" name="nom" id="nom" readonly/>
            </div>
            <div class="bloc-form">
                <input type="text" value="<?= $user["email"] ?>" name="email" id="email" readonly/>
            </div>
            <div class="bloc-form">
                <input type="text" value="<?= $user["role"] ?>" name="role" id="role" readonly/>
            </div>
            <button class="delete" type="submit" name="delete" value="<?= $user["id"] ?>">Supprimer l'utilisateur</button>

            <?php

                if($_SERVER['REQUEST_METHOD'] === 'POST') {
                    
                    if(isset($_POST["delete"])) {
                    
                        $id = $_POST["delete"];
                        $deletesql = "DELETE FROM users WHERE id = :id";
                        $stmt = $db->prepare($deletesql);
                        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
                    
                        if($stmt->execute()) {
                    
                            echo "<h2 class='success'>Utilisateur supprimé avec succès</h2>";
                    
                        } else {
                    
                            echo "<h2 class='error'>Erreur lors de la suppression de l'utilisateur</h2>";
                    
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