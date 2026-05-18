
<body>
    <main>
        <!-- Profil utilisateur -->
    <?php require_once __DIR__ . '/partials/-form-profil.php'; ?>
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

            <div class="action-passager mt-4 text-center">
               <a href="?page=covoiturage" class="btn-recherche-trajet ">
               Prêt à partir ? 
               </a>
            </div>
    </section>
        <!-- Fin du choix du rôle -->

        <div class="conteneur-chauffeur-flex">
            <!-- Formulaire véhicule -->
<?php require_once __DIR__ . '/partials/_form_vehicule.php'; ?>
            <!-- Formulaire trajet -->
<?php require_once __DIR__ . '/partials/_form_trajet.php'; ?>
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
