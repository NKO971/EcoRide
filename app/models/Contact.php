<?php

class Contact {
    private $db;

    public function __construct($pdo) {
        $this->db = $pdo;
    }

    /**
     * Crée un nouveau message de contact
     */
    public function create($nom, $email, $prenom, $message) {
        $sql = "INSERT INTO contact (nom, email, prenom, message, date_envoi, statut) 
                VALUES (:nom, :email, :prenom, :message, NOW(), 'nouveau')";
        
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            ':nom'     => $nom,
            ':email'   => $email,
            ':prenom'  => $prenom,
            ':message' => $message
        ]);
    }

    /**
     * Récupère tous les messages
     */
    public function getAll() {
        $sql = "SELECT * FROM contact ORDER BY date_envoi DESC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Récupère un message par ID
     */
    public function getById($id) {
        $sql = "SELECT * FROM contact WHERE contact_id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Marquer un message comme traité
     */
    public function markAsRead($id) {
        $sql = "UPDATE contact SET statut = 'traité' WHERE contact_id = :id";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([':id' => $id]);
    }
}

?>
