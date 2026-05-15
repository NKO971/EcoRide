
<body>
    <main>
        <!-- Profil utilisateur -->
        <section class="infos-personnelles">
            <legend>Mes informations de profil</legend>
            <form id="form-profil" method="post">
                <div class="profil row">
                    <!-- Affichage des informations utilisateur -->
                    <div class="row mb-4 border-bottom pb-3">
                        <div class="col-md-6">
                            <span class="text-muted small">Nom :</span> <span class="fw-bold" id="display-nom"><?php echo htmlspecialchars($user['nom'] ?? 'N/A'); ?></span>
                        </div>
                        <div class="col-md-6">
                            <span class="text-muted small">Prénom :</span> <span class="fw-bold" id="display-prenom"><?php echo htmlspecialchars($user['prenom'] ?? 'N/A'); ?></span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="nom">Nom</label>
                            <input type="text" id="nom" name="nom" placeholder="Votre nom" value="<?php echo htmlspecialchars($user['nom'] ?? ''); ?>" required>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="prenom">Prénom</label>
                            <input type="text" id="prenom" name="prenom" placeholder="Votre prénom" value="<?php echo htmlspecialchars($user['prenom'] ?? ''); ?>" required>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" id="email" name="email" placeholder="votre@email.com" value="<?php echo htmlspecialchars($user['email'] ?? ''); ?>" required>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="pseudo">Pseudo</label>
                            <input type="text" id="pseudo" name="pseudo" placeholder="Votre pseudo" value="<?php echo htmlspecialchars($user['pseudo'] ?? ''); ?>" required>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="adresse">Adresse complète</label>
                            <input type="text" id="adresse" name="adresse"
                                placeholder="123 rue de l'écologie, 31000 Toulouse" value="<?php echo htmlspecialchars($user['adresse'] ?? ''); ?>">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="date_naissance">Date de naissance</label>
                            <input type="date" id="date_naissance" name="date_naissance" value="<?php echo htmlspecialchars($user['date_naissance'] ?? ''); ?>">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="telephone">Téléphone</label>
                            <input type="tel" id="telephone" name="telephone" placeholder="06 00 00 00 00" value="<?php echo htmlspecialchars($user['telephone'] ?? ''); ?>"
                                pattern="[0-9]{10}">
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="photo_profil">Photo de profil</label>
                            <input type="file" id="photo_profil" name="photo_profil" accept="image/*">
                        </div>
                    </div>
                </div>

                <div class="actions-formulaire">
                    <button type="submit" class="btn-sauvegarde-profil">
                        Enregistrer mon profil
                    </button>
                </div>
            </form>
        </section>
        <!-- Fin du profil utilisateur -->

        <!-- Choix du rôle -->
        <section class="choix-role">
            <legend>Mon statut sur la plateforme</legend>
            <p class="role-instruction">Je choisis mon rôle sur EcoRide :</p>

            <div class="roles d-flex">
                <div class="form-check role-card">
                    <input class="form-check-input" type="radio" name="role_preference" id="passager" value="passager"
                        checked>
                    <label class="form-check-label" for="passager">
                        <strong>Passager</strong><br>
                        <small>Je cherche des trajets</small>
                    </label>
                </div>

                <div class="form-check role-card">
                    <input class="form-check-input" type="radio" name="role_preference" id="chauffeur"
                        value="chauffeur">
                    <label class="form-check-label" for="chauffeur">
                        <strong>Chauffeur</strong><br>
                        <small>Je propose mes services</small>
                    </label>
                </div>

                <div class="form-check role-card">
                    <input class="form-check-input" type="radio" name="role_preference" id="les_deux" value="les_deux">
                    <label class="form-check-label" for="les_deux">
                        <strong>Les deux</strong><br>
                        <small>Je voyage et je conduis</small>
                    </label>
                </div>
            </div>
        </section>
        <!-- Fin du choix du rôle -->

        <div class="conteneur-chauffeur-flex">
            <!-- Formulaire véhicule -->
            <section id="section_vehicule">
                <fieldset class="infos-vehicule">
                    <legend>Mon Véhicule</legend>
                    <form id="form-vehicule" method="post">
                        <input type="hidden" id="utilisateur_id_voiture" name="utilisateur_id_voiture">
                        
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
                                    <input type="text" id="modele" name="modele" placeholder="Ex: Clio 3"
                                        required>
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
                                    <label for="type_energie">Type d'énergie</label>
                                    <select id="type_energie" name="type_energie" required>
                                        <option value="" selected disabled>Choisir l'énergie...</option>
                                        <option value="1">Électrique</option>
                                        <option value="2">Essence</option>
                                        <option value="3">Diesel</option>
                                        <option value="4">Hybride</option>
                                        <option value="5">GPL</option>
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
                                <button type="submit" class="enregistrer-btn">Enregistrer le véhicule</button>
                            </div>
                        </div>
                    </form>
                </fieldset>
                <button type="button" class="btn btn-outline-primary">+ Ajouter un autre véhicule</button>
            </section>

            <!-- Formulaire Trajet -->
            <section id="section_trajet" class="form-trajet">
                <div class="infos-trajet">
                    <form id="form-covoiturage" method="post">
                        <fieldset>
                            <legend>Publier un trajet</legend>

                            <!-- Champ caché pour lier le trajet à l'utilisateur connecté -->
                            <input type="hidden" id="organisateur_id" name="organisateur_id" value="">

                            <div class="form-group">
                                <label for="lieu_depart">Ville de départ</label>
                                <input type="text" id="lieu_depart" name="lieu_depart" placeholder="Toulouse" required>
                            </div>

                            <div class="form-group">
                                <label for="lieu_arrivee">Ville d'arrivée</label>
                                <input type="text" id="lieu_arrivee" name="lieu_arrivee" placeholder="Montpellier"
                                    required>
                            </div>

                            <div class="form-group">
                                <label for="vehicule_id">Véhicule utilisé</label>
                                <select id="vehicule_id" name="vehicule_id" required>
                                    <option value="" disabled selected>Choisir un véhicule...</option>
                                    <option value="1">Ma Renault Clio (AA-123-BB)</option>
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

                            <div class="row">
                                <div class="col-12 col-md-6">
                                    <div class="form-group">
                                        <label for="nb_place">Nombre de places disponibles</label>
                                        <input type="number" id="nb_place" name="nb_place" min="1" max="8"
                                            placeholder="Nombre de places" required>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="form-group">
                                        <label for="prix_personne">Prix par personne (crédits)</label>
                                        <input type="number" id="prix_personne" name="prix_personne" step="0.01" min="0"
                                            placeholder="Prix en crédits" required>
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
                                <button type="submit" class="publier-btn">Publier</button>
                            </div>
                        </fieldset>
                    </form>
                </div>
            </section>
        </div>

        <!-- Historique des trajets -->
        <section class="historique">
            <div class="card shadow-sm">
                <div class="card-body p-0">
                    <div class="px-4 py-3 bg-light border-bottom">
                        <ul class="nav nav-pills gap-3" id="historique-tab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button
                                    class="nav-link active small fw-bold text-uppercase border-0 p-0 bg-transparent text-primary"
                                    id="tab-avenir" data-bs-toggle="pill" data-bs-target="#liste-avenir" type="button"
                                    role="tab">
                                    À venir
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button
                                    class="nav-link small fw-bold text-uppercase border-0 p-0 bg-transparent text-muted opacity-50"
                                    id="tab-historique" data-bs-toggle="pill" data-bs-target="#liste-historique"
                                    type="button" role="tab">
                                    Historique
                                </button>
                            </li>
                        </ul>
                    </div>

                    <div class="tab-content" id="historique-tabContent">
                        <div class="tab-pane fade show active" id="liste-avenir" role="tabpanel">
                            <div class="list-group list-group-flush">
                                <!-- Les trajets à venir seront affichés ici dynamiquement -->
                            </div>
                        </div>

                        <div class="tab-pane fade" id="liste-historique" role="tabpanel">
                            <div class="list-group list-group-flush">
                                <!-- L'historique des trajets sera affichés ici dynamiquement -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
</body>

</html>
