
<body>
    <main>
    <!-- Barre de recherche -->
<div class="bdr">
    <form class="barreRecherche input-group d-flex flex-wrap justify-content-center" method="GET" action="/EcoRide/public/index.php" role="search">
        
        <input type="hidden" name="page" value="covoiturage">

        <?php require __DIR__ . '/partials/search_bar.view.php'; ?>

        <div class="col-12 col-md-4 col-lg-3 d-grid mx-auto">
            <button class="btn btn-primary" type="submit">Rechercher</button>
        </div>
    </form>

    <div id="message-erreur" class="alert alert-danger d-none mt-3 d-flex align-items-center" role="alert">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2 text-warning" viewBox="0 0 16 16" role="img" aria-label="Warning:">
            <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
        </svg>
        <div>
            Veuillez remplir tous les champs de recherche pour trouver des trajets disponibles.
        </div>
    </div>
</div>
    <!-- Fin barre de recherche -->

        <section class="py-5">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6 mb-4 mb-lg-0">
                        <div class="texte">
                            <h1>Bienvenue sur EcoRide</h1>
                            <p>
                                EcoRide est une plateforme de covoiturage éco-responsable conçue pour faciliter les
                                trajets
                                quotidiens tout en réduisant l'impact environnemental.
                                Que vous soyez conducteur ou passager, trouvez ou proposez facilement un trajet, en
                                toute
                                sécurité.<br>
                                <strong>Ensemble, adoptons une mobilité plus verte !</strong>
                            </p>
                        </div>
                    </div>
                    <div class="col-lg-6 text-center">
                        <img src="/EcoRide/Image/6365344.jpg" alt="Illustration trajet - Deux personnes partageant un voyage écologique" class="img-accueil shadow-sm">
                    </div>
                </div>
            </div>
        </section>

        <section class="py-5 bg-light">
            <div class="container">
                <div class="row align-items-center flex-lg-row-reverse">
                    <div class="col-lg-6 mb-4 mb-lg-0">
                        <div class="texte-partie2">
                            <h2>Rejoignez notre communauté</h2>
                            <p>
                                Rejoignez notre communauté d'utilisateurs engagés et bénéficiez de 20 crédits pour un
                                avenir plus vert. Avec EcoRide,
                                chaque trajet compte pour la planète.
                            </p>
                        </div>
                        <div class="mt-4">
                            <a href="?page=inscription" 
                                class="btn btn-inscription"
                                id="btn-inscription-accueil">
                                Rejoindre la communauté
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-6 text-center">
                        <img src="/EcoRide/Image/7178884.jpg" 
                            alt="Illustration communauté - Un groupe de personnes s'engageant pour le covoiturage écologique" 
                            class="img-accueil shadow-sm">
                    </div>
                </div>
            </div>
        </section>
    </main>

    <script src="/EcoRide/js/barreDeRecherche.js" defer></script>
</body>

</html>