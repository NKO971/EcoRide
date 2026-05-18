<?php
// Sécurité : On s'assure que ce fichier n'est pas accessible directement par l'URL
if (!isset($_SESSION['user_id'])) {
    exit('Accès refusé');
}
?>

<!-- Formulaire Trajet -->
  <section id="section_trajet" class="form-trajet">
    <div class="infos-trajet">
        <form id="form-covoiturage" method="post" action="?page=profile">
            <fieldset>
                <legend>Publier un trajet</legend>
                 <!-- Champ caché pour lier le trajet à l'utilisateur connecté -->
                <input type="hidden" id="organisateur_id" name="organisateur_id" value="<?php echo (int)$_SESSION['user_id']; ?>">

                <div class="form-group">
                    <label for="lieu_depart">Ville de départ</label>
                    <input type="text" id="lieu_depart" name="lieu_depart" placeholder="Toulouse" required>
                </div>

                <div class="form-group">
                    <label for="lieu_arrivee">Ville d'arrivée</label>
                    <input type="text" id="lieu_arrivee" name="lieu_arrivee" placeholder="Montpellier" required>
                </div>

                <div class="form-group">
                    <label for="vehicule_id">Véhicule utilisé</label>
                    <select id="vehicule_id" name="vehicule_id" required <?php echo empty($ListeVoitures) ? 'disabled' : ''; ?>>
                        <?php if (empty($ListeVoitures)) : ?>
                            <option value="" disabled selected>⚠️ Veuillez d'abord ajouter un véhicule dans votre garage</option>
                        <?php else : ?>
                            <option value="" disabled selected>Choisir un véhicule...</option>
                            <?php foreach ($ListeVoitures as $voiture) : ?>
                                <option value="<?php echo (int)$voiture['voiture_id']; ?>">
                                    <?php echo htmlspecialchars($voiture['modele']) . " (" . htmlspecialchars($voiture['immatriculation']) . ")"; ?>
                                </option>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </select>
                </div>

                <div class="row">
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="date_depart">Date de départ</label>
                            <input type="date" id="date_depart" name="date_depart" required>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="heure_depart">Heure de départ</label>
                            <input type="time" id="heure_depart" name="heure_depart" required>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-6">
                    <div class="form-group">
                      <label for="heure_arrivee">Heure d'arrivée</label>
                      <input type="time" id="heure_arrivee" name="heure_arrivee" required>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="nb_place">Nombre de places disponibles</label>
                            <input type="number" id="nb_place" name="nb_place" min="1" max="8" placeholder="Nombre de places" required>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="prix_personne">Prix par personne (crédits)</label>
                            <input type="number" id="prix_personne" name="prix_personne" step="0.01" min="0" placeholder="Prix en crédits" required>
                            <p class="commission">EcoRide prélèvera 2 crédits de commission par passager.</p>
                        </div>
                    </div>
                </div>

                <h4>Mes Préférences</h4>
                <div class="preferences-container">
                    <div class="preference-item">
                        <input type="checkbox" id="accepte_fumeurs" name="accepte_fumeurs" value="1">
                        <label for="accepte_fumeurs">Accepter les fumeurs</label>
                    </div>
                    <div class="preference-item">
                        <input type="checkbox" id="accepte_animaux" name="accepte_animaux" value="1">
                        <label for="accepte_animaux">Accepter les animaux</label>
                    </div>
                </div>

                <div class="container-publier">
                    <button type="submit" class="publier-btn" <?php echo empty($ListeVoitures) ? 'disabled' : ''; ?>>Publier</button>
                </div>
            </fieldset>
        </form>
    </div>
</section>