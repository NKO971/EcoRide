<?php 

function homeController($pdo) { 
    // Variables pour le header dynamique 
    
    $title = "Accueil - EcoRide";
    
    $specificCss = [
        "/EcoRide/css/bootstrap.min.css",
        "/EcoRide/css/base.css",
        "/EcoRide/css/mediaquerise_base.css",
        "/EcoRide/css/style.css"
    ];
    $specificJS = [
        "/EcoRide/js/bootstrap.bundle.min.js",
        "/EcoRide/js/jquery-3.7.1.min.js"
    ];
    // Inclusion des morceaux dans l'ordre 
    require_once __DIR__ . '/../../includes/header.php'; 
    require_once __DIR__ . '/../views/home.view.php'; 
    require_once __DIR__ . '/../../includes/footer.php'; 
}