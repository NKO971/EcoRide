<?php

function employeeController($pdo) {
    // Vérifier que l'utilisateur est un employé (role_id = 2)
    if (!isset($_SESSION['user_id']) || $_SESSION['role_id'] != 2) {
        header("Location: ?page=connexion");
        exit();
    }

    require_once __DIR__ . '/../models/User.php';
    $userModel = new User($pdo);
    
    // Récupérer les infos de l'employé
    $employee = $userModel->getById($_SESSION['user_id']);

    // Variables pour le header dynamique
    $title = "Espace Employé - EcoRide";
    $specificCss = [
        "/EcoRide/css/bootstrap.min.css",
        "/EcoRide/css/base.css",
        "/EcoRide/css/mediaquerise_base.css",
        "/EcoRide/css/espace-employe.css"
    ];
    $specificJS = [
        "/EcoRide/js/bootstrap.bundle.min.js",
        "/EcoRide/js/jquery-3.7.1.min.js"
    ];

    // Inclusion des morceaux dans l'ordre
    require_once __DIR__ . '/../../includes/header_employe.php';
    require_once __DIR__ . '/../views/employee.view.php';
    require_once __DIR__ . '/../../includes/footer.php';
}

?>
