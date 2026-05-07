<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EcoRide - Covoiturage</title>
    <link rel="stylesheet" href="/EcoRide/css/bootstrap.min.css">
    <link rel="stylesheet" href="/EcoRide/css/base.css">
    <link rel="stylesheet" href="/EcoRide/css/mediaquerise_base.css">
    <link rel="stylesheet" href="/EcoRide/css/resultat.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet">
    <script src="/EcoRide/js/bootstrap.bundle.min.js" defer></script>
    <script src="/EcoRide/js/jquery-3.7.1.min.js" defer></script>
</head>

<?php include '../includes/header.php'; ?>

<body>
    <main class="conteneur">
        <!-- Barre de recherche -->
        <div class="bdr">
            <form class="barreRecherche input-group d-flex flex-wrap justify-content-center" method="get" role="search">
                <!-- Ville de départ -->
                <div class="col-12 col-md-8 col-lg-2 mx-auto">
                    <label for="lieu_depart" class="visually-hidden">Ville de départ</label>
                    <input type="text" placeholder="Départ" id="lieu_depart" name="lieu_depart" value="" class="form-control">
                </div>

                <!-- Ville d'arrivée -->
                <div class="col-12 col-md-8 col-lg-2 mx-auto">
                    <label for="lieu_arrivee" class="visually-hidden">Ville d'arrivée</label>
                    <input type="text" placeholder="Arrivée" id="lieu_arrivee" name="lieu_arrivee" value="" class="form-control">
                </div>

                <!-- Date -->
                <div class="col-12 col-md-8 col-lg-2 mx-auto">
                    <label for="date_depart" class="visually-hidden">Date du trajet</label>
                    <input type="date" id="date_depart" name="date_depart" class="date form-control">
                </div>

                <!-- Bouton -->
                <div class="col-12 col-md-4 col-lg-3 d-grid mx-auto">
                    <button class="btn btn-primary" type="submit">Rechercher</button>
                </div>
            </form>
            <div id="message-erreur" class="alert alert-danger d-none mt-3 d-flex align-items-center" role="alert">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                    class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2 text-warning" viewBox="0 0 16 16"
                    role="img" aria-label="Warning:">
                    <path
                        d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
                </svg>
                <div>
                    Veuillez remplir les champs de recherche pour trouver des trajets disponibles.
                </div>
            </div>
        </div>
        <!-- Fin barre de recherche -->

        <!-- Filtres -->
        <div class="container-xl">
            <div class="row" style="--bs-gap: 1rem">
                <div class="divBouton">
                    <button class="btnFiltre col-12 d-md-none mb-3" type="button" data-bs-toggle="collapse"
                        data-bs-target="#zoneFiltres" aria-expanded="false" aria-controls="zoneFiltres">
                        <span class="material-symbols-outlined">filter_list</span> Afficher filtres.
                    </button>
                </div>
                <div class="col-md-3 offset-md-1">
                    <fieldset id="zoneFiltres" class="collapse d-md-block">
                        <form action="" method="get" class="filtre">
                            <h2>Trier par</h2>

                            <div class="conteneurFiltre">
                                <input type="checkbox" id="plus-rapide" name="plus-rapide">
                                <label for="plus-rapide"> Le plus rapide.</label>
                            </div>
                            <div class="conteneurFiltre">
                                <input type="checkbox" id="plus-ecologique" name="plus-ecologique">
                                <label for="plus-ecologique">Le plus écologique.</label>
                            </div>

                            <div class="conteneurFiltre">
                                <label for="prix-max">Prix max :</label>
                                <input class="prixDuree" type="number" id="prix-max" name="prix-max">
                            </div>
                            <div class="conteneurFiltre">
                                <label for="duree-max">Durée max (h) :</label>
                                <input class="prixDuree" type="number" id="duree-max" name="duree-max">
                            </div>

                            <div class="separation-2"></div>

                            <h2>Horaires</h2>
                            <div class="conteneurFiltre">
                                <input type="checkbox" id="avant-6h" name="avant-6h">
                                <label for="avant-6h">Avant 6 h 00</label>
                            </div>
                            <div class="conteneurFiltre">
                                <input type="checkbox" id="entre-6h-12" name="entre-6h-12">
                                <label for="entre-6h-12">6 h 00 - 12 h 00</label>
                            </div>
                            <div class="conteneurFiltre">
                                <input type="checkbox" id="entre-12h-18h" name="entre-12h-18h">
                                <label for="entre-12h-18h">12 h 00 - 18 h 00</label>
                            </div>
                            <div class="conteneurFiltre">
                                <input type="checkbox" id="apres-18h" name="apres-18h">
                                <label for="apres-18h">Après 18 h 00</label>
                            </div>

                            <div class="separation-2"></div>

                            <h2>Sécurité</h2>
                            <div class="conteneurFiltre">
                                <input type="checkbox" id="profile-verifie" name="profile-verifie">
                                <label for="profile-verifie">Profil vérifié</label>
                            </div>
                            <div class="conteneurFiltre">
                                <input type="checkbox" id="note-superieur-a-3" name="note-superieur-a-3">
                                <label for="note-superieur-a-3">Note > 3 étoiles</label>
                            </div>
                        </form>
                    </fieldset>
                </div>
                <!-- Fin filtres -->

                <!-- Récap résultats -->
                <div class="conteneurResultat col-12 col-md-8">
                    <div class="recap-resultat p-2 mb-4">
                        ( <strong id="nb-voyages-trouve">0..</strong> voyages trouvés )
                    </div>

                    <!-- Résultats -->
                    <div id="alerte-trajet-proche" class="alerte-suggestion d-none">
                        <div class="message-info">
                            <p>Aucun trajet trouvé pour cette date. Voici les résultats les plus proches :</p>
                        </div>
                    </div>
                    <div class="resultats" id="liste-trajet">
                        <!-- Template de carte trajet -->
                        <div class="covoiturage"
                            data-trajet-id="123"
                            data-chauffeur-id="456"
                            data-prix-centimes="500"
                            data-est-ecologique="true"
                            data-nb-places="2"
                            data-note="4.5">
                            <div class="destinationHoraire">
                                <div class="trajet">
                                    <span class="depart" data-lieu-depart>Paris</span>
                                    <span class="arrivee" data-lieu-arrivee>Toulouse</span>
                                </div>
                                <div class="heure_depart" data-heure-depart>10h30</div>
                                <div class="FlechesH">
                                    <span class="material-symbols-outlined">line_end_arrow_notch</span>
                                </div>
                                <div class="heure_arrivee" data-heure-arrivee>16h07</div>
                                <div class="FlechesH">
                                    <span class="material-symbols-outlined">line_end_arrow_notch</span>
                                </div>
                                <div class="date_arrivee" data-date-arrivee>24/05/2026</div>
                            </div>
                            <div class="ligneDeSeparation">
                                <hr />
                            </div>
                            <div class="info-conducteur">
                                <div class="photo-pseudo col-12 col-md-auto d-flex flex-column flex-md-row align-items-center gap-2">
                                    <img src="/Photo profile/freepik__the-style-is-candid-image-photography-with-natural__82878.png"
                                        alt="Jean" class="photoDeProfil" data-photo-chauffeur>
                                    <span class="pseudo" data-pseudo-chauffeur>JeanP75</span>
                                </div>
                                <div class="note">
                                    <span class="material-symbols-outlined">star</span>
                                    <span class="note-chauffeur" data-note-chauffeur>4,5</span>
                                </div>
                                <div class="icon-energie" data-icon-energie>
                                    <span class="material-symbols-outlined">electric_car</span>
                                    <small>Écologique</small>
                                </div>
                                <div class="icon-credit">
                                    <span class="material-symbols-outlined">payments</span>
                                    <span><span class="js-credits" data-prix-affiche>5</span> Crédits</span>
                                </div>
                                <div class="icon-passager">
                                    <span class="material-symbols-outlined">person</span>
                                    <span><span class="js-places" data-places-affichee>2</span> places</span>
                                </div>
                                <div class="action-btn col-12 col-md-auto">
                                    <button class="btn-details btn-sm btn-outline-primary w-100 w-md-auto"
                                        data-bs-toggle="modal"
                                        data-bs-target="#modalDetailsTrajet"
                                        data-covoiturage-id="123">Détails</button>
                                </div>
                            </div>
                        </div>
                        <!-- Fin template carte -->
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- FOOTER -->
<?php include '../includes/footer.php'; ?>

    <!-- Modal Détails du trajet -->
    <div class="modal fade" id="modalDetailsTrajet" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">

                <div class="modal-header border-0">
                    <h5 class="modal-title bold">Détails du voyage</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <div class="recap-trajet-modal mb-4 p-3 text-center">
                        <span class="v-depart bold" id="modal-ville-depart">Paris</span>
                        <span class="material-symbols-outlined icone-fleche">arrow_forward</span>
                        <span class="v-arrivee bold" id="modal-ville-arrivee">Toulouse</span>
                        <div class="info-horaire-details">
                            Départ à <span id="modal-heure-depart">10h30</span> 
                            - Arrivée prévue à <span id="modal-heure-arrivee">16h07</span>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 border-end">
                            <div class="info-conducteur flex align-items-center gap-3 mb-3">
                                <img src="/Photo profile/freepik__the-style-is-candid-image-photography-with-natural__82878.png"
                                    alt="Jean" class="photoDeProfil-details" id="modal-photo-chauffeur">
                                <div class="conducteur-meta">
                                    <h4 class="pseudo-modal m-0" id="modal-pseudo-chauffeur">JeanP75</h4>
                                    <div class="note-container">
                                        <span class="material-symbols-outlined">star</span>
                                        <span class="note-chiffre" id="modal-note-chauffeur">4,5/5</span>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Bouton pour afficher les avis -->
                            <button class="btn btn-outline-primary btn-sm mb-3" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseAvis" aria-expanded="false"
                                id="avis-bouton">
                                Voir les commentaires
                            </button>

                            <!-- Zone des avis -->
                            <div class="collapse" id="collapseAvis">
                                <div class="card card-body bg-light border-0 mb-3 p-2" style="font-size: 0.85rem;" id="modal-avis-list">
                                    <div class="mb-2 border-bottom pb-1">
                                        <strong class="avis-passager">Marie_L :</strong> "Top conducteur !"
                                    </div>
                                    <div>
                                        <strong class="avis-passager">Lucas_P :</strong> "Très ponctuel."
                                    </div>
                                </div>
                            </div>

                            <!-- Zone des préférences -->
                            <div class="preferences-zone">
                                <p class="titre-pref">Préférences :</p>
                                <p class="texte-pref" id="modal-preferences">"Non fumeur, pas d'animaux. Je discute volontiers !"</p>
                            </div>
                        </div>

                        <div class="col-md-6 ps-md-4">
                            <h6 class="bold mb-3">Véhicule</h6>
                            <div class="d-flex align-items-center gap-2 mb-2">
                                <span id="modal-icon-vehicule" class="material-symbols-outlined">electric_car</span>
                                <span class="nom-vehicule" id="modal-nom-vehicule">Tesla Model 3 (Blanc)</span>
                            </div>
                            <div class="badge-energie" id="modal-type-energie">Électrique</div>
                            <hr class="separation-modal">
                            <div class="d-flex justify-content-between align-items-center mt-3">
                                <div class="places-restantes">
                                    Places : <strong id="modal-nb-place">2</strong>
                                </div>
                                <div class="prix-credits">
                                    <span id="modal-prix-final">5</span> Crédits
                                </div>
                            </div>
                            <p class="prix-place">Prix pour une place !</p>
                        </div>
                    </div>
                </div>

                <div class="modal-footer border-0">
                    <button class="btn-reservation-eco"
                        data-bs-toggle="modal"
                        data-bs-target="#modalConfirmationPaiment"
                        data-covoiturage-id="123"
                        id="btn-participer-trajet">Participer au trajet</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Confirmation Paiement -->
    <div class="modal fade" id="modalConfirmationPaiment" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-sm modal-dialog-centered">
            <div class="modal-content modal-confirmation-eco">
                <div class="modal-body text-center p-4">
                    <div class="icon-container-confirmation">
                        <span class="material-symbols-outlined">account_balance_wallet</span>
                    </div>
                    <h5 class="modal-confirm-title">Confirmer la réservation ?</h5>
                    <p class="modal-confirm-text">
                        Le montant de <span class="highlight-credit" id="modal-montant-final">5 crédits</span> 
                        sera prélevé de votre compte pour ce trajet.
                    </p>
                    <div class="d-grid gap-2 mt-4">
                        <button type="button" class="btn btn-confirm-final" id="btn-confirmer-paiement">Confirmer et payer</button>
                        <button type="button" class="btn btn-cancel-link" data-bs-dismiss="modal">Annuler</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal de connexion requise -->
    <div class="modal fade" id="modalConnexionRequise" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-sm modal-dialog-centered">
            <div class="modal-content modal-confirmation-eco">
                <div class="modal-body text-center p-4">
                    <div class="icon-container-visitor">
                        <span class="material-symbols-outlined">person_add</span>
                    </div>
                    <h5 class="modal-confirm-title">Connexion requise</h5>
                    <p class="modal-confirm-text">
                        Vous devez être connecté pour réserver un trajet et utiliser vos crédits.
                    </p>
                    <div class="d-grid gap-2 mt-4">
                        <a href="/HTML/connexion.html" class="btn btn-primary-eco">Se connecter</a>
                        <a href="/HTML/Inscription.html" class="btn btn-secondary-eco">S'inscrire</a>
                        <button type="button" class="btn btn-cancel-link" data-bs-dismiss="modal">Plus tard</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="/js/barreDeRecherche.js" defer></script>
    <script src="/js/resultat.js" defer></script>
</body>

</html>