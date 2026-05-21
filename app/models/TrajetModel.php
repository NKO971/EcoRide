<?php

class TrajetModel {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    /**
     * Insère un nouveau covoiturage dans la base de données
     */
    public function createTrajet($lieu_depart, $lieu_arrivee, $date_depart, $heure_depart, $heure_arrivee, $nb_place, $prix_personne, $vehicule_id, $userId, $accepte_fumeurs = 0, $accepte_animaux = 0) {
        
        // Requête SQL pour insérer un nouveau covoiturage
        $sql = "INSERT INTO covoiturage (
                    date_depart, 
                    heure_depart,
                    heure_arrivee,
                    lieu_depart, 
                    lieu_arivee, 
                    nb_place, 
                    prix_personne, 
                    organisateur_id, 
                    voiture_id,
                    statut,
                    accepte_fumeurs,
                    accepte_animaux
                ) VALUES (
                    :date_depart, 
                    :heure_depart,
                    :heure_arrivee, 
                    :lieu_depart, 
                    :lieu_arivee, 
                    :nb_place, 
                    :prix_personne, 
                    :organisateur_id, 
                    :voiture_id,
                    'ouvert',
                    :accepte_fumeurs,
                    :accepte_animaux
                )";

        $stmt = $this->pdo->prepare($sql);
        
        return $stmt->execute([
            'date_depart'     => $date_depart,
            'heure_depart'    => $heure_depart,
            'heure_arrivee'   => $heure_arrivee,
            'lieu_depart'     => $lieu_depart,
            'lieu_arivee'     => $lieu_arrivee, 
            'nb_place'        => (int)$nb_place,
            'prix_personne'   => (int)$prix_personne,
            'organisateur_id' => (int)$userId,
            'voiture_id'      => (int)$vehicule_id,
            'accepte_fumeurs' => (int)$accepte_fumeurs,
            'accepte_animaux' => (int)$accepte_animaux
        ]);
    }


    /** Gestion des réservations **/
public function getReservationsAvenir($userId) {
    try {
        $stmt = $this->pdo->prepare("
            SELECT c.*, c.lieu_arivee AS lieu_arrivee, r.reservation_id, r.nb_place_reservees, r.STATUT as statut_reservation 
            FROM reservation r
            JOIN covoiturage c ON r.covoiturage_id = c.covoiturage_id
            WHERE r.utilisateur_id = :userId 
              AND c.statut = 'ouvert' 
              AND r.STATUT != 'annule'
            ORDER BY c.date_depart ASC
        ");
        $stmt->execute(['userId' => $userId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        return [];
    }
}

public function getReservationsEnCours($userId) {
    try {
        $stmt = $this->pdo->prepare("
            SELECT c.*, c.lieu_arivee AS lieu_arrivee, r.reservation_id, r.nb_place_reservees, r.STATUT as statut_reservation 
            FROM reservation r
            JOIN covoiturage c ON r.covoiturage_id = c.covoiturage_id
            WHERE r.utilisateur_id = :userId 
              AND c.statut = 'En cours' 
              AND r.STATUT != 'annule'
        ");
        $stmt->execute(['userId' => $userId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        return [];
    }
}

public function getReservationsPasses($userId) {
    try {
        $stmt = $this->pdo->prepare("
            SELECT c.*, c.lieu_arivee AS lieu_arrivee, r.reservation_id, r.nb_place_reservees, r.STATUT as statut_reservation 
            FROM reservation r
            JOIN covoiturage c ON r.covoiturage_id = c.covoiturage_id
            WHERE r.utilisateur_id = :userId 
              AND (c.statut = 'termine' OR c.statut = 'cloture' OR r.STATUT = 'annule')
            ORDER BY c.date_depart DESC
        ");
        $stmt->execute(['userId' => $userId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        return [];
    }
}

    /**
     * Récupère les trajets à venir d'un utilisateur (organisateur) avec détails complets
     */
    public function getTrajetsAvenir($organisateurId) {
    $sql = "SELECT 
                c.covoiturage_id AS id,
                c.covoiturage_id, 
                c.lieu_depart,
                c.lieu_arivee AS lieu_arrivee,
                c.lieu_arivee, 
                c.date_depart,
                c.heure_depart,
                c.heure_arrivee,
                c.nb_place,
                c.prix_personne,
                c.statut,
                c.accepte_fumeurs,
                c.accepte_animaux,
                u.pseudo,
                u.photo,
                m.libelle AS marque,
                v.modele, 
                v.energie,
                CASE WHEN v.energie = 'Électrique' THEN 1 ELSE 0 END AS ecologique
            FROM covoiturage c
            INNER JOIN utilisateur u ON c.organisateur_id = u.utilisateur_id
            INNER JOIN voiture v ON c.voiture_id = v.voiture_id
            INNER JOIN marque m ON v.marque_id = m.marque_id 
            WHERE c.organisateur_id = :organisateur_id 
            AND c.date_depart >= CURDATE()
            AND c.statut = 'ouvert'
            GROUP BY c.covoiturage_id, u.utilisateur_id, v.voiture_id, m.marque_id
            ORDER BY c.date_depart ASC, c.heure_depart ASC";
    
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute([':organisateur_id' => $organisateurId]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Récupère l'historique des trajets (passés ou terminés) d'un utilisateur avec détails complets
     */
    public function getTrajetsPasses($organisateurId) {
    $sql = "SELECT 
                c.covoiturage_id AS id,
                c.covoiturage_id,
                c.lieu_depart,
                c.lieu_arivee AS lieu_arrivee,
                c.lieu_arivee,
                c.date_depart,
                c.heure_depart,
                c.heure_arrivee,
                c.nb_place,
                c.prix_personne,
                c.statut,
                c.accepte_fumeurs,
                c.accepte_animaux,
                u.pseudo,
                u.photo,
                m.libelle AS marque,
                v.modele, 
                v.energie,
                CASE WHEN v.energie = 'Électrique' THEN 1 ELSE 0 END AS ecologique
            FROM covoiturage c
            INNER JOIN utilisateur u ON c.organisateur_id = u.utilisateur_id
            INNER JOIN voiture v ON c.voiture_id = v.voiture_id
            INNER JOIN marque m ON v.marque_id = m.marque_id 
            WHERE c.organisateur_id = :organisateur_id 
            AND (c.date_depart < CURDATE() OR c.statut = 'cloture' OR c.statut = 'annule')
            GROUP BY c.covoiturage_id, u.utilisateur_id, v.voiture_id, m.marque_id
            ORDER BY c.date_depart DESC, c.heure_depart DESC";
    
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute([':organisateur_id' => $organisateurId]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

        /** GESTION DU STATUT DES TRAJETS **/

    /**
     * Passe le trajet du statut 'ouvert' à 'En cours'
     */
    public function demarrerTrajet($covoiturage_id) {
        $sql = "UPDATE covoiturage SET statut = 'En cours' WHERE covoiturage_id = :id AND statut = 'ouvert'";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([':id' => $covoiturage_id]);
    }

    public function getTrajetsEnCours($userId) {
    try {
        $stmt = $this->pdo->prepare("
            SELECT * FROM covoiturage 
            WHERE organisateur_id = :userId AND statut = 'En cours' 
            ORDER BY date_depart ASC, heure_depart ASC
        ");
        $stmt->execute(['userId' => $userId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        return []; // On renvoie un tableau vide en cas d'erreur pour éviter de faire crasher la vue
    }
}

    /**
     * Passe le trajet du statut 'En cours' à 'Terminé'
     */
    public function terminerTrajet($covoiturage_id) {
        $sql = "UPDATE covoiturage SET statut = 'Terminé' WHERE covoiturage_id = :id AND statut = 'En cours'";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([':id' => $covoiturage_id]);
    }
}