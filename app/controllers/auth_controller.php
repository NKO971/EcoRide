<?php
// On appelle le modèle User pour pouvoir l'utiliser
require_once __DIR__ . '/../models/User.php';

function loginController($pdo) {
    // On vérifie si l'utilisateur a cliqué sur "Se connecter" (formulaire envoyé)
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        
        $email = $_POST['email'];
        $password = $_POST['password'];

        // On crée une instance de notre modèle User
        $userModel = new User($pdo);
        
        // On appelle la méthode login() qu'on a créée dans le Modèle
        $user = $userModel->login($email, $password);

        if ($user) {
            // SUCCÈS : On enregistre les infos en Session
            $_SESSION['user_id'] = $user['utilisateur_id'];
            $_SESSION['pseudo'] = $user['pseudo'];
            $_SESSION['role_id'] = $user['role_id'];

            // REDIRECTION : On envoie l'utilisateur au bon endroit selon son rôle
            if ($user['role_id'] == 1) {
                header('Location: ?page=admin');
            } elseif ($user['role_id'] == 2) {
                header('Location: ?page=employee');
            } else {
                header('Location: ?page=profile');
            }
            exit(); // On arrête le script après une redirection
            
        } else {
            // ÉCHEC : On crée un message d'erreur
            $error = "Email ou mot de passe incorrect.";
        }
    }

    // Variables pour le header dynamique
    $title = "Connexion - EcoRide";
    $specificCss = [
        "/EcoRide/css/bootstrap.min.css",
        "/EcoRide/css/base.css",
        "/EcoRide/css/mediaquerise_base.css",
        "/EcoRide/css/connexion-inscription.css"
    ];
    $specificJS = [
        "/EcoRide/js/bootstrap.bundle.min.js",
        "/EcoRide/js/jquery-3.7.1.min.js",
        "/EcoRide/js/connexion.js"
    ];

    // Inclusion des morceaux dans l'ordre
    require_once __DIR__ . '/../../includes/header.php';
    require_once __DIR__ . '/../views/connexion.view.php';
    require_once __DIR__ . '/../../includes/footer.php';
}

function registerController($pdo) {
    $error = '';
    $success = '';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $pseudo = $_POST['pseudo'] ?? '';
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';
        $password_confirm = $_POST['password_confirm'] ?? '';

        // Validation simple
        if (empty($pseudo) || empty($email) || empty($password) || empty($password_confirm)) {
            $error = "Tous les champs sont obligatoires.";
        } elseif ($password !== $password_confirm) {
            $error = "Les mots de passe ne correspondent pas.";
        } elseif (strlen($password) < 6) {
            $error = "Le mot de passe doit contenir au moins 6 caractères.";
        } else {
            // On crée une instance de notre modèle User
            $userModel = new User($pdo);
            
            // On appelle la méthode register()
            $result = $userModel->register($pseudo, $email, $password);

            if ($result) {
                $success = "Inscription réussie ! Vous pouvez maintenant vous connecter.";
                // Optionnel: redirection automatique après 2 secondes
                //header('Location: index.php?page=connexion');
            } else {
                $error = "Cette adresse email est déjà utilisée ou erreur lors de l'inscription.";
            }
        }
    }

    // Variables pour le header dynamique
    $title = "Inscription - EcoRide";
    $specificCss = [
        "/EcoRide/css/bootstrap.min.css",
        "/EcoRide/css/base.css",
        "/EcoRide/css/mediaquerise_base.css",
        "/EcoRide/css/connexion-inscription.css"
    ];
    $specificJS = [
        "/EcoRide/js/bootstrap.bundle.min.js",
        "/EcoRide/js/jquery-3.7.1.min.js"
    ];

    // Inclusion des morceaux dans l'ordre
    require_once __DIR__ . '/../../includes/header.php';
    require_once __DIR__ . '/../views/inscription.view.php';
    require_once __DIR__ . '/../../includes/footer.php';
}