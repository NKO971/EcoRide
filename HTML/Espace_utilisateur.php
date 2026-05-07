<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EcoRide - Espace utilisateur</title>
    <link rel="stylesheet" href="/EcoRide/css/bootstrap.min.css">
    <link rel="stylesheet" href="/EcoRide/css/base.css">
    <link rel="stylesheet" href="/EcoRide/css/mediaquerise_base.css">
    <link rel="stylesheet" href="/EcoRide/css/espace_utilisateur.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet">
    <!-- Je récupère des icons sur google front -->
    <script src="/EcoRide/js/bootstrap.bundle.min.js" defer></script>
    <script src="/EcoRide/js/jquery-3.7.1.min.js" defer></script>


</head>

<?php include '../includes/header.php'; ?>

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
                            <span class="text-muted small">Nom :</span> <span class="fw-bold" id="display-nom">DUCHAMP</span>
                        </div>
                        <div class="col-md-6">
                            <span class="text-muted small">Prénom :</span> <span class="fw-bold" id="display-prenom">Jean</span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="nom">Nom</label>
                            <input type="text" id="nom" name="nom" placeholder="Votre nom" required>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="prenom">Prénom</label>
                            <input type="text" id="prenom" name="prenom" placeholder="Votre prénom" required>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" id="email" name="email" placeholder="votre@email.com" required>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="pseudo">Pseudo</label>
                            <input type="text" id="pseudo" name="pseudo" placeholder="Votre pseudo" required>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="adresse">Adresse complète</label>
                            <input type="text" id="adresse" name="adresse"
                                placeholder="123 rue de l'Écologie, 31000 Toulouse">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="date_naissance">Date de naissance</label>
                            <input type="date" id="date_naissance" name="date_naissance">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="telephone">Téléphone</label>
                            <input type="tel" id="telephone" name="telephone" placeholder="06 00 00 00 00"
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

                                <div class="list-group-item p-4 border-0 border-bottom trajet-hover" data-covoiturage-id="101" data-reservation-id="1">
                                    <div class="row align-items-center">
                                        <div class="col-md-6">
                                            <div class="mb-2">
                                                <span
                                                    class="badge bg-info-subtle text-info border border-info-subtle small">Passager</span>
                                            </div>
                                            <div class="d-flex align-items-center mb-1">
                                                <span class="lieux h5 mb-0 fw-bold" data-lieu-depart>Paris</span>
                                                <i class="bi bi-arrow-right mx-2 text-muted"></i>
                                                <span class="lieux h5 mb-0 fw-bold" data-lieu-arrivee>Lyon</span>
                                            </div>
                                            <div class="text-muted small"><span data-date-depart>12 Mars</span> • <span data-heure-depart>08:30</span> • Chauffeur :
                                                <strong data-organisateur-pseudo>Marc</strong>
                                            </div>
                                        </div>
                                        <div class="col-md-3 text-md-center">
                                            <span
                                                class="badge rounded-pill bg-success-subtle text-success border border-success-subtle px-3 py-2" data-statut>Confirmé</span>
                                        </div>
                                        <div class="col-md-3 text-md-end">
                                            <div class="fw-bold mb-1"><span data-prix-personne>10</span> Crédits</div>
                                            <div class="zone-actions-passager">
                                                <button class="btn btn-sm btn-outline-danger btn-annuler-passager"
                                                    onclick="annulerTrajet(this, 'passager')">Annuler
                                                    réservation</button>

                                                <button class="btn btn-sm btn-success btn-valider-trajet"
                                                    onclick="validerTrajet(this)" disabled>Valider le trajet</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="list-group-item p-4 border-0 border-bottom trajet-hover" data-covoiturage-id="102">
                                    <div class="row align-items-center">
                                        <div class="col-md-6">
                                            <div class="mb-2">
                                                <span
                                                    class="badge bg-primary-subtle text-primary border border-primary-subtle small">Conducteur</span>
                                            </div>
                                            <div class="d-flex align-items-center mb-1">
                                                <span class="lieux h5 mb-0 fw-bold" data-lieu-depart>Toulouse</span>
                                                <i class="bi bi-arrow-right mx-2 text-muted"></i>
                                                <span class="lieux h5 mb-0 fw-bold" data-lieu-arrivee>Bordeaux</span>
                                            </div>
                                            <div class="text-muted small"><span data-date-depart>15 Mars</span> • <span data-heure-depart>10:00</span> • <strong><span data-nb-place>3</span> places
                                                    restantes</strong></div>
                                        </div>
                                        <div class="col-md-3 text-md-center">
                                            <span
                                                class="badge rounded-pill bg-warning-subtle text-warning border border-warning-subtle px-3 py-2" data-statut>En
                                                cours</span>
                                        </div>
                                        <div class="col-md-3 text-md-end zone-actions-">
                                            <button class="btn btn-sm btn-danger btn-annuler-chauffeur"
                                                onclick="annulerTrajet(this, 'chauffeur')">Annuler le trajet</button>

                                            <button class="btn btn-sm btn-primary btn-workflow" data-etat="initial"
                                                onclick="gererWorkflow(this)">Démarrer le trajet</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="liste-historique" role="tabpanel">
                            <div class="text-center p-5">
                                <i class="bi bi-clock-history d-block mb-3 h1 text-muted opacity-50"></i>
                                <p class="text-muted fw-bold">Aucun trajet passé</p>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </section>
        <!-- Fin de l'historique des trajets -->
    </main>

    <!-- Modal de validation du trajet par le passager -->
    <div class="modal fade" id="modalAvis" tabindex="-1" aria-labelledby="modalAvisLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-light">
                    <h5 class="modal-title" id="modalAvisLabel">Validation du trajet</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <p class="text-muted small">Votre confirmation permet de libérer les crédits pour le chauffeur.</p>

                    <form id="formAvis">
                        <!-- Champ caché pour lier l'avis au covoiturage et à l'utilisateur -->
                        <input type="hidden" id="covoiturage-id-avis" name="covoiturage_id" value="">
                        <input type="hidden" id="utilisateur-id-avis" name="utilisateur_id" value="">

                        <div class="mb-3">
                            <label for="note" class="form-label fw-bold">Notez votre expérience :</label>
                            <select class="form-select" id="note" name="note" required>
                                <option value="" disabled selected>Sélectionner une note...</option>
                                <option value="5">⭐⭐⭐⭐⭐ - Excellent</option>
                                <option value="4">⭐⭐⭐⭐ - Très bien</option>
                                <option value="3">⭐⭐⭐ - Moyen</option>
                                <option value="2">⭐⭐ - Décevant</option>
                                <option value="1">⭐ - Mauvais</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="commentaire" class="form-label fw-bold">Votre avis :</label>
                            <textarea class="form-control" id="commentaire" name="commentaire" rows="3"
                                placeholder="Comment s'est déroulé le trajet ?" required></textarea>
                            <div class="form-text text-info">
                                <i class="bi bi-info-circle"></i> Cet avis sera modéré par nos équipes.
                            </div>
                        </div>

                        <input type="hidden" name="statut" value="en attente">
                    </form>
                </div>

                <div class="modal-footer d-flex justify-content-between">
                    <button type="button" class="btn btn-outline-danger btn-sm" onclick="signalerProbleme()">
                        Signaler un problème
                    </button>

                    <div>
                        <button type="button" class="btn btn-success btn-sm" onclick="envoyerAvis()">
                            Confirmer et Envoyer
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

<!-- FOOTER -->
    <?php include '../includes/footer.php'; ?> 

    <script src="/js/EspaceUtilisateur.js" defer></script>
</body>