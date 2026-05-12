<?php
session_start(); // On récupère la session en cours
session_unset(); // On vide les variables de session
session_destroy(); // On détruit le fichier de session sur le serveur

// On repart d'un dossier (includes) vers la racine
header("Location: ../EcoRide_Accueil.php");
exit();
?>