<?php

function profileController($pdo) {
    // Vérifier que l'utilisateur est connecté
    if (!isset($_SESSION['user_id'])) {
        header("Location: ?page=connexion");
        exit();
    }

    require_once __DIR__ . '/../models/User.php';
    require_once __DIR__ . '/../models/VoitureModel.php';
    // Instanciation des modèles avec la connexion PDO
    $userModel = new User($pdo);
    $voitureModel = new VoitureModel($pdo);  

    $error = '';
    $success = '';

    // Traitement du formulaire si POST
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $pseudo = $_POST['pseudo'] ?? '';
        $email = $_POST['email'] ?? '';
        $nom = $_POST['nom'] ?? '';
        $prenom = $_POST['prenom'] ?? '';
        $adresse = $_POST['adresse'] ?? '';
        $date_naissance = $_POST['date_naissance'] ?? '';
        $telephone = $_POST['telephone'] ?? '';

        // Validation simple
        if (empty($pseudo) || empty($email)) {
            $error = "Le pseudo et l'email sont obligatoires.";
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error = "L'adresse email n'est pas valide.";
        } else {
            // Mettre à jour le profil
            $result = $userModel->updateProfile($_SESSION['user_id'], $pseudo, $email, $nom, $prenom, $adresse, $date_naissance, $telephone);
            
            if ($result) {
                $_SESSION['pseudo'] = $pseudo;
                $success = "Votre profil a été mis à jour avec succès !";
            } else {
                $error = "Erreur lors de la mise à jour du profil.";
            }
        }
    }

    // Récupérer les infos de l'utilisateur
    $user = $userModel->getById($_SESSION['user_id']);
    // Récupérer les voitures de l'utilisateur
    $Listevoitures = $voitureModel->getByUtilisateurId($_SESSION['user_id']);

    // Variables pour le header dynamique
    $title = "Mon Profil - EcoRide";
    $specificCss = [
        "/EcoRide/css/bootstrap.min.css",
        "/EcoRide/css/base.css",
        "/EcoRide/css/mediaquerise_base.css",
        "/EcoRide/css/espace_utilisateur.css"
    ];
    $specificJS = [
        "/EcoRide/js/bootstrap.bundle.min.js",
        "/EcoRide/js/jquery-3.7.1.min.js",
        "/EcoRide/js/EspaceUtilisateur.js"
    ];

    // Inclusion des morceaux dans l'ordre
    require_once __DIR__ . '/../../includes/header.php';
    require_once __DIR__ . '/../views/profile.view.php';
    require_once __DIR__ . '/../../includes/footer.php';
}

?>
