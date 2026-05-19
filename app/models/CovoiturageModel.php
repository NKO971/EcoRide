<?php

class CovoiturageModel {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    /**
     * Récupère tous les trajets ouverts avec les détails associés (Dynamique)
     */
    public function getTrajetsPourRecherche($depart = null, $arrivee = null, $date = null) {
        // Requête SQL corrigée avec calcul de la note moyenne et récupération des préférences
        $sql = "SELECT 
                    c.covoiturage_id AS id,
                    c.lieu_depart AS depart,
                    c.lieu_arivee AS arrivee, 
                    c.date_depart AS date,
                    c.heure_depart,
                    c.heure_arrivee,           
                    c.prix_personne AS prix,
                    c.nb_place AS passagers,
                    c.accepte_fumeurs,
                    c.accepte_animaux,
                    u.pseudo AS conducteur,    
                    u.photo,
                    v.energie,
                    m.libelle AS marque,
                    v.modele,
                    IFNULL(ROUND(AVG(CAST(a.note AS DECIMAL(10,2))), 1), 'N/A') AS note_moyenne
                FROM covoiturage c
                INNER JOIN utilisateur u ON c.organisateur_id = u.utilisateur_id
                INNER JOIN voiture v ON c.voiture_id = v.voiture_id
                INNER JOIN marque m ON v.marque_id = m.marque_id
                LEFT JOIN avis a ON u.utilisateur_id = a.chauffeur_id
                WHERE c.statut = 'ouvert'";

        $params = [];

        if (!empty($depart)) {
            $sql .= " AND c.lieu_depart LIKE :depart";
            $params[':depart'] = '%' . $depart . '%';
        }
        if (!empty($arrivee)) {
            $sql .= " AND c.lieu_arivee LIKE :arrivee";
            $params[':arrivee'] = '%' . $arrivee . '%';
        }
        if (!empty($date)) {
            $sql .= " AND DATE(c.date_depart) = :date_depart";
            $params[':date_depart'] = $date;
        }

        // Regroupement obligatoire à cause de la fonction d'agrégation AVG
        $sql .= " GROUP BY c.covoiturage_id, u.utilisateur_id, v.voiture_id, m.marque_id";
        $sql .= " ORDER BY c.date_depart ASC, c.heure_depart ASC";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($params);
        $trajetsRaw = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $trajetsFormates = [];

        foreach ($trajetsRaw as $trajet) {
            
            // CONVERSION HEURE DÉPART
            $heuresDepart = explode(':', $trajet['heure_depart']);
            $minutesDepart = ((int)$heuresDepart[0] * 60) + (int)$heuresDepart[1];

            // CONVERSION HEURE ARRIVÉE
            $minutesArrivee = null;
            if (!empty($trajet['heure_arrivee'])) {
                $heuresArrivee = explode(':', $trajet['heure_arrivee']);
                $minutesArrivee = ((int)$heuresArrivee[0] * 60) + (int)$heuresArrivee[1];
            }

            // DÉTERMINATION DU STATUT ÉCOLOGIQUE
            $isEcologique = (mb_strtolower($trajet['energie']) === 'électrique') ? true : false;

            // Reconstruction de l'objet avec inclusion des vraies valeurs dynamiques
            $trajetsFormates[] = [
                'id' => (int)$trajet['id'],
                'conducteur' => $trajet['conducteur'],
                'photo' => $trajet['photo'], 
                'note' => $trajet['note_moyenne'], // Dynamique ! Reçoit la note BDD ou 'N/A'
                'note_chauffeur' => $trajet['note_moyenne'], // Alternative de sécurité pour l'HTML
                'verifie' => false, 
                'depart' => $trajet['depart'],
                'arrivee' => $trajet['arrivee'],
                'heureDepart' => $minutesDepart,
                'heureArrivee' => $minutesArrivee,
                'date' => $trajet['date'],
                'prix' => (int)$trajet['prix'],
                'passagers' => (int)$trajet['passagers'],
                'ecologique' => $isEcologique,
                // Ajout des préférences indispensables pour la modal
                'accepte_fumeurs' => (int)$trajet['accepte_fumeurs'],
                'accepte_animaux' => (int)$trajet['accepte_animaux'],
                // Ajout des détails véhicules indispensables pour le côté droit de la modal
                'marque' => $trajet['marque'],
                'modele' => $trajet['modele'],
                'energie' => $trajet['energie']
            ];
        }

        return $trajetsFormates;
    }
}