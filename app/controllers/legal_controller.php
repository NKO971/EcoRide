<?php 
// app/controllers/legal_controller.php 

function mentionsLegales($pdo) { 
    // Variables pour le header dynamique 
    
    $title = "Mentions Légales - EcoRide"; 
    // Inclusion des morceaux dans l'ordre 
    require_once __DIR__ . '/../../includes/header.php'; 
    require_once __DIR__ . '/../views/mention.view.php'; 
    require_once __DIR__ . '/../../includes/footer.php'; 
}