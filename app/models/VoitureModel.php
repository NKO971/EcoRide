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
        $sql = "SELECT v.voiture_id, v.marque_id, v.modele, v.immatriculation, v.energie, v.nb_places, m.libelle as marque_libelle
                FROM voiture v
                LEFT JOIN marque m ON v.marque_id = m.marque_id
                WHERE v.utilisateur_id = :utilisateur_id";
                
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['utilisateur_id' => $utilisateurId]);
        
        // On retourne toutes les lignes sous forme de tableau associatif
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    //* Ajoute une nouvelle voiture pour un utilisateur
     
    public function addVoiture($marque_id, $modele, $immatriculation, $date_premiere_immat, $couleur, $energie, $nb_places, $utilisateur_id) {
        $sql = "INSERT INTO voiture (marque_id, modele, immatriculation, date_premiere_immat, couleur, energie, nb_places, utilisateur_id) 
                VALUES (:marque_id, :modele, :immatriculation, :date_premiere_immat, :couleur, :energie, :nb_places, :utilisateur_id)";
        
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            'marque_id'           => $marque_id,
            'modele'              => $modele,
            'immatriculation'     => $immatriculation,
            'date_premiere_immat' => $date_premiere_immat,
            'couleur'             => $couleur,
            'energie'             => $energie,
            'nb_places'           => $nb_places,
            'utilisateur_id'      => $utilisateur_id
        ]);
    }
}