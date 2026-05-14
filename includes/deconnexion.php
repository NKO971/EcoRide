<?php
session_start(); // On récupère la session en cours
session_unset(); // On vide les variables de session
session_destroy(); // On détruit le fichier de session sur le serveur

// Redirection vers la page d'accueil via le routeur
header("Location: /public/?page=home");
exit();
?>