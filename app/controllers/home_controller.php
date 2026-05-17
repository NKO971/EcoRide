<?php 

function homeController($pdo) { 
    require_once __DIR__ . '/BaseController.php';
    
    BaseController::render(
        "Accueil - EcoRide", 
        "home.view.php",
        ["/EcoRide/css/style.css"]
    );
}