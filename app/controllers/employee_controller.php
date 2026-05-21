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

    // Chargement de la configuration MongoDB
    require_once __DIR__ . '/../config/DatabaseMongo.php';
    $manager = DatabaseMongo::getManager();
    $dbName = DatabaseMongo::getDatabaseName();
    $namespace = $dbName . ".avis";

    // --- TRAITEMENT DES ACTIONS (Bascule en NoSQL MongoDB) ---
    $msg = null;
    if (isset($_GET['action']) && isset($_GET['id'])) {
        $idAvisString = $_GET['id'];
        $action = $_GET['action'];

        if ($action === 'valider_avis' || $action === 'refuser_avis') {
            try {
                $nouveauStatut = ($action === 'valider_avis') ? 'valide' : 'refuse';
                $bulk = new MongoDB\Driver\BulkWrite();
                $bulk->update(
                    ['_id' => new MongoDB\BSON\ObjectId($idAvisString)],
                    ['$set' => ['statut' => $nouveauStatut]]
                );

                $resultat = $manager->executeBulkWrite($namespace, $bulk);

                if ($resultat->getModifiedCount() > 0) {
                    $msg = $action === 'valider_avis' ? "L'avis a été approuvé avec succès." : "L'avis a été refusé.";
                }
            } catch (Exception $e) {
                $msg = "Erreur de modération NoSQL : " . $e->getMessage();
            }
        }
    }

    // --- RÉCUPÉRATION DES DONNÉES ---

    // Récupération des avis en attente depuis MongoDB

    $avisEnAttente = [];
    try {
        
        $filter = [
            '$or' => [
                ['statut' => 'en attente'],
                ['statut' => ['$exists' => false]]
            ]
        ];
        
        $query = new MongoDB\Driver\Query($filter, []);
        $cursor = $manager->executeQuery($namespace, $query);
        
        foreach ($cursor as $document) {
            $avisData = (array)$document;
            $avisData['avis_id'] = (string)$document->_id; // ID MongoDB converti en chaîne pour tes boutons

            // --- PONT SQL : Récupération du pseudo du PASSAGER ---
            $passagerId = $avisData['passager_id'] ?? null;
            $passagerPseudo = "Anonyme";
            
            if ($passagerId) {
                $stmtPassager = $pdo->prepare("SELECT pseudo FROM utilisateur WHERE utilisateur_id = ?");
                $stmtPassager->execute([$passagerId]);
                $resPassager = $stmtPassager->fetch(PDO::FETCH_ASSOC);
                if ($resPassager) {
                    $passagerPseudo = $resPassager['pseudo'];
                }
            }
            $avisData['passager_pseudo'] = $passagerPseudo; 
            $chauffeurId = $avisData['chauffeur_id'] ?? null;
            $chauffeurPseudo = "Anonyme";
            
            if ($chauffeurId) {
                $stmtChauffeur = $pdo->prepare("SELECT pseudo FROM utilisateur WHERE utilisateur_id = ?");
                $stmtChauffeur->execute([$chauffeurId]);
                $resChauffeur = $stmtChauffeur->fetch(PDO::FETCH_ASSOC);
                if ($resChauffeur) {
                    $chauffeurPseudo = $resChauffeur['pseudo'];
                }
            }
            $avisData['chauffeur_pseudo'] = $chauffeurPseudo;

            $avisEnAttente[] = $avisData;
        }

    } catch (MongoDB\Driver\Exception\Exception $e) {
        $msg = "Impossible de récupérer les avis sur MongoDB Atlas : " . $e->getMessage();
    }


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
