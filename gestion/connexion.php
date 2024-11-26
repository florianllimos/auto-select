<?php

require_once("../composants/header-gestion.php");

require_once("../composants/background-fixed.php");
    
?>

<form method="POST" class="form-fix connexion-form">
    <h3 class="title-form">Connexion</h3>
    <div class="bloc-form">
        <input type="email" name="email" id="email" placeholder="Adresse e-mail" required>
    </div>
    <div class="bloc-form">
        <input type="password" name="password" id="password" placeholder="Mot de passe" required>
    </div>
    <button type="submit" class="validate">Me connecter</button>

    <?php

        if (!empty($_POST)) {

            if (isset($_POST["email"], $_POST["password"]) && !empty($_POST["email"]) && !empty($_POST["password"])) {

                if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {

                    die("Ce n'est pas une adresse e-mail valide");

                }

                require_once("../composants/database.php");

                $sql = "SELECT * FROM users WHERE email = :email";
                $query = $db->prepare($sql);
                $query->bindValue(":email", $_POST["email"], PDO::PARAM_STR);
                $query->execute();
                $user = $query->fetch();

                if (!$user) {

                    echo "<h2 class='error'>Le mot de passe et / ou l'adresse e-mail est incorrect</h2>";

                } else {

                    if(!password_verify($_POST["password"], $user["password"])) {

                        echo "<h2 class='error'>Le mot de passe et / ou l'adresse e-mail est incorrect</h2>";

                    } else {
                
                        session_start();

                        $_SESSION["user"] = [
                            "id" => $user["id"],
                            "nom" => $user["nom"],
                            "email" => $user["email"],
                            "role" => $user["role"]
                        ];

                        header("Location: gestion.php");
                        exit();
                    }
                }
            }
        } 
    ?>
    
</form>