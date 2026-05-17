
<body>
    <main class="conteneur">
        <!-- Barre de recherche -->
        <div class="bdr">
            <form class="barreRecherche input-group d-flex flex-wrap justify-content-center" method="get" role="search">
               <input type="hidden" name="page" value="covoiturage">

                <?php require __DIR__ . '/partials/search_bar.view.php'; ?>

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
                        <form action="/EcoRide/public/index.php" method="GET" class="filtre">
                            <input type="hidden" name="page" value="covoiturage">
                            
                            <?php require __DIR__ . '/partials/search_filters.view.php'; ?>
                            
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
                                    <img src="/EcoRide/Photo profile/freepik__the-style-is-candid-image-photography-with-natural__82878.png"
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
                                <img src="/EcoRide/Photo profile/freepik__the-style-is-candid-image-photography-with-natural__82878.png"
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

    <!-- Modal Confirmation de paiement -->
    <div class="modal fade" id="modalConfirmationPaiment" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <h5 class="modal-title bold">Confirmation</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    <p>Êtes-vous sûr de vouloir réserver ce trajet ?</p>
                    <p class="prix-modal"><span id="prix-confirmation">5</span> Crédits seront débités</p>
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <button type="button" class="btn btn-primary" id="btn-confirmer-reservation">Confirmer</button>
                </div>
            </div>
        </div>
    </div>

    <script src="/EcoRide/js/barreDeRecherche.js" defer></script>
    
    <script>
    // On prend la variable $trajets (qui viendra du contrôleur) et on la transforme en JSON
    // Si $trajets n'existe pas encore ou est vide, on met un tableau vide [] par sécurité
    window.trajetsDepuisBDD = <?php echo isset($trajets) ? json_encode($trajets) : '[]'; ?>;
    
    // Affichage dans la console pour vérifier que les données sont bien transmises
    console.log("Données reçues de la BDD via PHP :", window.trajetsDepuisBDD);
    </script>
    <script src="/EcoRide/js/resultat.js" defer></script>

</body>

</html>
