<?php

function contactController($pdo) {
    $error = '';
    $success = '';

    // Traitement du formulaire si POST
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $nom = $_POST['nom'] ?? '';
        $prenom = $_POST['prenom'] ?? '';
        $email = $_POST['email'] ?? '';
        $message = $_POST['message'] ?? '';

        // Validation
        if (empty($nom) || empty($prenom) || empty($email) || empty($message)) {
            $error = "Tous les champs sont obligatoires.";
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error = "L'adresse email n'est pas valide.";
        } else {
            // Créer une instance du modèle Contact
            require_once __DIR__ . '/../models/Contact.php';
            $contactModel = new Contact($pdo);
            
            // Envoyer le message
            $result = $contactModel->create($nom, $prenom, $email, $message);

            if ($result) {
                $success = "Votre message a été envoyé avec succès ! Nous vous répondrons bientôt.";
            } else {
                $error = "Erreur lors de l'envoi du message. Veuillez réessayer.";
            }
        }
    }

    // Variables pour le header dynamique
    $title = "Contact - EcoRide";
    $specificCss = [
        "/EcoRide/css/bootstrap.min.css",
        "/EcoRide/css/base.css",
        "/EcoRide/css/mediaquerise_base.css",
        "/EcoRide/css/contact.css"
    ];
    $specificJS = [
        "/EcoRide/js/bootstrap.bundle.min.js",
        "/EcoRide/js/jquery-3.7.1.min.js"
    ];

    // Inclusion des morceaux dans l'ordre
    require_once __DIR__ . '/../../includes/header.php';
    require_once __DIR__ . '/../views/contact.view.php';
    require_once __DIR__ . '/../../includes/footer.php';
}

?>
