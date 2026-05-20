<?php

function profileController($pdo) {
    // Vérifier que l'utilisateur est connecté
    if (!isset($_SESSION['user_id'])) {
        header("Location: ?page=connexion");
        exit();
    }

    require_once __DIR__ . '/../models/User.php';
    require_once __DIR__ . '/../models/VoitureModel.php';
    require_once __DIR__ . '/../models/TrajetModel.php';
    
    // Instanciation des modèles avec la connexion PDO
    $userModel = new User($pdo);
    $voitureModel = new VoitureModel($pdo);
    $trajetModel = new TrajetModel($pdo);

// =========================================================================
    // TRAITEMENT DES ACTIONS DE TRAJET (Démarrer / En cours/ Terminer)
    // =========================================================================
    $action = isset($_GET['action']) ? $_GET['action'] : null;
    
    if ($action === 'demarrer-trajet' || $action === 'terminer-trajet') {
        $idTrajet = isset($_GET['id']) ? (int)$_GET['id'] : null;
        
        if ($idTrajet) {
            if ($action === 'demarrer-trajet') {
                // IMPORTANT : On utilise bien $trajetModel défini juste au-dessus
                $trajetModel->demarrerTrajet($idTrajet); 
            } elseif ($action === 'terminer-trajet') {
                $trajetModel->terminerTrajet($idTrajet);
            }
        }
        
        // Redirection vers le profil pour rafraîchir la page proprement
        header("Location: ?page=profile");
        exit();
    }

    $userId = (int)$_SESSION['user_id']; // Sécurité : s'assurer que c'est un entier

    // =========================================================================
    // INTERCEPTEUR ASYNCHRONE : Mise à jour immédiate du rôle (Requête AJAX/Fetch)
    // =========================================================================
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'update_role_preference') {
        // Supprime les en-têtes potentiels pour garantir un JSON strict et propre
        header('Content-Type: application/json');
        
        $nouvellePreference = filter_input(INPUT_POST, 'role_preference', FILTER_SANITIZE_SPECIAL_CHARS);

        // Validation des valeurs attendues en base de données
        if (!in_array($nouvellePreference, ['passager', 'chauffeur', 'les_deux'])) {
            echo json_encode(['success' => false, 'message' => 'Données de rôle invalides.']);
            exit();
        }

        try {
            // Note : Idéalement, ajoute une méthode updateRolePreference dans ton modèle User.php
            // Si elle n'existe pas, cette requête préparée directe fera parfaitement le travail.
            $stmt = $pdo->prepare("UPDATE utilisateur SET role_preference = :role_preference WHERE utilisateur_id = :utilisateur_id");
            $result = $stmt->execute([
                'role_preference' => $nouvellePreference,
                'utilisateur_id' => $userId
            ]);

            if ($result) {
                // Important : On met à jour la session pour que PHP s'en souvienne instantanément au rafraîchissement
                $_SESSION['role_preference'] = $nouvellePreference;
                echo json_encode(['success' => true]);
            } else {
                echo json_encode(['success' => false, 'message' => 'Échec de l\'enregistrement en base de données.']);
            }
        } catch (PDOException $e) {
            echo json_encode(['success' => false, 'message' => 'Erreur SQL : ' . $e->getMessage()]);
        }
        // Blocage crucial : Empêche absolument le reste de la page et le HTML de s'exécuter
        exit(); 
    }

    $error = '';
    $success = '';
    
    // Intercepter le message de succès suite à la redirection du véhicule
    if (isset($_GET['success']) && $_GET['success'] == 1) {
        $success = "Votre véhicule a été ajouté avec succès à votre garage !";
    }

    // Récupération des informations fraîches de l'utilisateur
    $user = $userModel->getById($userId);

    // Traitement du formulaire si POST classique
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        
        // ==========================================
        // FORMULAIRE 1 : Modification de PROFIL
        // ==========================================
        if (isset($_POST['pseudo'])) {
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
                $result = $userModel->updateProfile($userId, $pseudo, $email, $nom, $prenom, $adresse, $date_naissance, $telephone);
                
                if ($result) {
                    $_SESSION['pseudo'] = $pseudo;
                    $success = "Votre profil a été mis à jour avec succès !";
                    $user = $userModel->getById($userId); // Recharger l'utilisateur mis à jour
                } else {
                    $error = "Erreur lors de la mise à jour du profil.";
                }
            }
        }
        
        // ==========================================
        // FORMULAIRE 2 : Ajout de VÉHICULE
        // ==========================================
        elseif (isset($_POST['immatriculation'])) {
            // Lecture dynamique depuis la base de données mise à jour par le Fetch
            $statutUtilisateur = $user['role_preference'] ?? '';

            if ($statutUtilisateur !== 'chauffeur' && $statutUtilisateur !== 'les_deux') {
                $error = "Action non autorisée : Votre compte n'est pas configuré comme Chauffeur. (Statut actuel : '" . htmlspecialchars($statutUtilisateur) . "')";
            } else {
                $marque_id = $_POST['marque_id'] ?? null;
                $modele = $_POST['modele'] ?? '';
                $immatriculation = $_POST['immatriculation'] ?? '';
                $date_premiere_immat = $_POST['date_premiere_immat'] ?? '';
                $couleur = $_POST['couleur'] ?? null;
                $energie = $_POST['energie'] ?? '';
                $nb_places = $_POST['nb_places'] ?? null;

                if (empty($marque_id) || empty($modele) || empty($immatriculation) || empty($date_premiere_immat) || empty($energie) || empty($nb_places)) {
                    $error = "Veuillez remplir tous les champs obligatoires pour le véhicule.";
                } else {
                    try {
                        $result = $voitureModel->addVoiture($marque_id, $modele, $immatriculation, $date_premiere_immat, $couleur, $energie, $nb_places, $userId);
                        
                        if ($result) {
                            // POST-Redirect-GET : Empêche le renvoi du formulaire au rafraîchissement
                            header("Location: ?page=profile&success=1");
                            exit();
                        } else {
                            $error = "Erreur lors de l'enregistrement du véhicule.";
                        }
                    } catch (PDOException $e) {
                        $error = "Erreur de base de données : " . $e->getMessage();
                    }
                }
            }
        }
        
        // ==========================================
        // FORMULAIRE 3 : Publication de TRAJET
        // ==========================================
        elseif (isset($_POST['lieu_depart'])) {
            $lieu_depart     = $_POST['lieu_depart'] ?? '';
            $lieu_arrivee    = $_POST['lieu_arrivee'] ?? '';
            $vehicule_id     = $_POST['vehicule_id'] ?? null;
            $date_depart     = $_POST['date_depart'] ?? '';
            $heure_depart    = $_POST['heure_depart'] ?? '';
            $heure_arrivee    = $_POST['heure_arrivee'] ?? '';
            $nb_place        = $_POST['nb_place'] ?? null;
            $prix_personne   = $_POST['prix_personne'] ?? null;
            
            $accepte_fumeurs = isset($_POST['accepte_fumeurs']) ? 1 : 0;
            $accepte_animaux = isset($_POST['accepte_animaux']) ? 1 : 0;

            if (empty($lieu_depart) || empty($lieu_arrivee) || empty($vehicule_id) || empty($date_depart) || empty($heure_depart) || empty($heure_arrivee) || empty($nb_place) || empty($prix_personne)) {
                $error = "Veuillez remplir tous les champs obligatoires pour publier le trajet.";
            } else {
                $result = $trajetModel->createTrajet(
                    $lieu_depart, 
                    $lieu_arrivee, 
                    $date_depart, 
                    $heure_depart,
                    $heure_arrivee, 
                    $nb_place, 
                    $prix_personne, 
                    $vehicule_id, 
                    $userId, 
                    $accepte_fumeurs, 
                    $accepte_animaux
                );
                
                if ($result) {
                    $success = "Votre trajet a été publié avec succès sur EcoRide !";
                } else {
                    $error = "Erreur lors de la publication du trajet.";
                }
            }
        }
    } // Fin du bloc POST
    
    // Récupérer les données fraîches pour l'affichage des listes
    $ListeVoitures = $voitureModel->getByUtilisateurId($userId);
    $trajetsAvenir = $trajetModel->getTrajetsAvenir($userId);
    $trajetsEnCours = $trajetModel->getTrajetsEnCours($userId);
    $trajetsPasses = $trajetModel->getTrajetsPasses($userId);


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