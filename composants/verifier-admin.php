<?php

require("../composants/database.php");

ob_start();

require("../gestion/connexion.php");

ob_end_clean();

if (!isset($_SESSION["user"]) || $_SESSION["user"]["role"] !== 'Admin') {

  header("Location: gestion/gestion.php");
  exit();

}
