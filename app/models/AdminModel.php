<?php
class AdminModel {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    /**
     * Récupère le nombre de covoiturages validés/clôturés par jour
     */
    public function getCovoituragesParJour() {
        $sql = "SELECT date_depart AS date_label, COUNT(covoiturage_id) AS total_trajets
                FROM covoiturage
                WHERE statut = 'cloture'
                GROUP BY date_depart
                ORDER BY date_depart ASC";
        
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Récupère les crédits gagnés par la plateforme (2 crédits par trajet clôturé) par jour
     */
    public function getCreditsGagnesParJour() {
        $sql = "SELECT date_depart AS date_label, (COUNT(covoiturage_id) * 2) AS credits_jour
                FROM covoiturage
                WHERE statut = 'cloture'
                GROUP BY date_depart
                ORDER BY date_depart ASC";
        
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Récupère le montant total absolu cumulé par la plateforme
     */
    public function getTotalCreditsAbsolu() {
        $sql = "SELECT (COUNT(covoiturage_id) * 2) AS total_global 
                FROM covoiturage 
                WHERE statut = 'cloture'";
                
        $stmt = $this->pdo->query($sql);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        
        return $result ? (int)$result['total_global'] : 0;
    }
}