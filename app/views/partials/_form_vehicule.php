<?php
// Sécurité : On s'assure que ce fichier n'est pas accessible directement par l'URL
if (!isset($_SESSION['user_id'])) {
    exit('Accès refusé');
}
?>

<section id="section_vehicule">
    <div class="mes-vehicules-liste mb-4">
        <h5 class="text-primary mb-3">Mon Garage</h5>
        <?php if (empty($ListeVoitures)): ?>
            <p class="text-muted small italic">Vous n'avez pas encore enregistré de véhicule.</p>
        <?php else: ?>
            <div class="row g-2">
                <?php foreach ($ListeVoitures as $voiture): ?>
                    <div class="col-12 col-md-6">
                        <div class="card p-2 shadow-sm border-light-subtle">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <strong class="text-dark"><?= htmlspecialchars($voiture['marque_libelle'] ?? 'Véhicule') ?></strong> 
                                    <span class="text-secondary small"><?= htmlspecialchars($voiture['modele']) ?></span>
                                    <br>
                                    <small class="text-muted font-monospace">Immat : <?= htmlspecialchars($voiture['immatriculation']) ?></small>
                                </div>
                                <span class="badge bg-success-subtle text-success rounded-pill px-2 py-1 small">
                                    <?= htmlspecialchars($voiture['nb_places']) ?> places
                                </span>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
    
    <hr class="my-4">
    <fieldset class="infos-vehicule">
        <legend>Mon Véhicule</legend>
        <form id="form-vehicule" method="post" action="?page=profile">
            <input type="hidden" id="utilisateur_id_voiture" name="utilisateur_id_voiture" value="<?php echo (int)$_SESSION['user_id']; ?>">
            
            <div class="row">
                <div class="col-12 col-md-6">
                    <div class="form-group">
                        <label for="marque_id">Marque</label>
                        <select id="marque_id" name="marque_id" required>
                            <option value="" disabled selected>Choisir une marque...</option>
                            <option value="1">Renault</option>
                            <option value="2">Peugeot</option>
                            <option value="3">Citroën</option>
                            <option value="4">Toyota</option>
                            <option value="5">Volkswagen</option>
                            <option value="6">BMW</option>
                        </select>
                    </div>
                </div>

                <div class="col-12 col-md-6">
                    <div class="form-group">
                        <label for="modele">Modèle du véhicule</label>
                        <input type="text" id="modele" name="modele" placeholder="Ex: Clio 3" required>
                    </div>
                </div>

                <div class="col-12 col-md-6">
                    <div class="form-group">
                        <label for="immatriculation">Immatriculation</label>
                        <input type="text" id="immatriculation" name="immatriculation" placeholder="AA-123-BB"
                            pattern="[A-Z]{2}-[0-9]{3}-[A-Z]{2}" required>
                    </div>
                </div>

                <div class="col-12 col-md-6">
                    <div class="form-group">
                        <label for="date_premiere_immat">1ère immatriculation</label>
                        <input type="date" id="date_premiere_immat" name="date_premiere_immat" required>
                    </div>
                </div>

                <div class="col-12 col-md-6">
                    <div class="form-group">
                        <label for="couleur">Couleur</label>
                        <input type="text" id="couleur" name="couleur" placeholder="Ex: Gris Anthracite">
                    </div>
                </div>

                <div class="col-12 col-md-6">
                  <div class="form-group">
                    <label for="energie">Type d'énergie</label>
                    <select id="energie" name="energie" required>
                        <option value="" selected disabled>Choisir l'énergie...</option>
                        <option value="Électrique">Électrique</option>
                        <option value="Essence">Essence</option>
                        <option value="Diesel">Diesel</option>
                        <option value="Hybride">Hybride</option>
                        <option value="GPL">GPL</option>
                    </select>
                  </div>
                </div>

                <div class="col-12 col-md-6">
                    <div class="form-group">
                        <label for="nb_places">Nombre de places</label>
                        <input type="number" id="nb_places" name="nb_places" min="2" max="9"
                            placeholder="Ex: 5" required>
                    </div>
                </div>

                <div class="col-12 container-btn-vehicule">
                    <button type="submit" name="submit_voiture" class="enregistrer-btn">Enregistrer le véhicule</button>
                </div>
            </div>
        </form>
    </fieldset>
    <button type="button" class="btn btn-outline-primary">+ Ajouter un autre véhicule</button>
</section>