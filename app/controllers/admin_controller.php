<?php

function adminController($pdo) {
    // Vérifier que l'utilisateur est un admin (role_id = 1)
    if (!isset($_SESSION['user_id']) || $_SESSION['role_id'] != 1) {
        header("Location: ?page=connexion");
        exit();
    }

    require_once __DIR__ . '/../models/User.php';
    $userModel = new User($pdo);
    
    //  Traitement du formulaire de création d'employé
    $msg = null;
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['pseudo'])) {
        // On récupère les données du formulaire
        $pseudo = $_POST['pseudo'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        // On appelle la méthode qu'on va créer dans le Modèle
        if ($userModel->createEmployee($pseudo, $email, $password)) {
            $msg = "Le compte employé de $pseudo a été créé avec succès !";
        } else {
            $msg = "Erreur lors de la création du compte.";
        }
    }

    // Récupérer les infos de l'admin
    $admin = $userModel->getById($_SESSION['user_id']);

    $users = $userModel->getAll();

    // Variables pour le header dynamique
    $title = "Administration - EcoRide";
    $specificCss = [
        "/EcoRide/css/bootstrap.min.css",
        "/EcoRide/css/base.css",
        "/EcoRide/css/mediaquerise_base.css"
    ];
    $specificJS = [
        "/EcoRide/js/bootstrap.bundle.min.js",
        "/EcoRide/js/jquery-3.7.1.min.js",
        "https://cdn.jsdelivr.net/npm/chart.js"
    ];

    // Inclusion des morceaux dans l'ordre
    require_once __DIR__ . '/../../includes/header_admin.php';
    require_once __DIR__ . '/../views/admin.view.php';
    require_once __DIR__ . '/../../includes/footer.php';
}

?>
