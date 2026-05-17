<?php
// On inclut le modèle pour que PHP connaisse l'existence de la classe CovoiturageModel
require_once __DIR__ . '/../models/CovoiturageModel.php';

function covoiturageController($pdo) {
    // Récupération des critères de la barre de recherche principale
    $depart = isset($_GET['lieu_depart']) ? trim($_GET['lieu_depart']) : null;
    $arrivee = isset($_GET['lieu_arrivee']) ? trim($_GET['lieu_arrivee']) : null;
    $date = !empty($_GET['date_depart']) ? $_GET['date_depart'] : null;

    // Instanciation du modèle et exécution de la recherche
    $model = new CovoiturageModel($pdo);
    $trajets = $model->getTrajetsPourRecherche($depart, $arrivee, $date);


    // Variables pour le header dynamique 
    $title = "Covoiturage - EcoRide";
    
    $specificCss = [
        "/EcoRide/css/bootstrap.min.css",
        "/EcoRide/css/base.css",
        "/EcoRide/css/mediaquerise_base.css",
        "/EcoRide/css/resultat.css"
    ];
    $specificJS = [
        "/EcoRide/js/bootstrap.bundle.min.js",
        "/EcoRide/js/jquery-3.7.1.min.js"
    ];
    // Inclusion des morceaux dans l'ordre 
    require_once __DIR__ . '/../../includes/header.php'; 
    require_once __DIR__ . '/../views/covoiturage.view.php'; 
    require_once __DIR__ . '/../../includes/footer.php'; 
}