<?php

class CovoiturageModel {
    private $pdo;

    // Le constructeur reçoit la connexion PDO depuis le contrôleur
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    /**
     * Récupère tous les trajets ouverts avec les détails associés
     */
    public function getTrajetsPourRecherche() {
        // La requête SQL avec jointures pour rassembler toutes les données
        $sql = "SELECT 
                    c.covoiturage_id AS id,
                    c.lieu_depart AS depart,
                    c.lieu_arivee AS arrivee, -- Respect de la typo de ta BDD
                    c.date_depart AS date,
                    c.heure_depart,
                    c.heure_arivee,           -- Respect de la typo de ta BDD
                    c.prix_personne AS prix,
                    c.nb_place AS passagers,
                    u.pseudo AS conducteur,    -- On utilise le pseudo de l'utilisateur
                    v.energie
                FROM covoiturage c
                INNER JOIN utilisateur u ON c.organisateur_id = u.utilisateur_id
                INNER JOIN voiture v ON c.voiture_id = v.voiture_id
                WHERE c.statut = 'ouvert'";

            $params = [];

        // Application dynamique des filtres de la barre principale si remplis
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

        // On ordonne par date et heure les trajets les plus proches
        $sql .= " ORDER BY c.date_depart ASC, c.heure_depart ASC";

        // Exécution sécurisée de la requête avec les paramètres
        $stmt = $this->pdo->query($sql);
        $stmt->execute($params);
        $trajetsRaw = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $trajetsFormates = [];

        // La boucle de traitement pour adapter les données au format attendu par le JS
        foreach ($trajetsRaw as $trajet) {
            
            // CONVERSION HEURE DÉPART (Ex: "06:30:00" -> 390)
            $heuresDepart = explode(':', $trajet['heure_depart']);
            $minutesDepart = ((int)$heuresDepart[0] * 60) + (int)$heuresDepart[1];

            // CONVERSION HEURE ARRIVÉE (Ex: "16:07:00" -> 967)
            $minutesArrivee = null;
            if (!empty($trajet['heure_arivee'])) {
                $heuresArrivee = explode(':', $trajet['heure_arivee']);
                $minutesArrivee = ((int)$heuresArrivee[0] * 60) + (int)$heuresArrivee[1];
            }

            // DÉTERMINATION DU STATUT ÉCOLOGIQUE
            // Si l'énergie est "Électrique", on passe true, sinon false
            $isEcologique = (mb_strtolower($trajet['energie']) === 'électrique') ? true : false;

            // On reconstruit l'objet exactement comme le mockData du JS
            $trajetsFormates[] = [
                'id' => (int)$trajet['id'],
                'conducteur' => $trajet['conducteur'],
                'photo' => null, // Le JS prendra l'image par défaut
                'note' => 4.5,   // On met une note fixe temporaire avant de lier la table avis
                'verifie' => false, // Fixe temporaire
                'depart' => $trajet['depart'],
                'arrivee' => $trajet['arrivee'],
                'heureDepart' => $minutesDepart,
                'heureArrivee' => $minutesArrivee,
                'date' => $trajet['date'],
                'prix' => (int)$trajet['prix'],
                'passagers' => (int)$trajet['passagers'],
                'ecologique' => $isEcologique
            ];
        }

        return $trajetsFormates;
    }
}