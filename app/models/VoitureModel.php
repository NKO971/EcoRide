<?php

class VoitureModel {
    private $db;

    // On injecte la connexion PDO à la création de l'objet 
    public function __construct($pdo) {
        $this->db = $pdo;
    }

    /**
     * Récupère toutes les voitures appartenant à un utilisateur spécifique
     */
    public function getByUtilisateurId($utilisateurId) {
        $sql = "SELECT voiture_id, marque_id, modele, immatriculation, energie, nb_places 
                FROM voiture 
                WHERE utilisateur_id = :utilisateur_id";
                
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['utilisateur_id' => $utilisateurId]);
        
        // On retourne toutes les lignes sous forme de tableau associatif
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}