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

    // --- TRAITEMENT DES ACTIONS (Vite et efficace) ---
    $msg = null;
    if (isset($_GET['action']) && isset($_GET['id'])) {
        $id = (int)$_GET['id'];
        if ($_GET['action'] === 'valider_avis') {
            $stmt = $pdo->prepare("UPDATE avis SET statut = 'valide' WHERE avis_id = ?");
            $stmt->execute([$id]);
            $msg = "L'avis a été approuvé avec succès.";
        } elseif ($_GET['action'] === 'refuser_avis') {
            $stmt = $pdo->prepare("UPDATE avis SET statut = 'refuse' WHERE avis_id = ?");
            $stmt->execute([$id]);
            $msg = "L'avis a été refusé.";
        }
    }

    // --- RÉCUPÉRATION DES DONNÉES EN DB ---

    // Avis en attente de modération
    $queryAvis = $pdo->query("
        SELECT a.avis_id, a.commentaire, a.note, a.covoiturage_id,
               u_pass.pseudo AS passager_pseudo,
               u_chauf.pseudo AS chauffeur_pseudo
        FROM avis a
        JOIN utilisateur u_pass ON a.passager_id = u_pass.utilisateur_id
        JOIN utilisateur u_chauf ON a.chauffeur_id = u_chauf.utilisateur_id
        WHERE a.statut = 'en attente' OR a.statut IS NULL
    ");
    $avisEnAttente = $queryAvis->fetchAll(PDO::FETCH_ASSOC);

    // Trajets avec anomalies / incidents
    // Note d'implémentation : s'appuie sur le champ statut = 'incident' de la table covoiturage
    $queryIncidents = $pdo->query("
        SELECT c.covoiturage_id, c.date_depart, c.heure_depart, c.date_arrivee, c.heure_arrivee, c.lieu_depart, c.lieu_arivee,
               u_chauf.pseudo AS chauf_pseudo, u_chauf.email AS chauf_email,
               u_pass.pseudo AS pass_pseudo, u_pass.email AS pass_email
        FROM covoiturage c
        JOIN utilisateur u_chauf ON c.organisateur_id = u_chauf.utilisateur_id
        JOIN reservation r ON c.covoiturage_id = r.covoiturage_id
        JOIN utilisateur u_pass ON r.utilisateur_id = u_pass.utilisateur_id
        WHERE c.statut = 'incident'
    ");
    $trajetsIncidents = $queryIncidents->fetchAll(PDO::FETCH_ASSOC);


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
