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
    
    // Requête SQL alignée à 100% sur ton fichier ecoride_db.sql
    // Note l'écriture "lieu_arivee" avec un seul 'r' et "organisateur_id" des fautes de frape que j'ai conservé pour éviter les erreurs de base de données
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
                statut
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
                'En cours'
            )";

    $stmt = $this->pdo->prepare($sql);
    
    return $stmt->execute([
        'date_depart'     => $date_depart,
        'heure_depart'    => $heure_depart,
        'heure_arrivee'   => $heure_arrivee,
        'lieu_depart'     => $lieu_depart,
        'lieu_arivee'     => $lieu_arrivee, // Associe ta variable au champ réel (avec un seul r)
        'nb_place'        => (int)$nb_place,
        'prix_personne'   => (int)$prix_personne,
        'organisateur_id' => (int)$userId,
        'voiture_id'      => (int)$vehicule_id
    ]);
}

    /**
     * Récupère les trajets à venir d'un utilisateur (organisateur)
     */
    public function getTrajetsAvenir($organisateurId) {
        $sql = "SELECT * FROM covoiturage 
                WHERE organisateur_id = :organisateur_id 
                AND date_depart >= CURDATE()
                AND statut = 'En cours'
                ORDER BY date_depart ASC, heure_depart ASC";
        
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':organisateur_id' => $organisateurId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Récupère l'historique des trajets (passés ou terminés) d'un utilisateur
     */
    public function getTrajetsPasses($organisateurId) {
        $sql = "SELECT * FROM covoiturage 
                WHERE organisateur_id = :organisateur_id 
                AND (date_depart < CURDATE() OR statut = 'Terminé')
                ORDER BY date_depart DESC, heure_depart DESC";
        
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':organisateur_id' => $organisateurId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}