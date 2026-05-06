<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EcoRide - Accueil</title>
    <link rel="stylesheet" href="/EcoRide/css/bootstrap.min.css">
    <link rel="stylesheet" href="/EcoRide/css/base.css">
    <link rel="stylesheet" href="/EcoRide/css/mediaquerise_base.css">
    <link rel="stylesheet" href="/EcoRide/css/style.css">
    <!-- Je récupère des icons sur google front -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet">
    <script src="/EcoRide/js/bootstrap.bundle.min.js" defer></script>
    <script src="/EcoRide/js/jquery-3.7.1.min.js" defer></script>

</head>

<body>

    <header>
        <nav class="navbar navbar-expand-lg">
            <div class="container-fluid">
                <a class="navbar-brand" href="/HTML/EcoRide_Accueil.html">
                    <img src="/EcoRide/Image/EcoRide.svg" alt="logo EcoRide" class="logo">
                </a>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarNav">
                    <div class="navbar-nav ms-auto align-items-center">
                        <a class="nav-link" href="/HTML/EcoRide_Accueil.html">Accueil</a>
                        <a class="nav-link" href="/HTML/resultat.html">Covoiturage</a>
                        <a class="nav-link" href="/HTML/connexion.html">Connexion</a>
                        <a class="nav-link" href="/HTML/contact.html">Contact</a>
                        <!-- Mon compte avec menu déroulant pour l'utilisateur connecté -->
                        <div class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle btn-mon-compte" href="#" id="navbarDropdown"
                                role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Mon compte
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end shadow-sm" aria-labelledby="navbarDropdown">
                                <li class="dropdown-item-text text-center border-bottom pb-2 mb-2">
                                    <span class="badge bg-success py-2 px-3"><span id="user-credits-header">20</span> Crédits</span>
                                </li>
                                <li class="dropdown-item-text">
                                    <strong id="menu-pseudo">Pseudo</strong>
                                </li>
                                <li><a class="dropdown-item" href="/HTML/Espace_utilisateur.html">Accéder au profil</a>
                                </li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item text-danger" href="#">Déconnexion</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
    </header>

    <main>
        <!-- Barre de recherche -->
        <div class="bdr">
            <form class="barreRecherche input-group d-flex flex-wrap justify-content-center" method="get" role="search">
                <!-- Ville de départ -->
                <div class="col-12 col-md-8 col-lg-2 mx-auto">
                    <label for="lieu_depart" class="visually-hidden">Ville de départ</label>
                    <input type="text" 
                        placeholder="Départ" 
                        id="lieu_depart" 
                        name="lieu_depart"
                        value="" 
                        class="form-control"
                        aria-label="Ville de départ">
                </div>

                <!-- Ville d'arrivée -->
                <div class="col-12 col-md-8 col-lg-2 mx-auto">
                    <label for="lieu_arrivee" class="visually-hidden">Ville d'arrivée</label>
                    <input type="text" 
                        placeholder="Arrivée" 
                        id="lieu_arrivee" 
                        name="lieu_arrivee"
                        value="" 
                        class="form-control"
                        aria-label="Ville d'arrivée">
                </div>

                <!-- Date -->
                <div class="col-12 col-md-8 col-lg-2 mx-auto">
                    <label for="date_depart" class="visually-hidden">Date du trajet</label>
                    <input type="date" 
                        id="date_depart" 
                        name="date_depart" 
                        class="date form-control"
                        aria-label="Date du trajet">
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
                            <a href="/HTML/inscription.html" 
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

    <footer>
        <!-- Pied de page avec informations de contact -->
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl text-center">
                    <a href="mailto:EcoRide@hotmail.com" class="contact-mail">EcoRide@hotmail.com</a>
                </div>
                <div class="col-xl text-center">
                    <a href="" class="mentions-legales">Mention légales</a>
                </div>
                <div class="col-xl text-center">
                    <a href="" class="reseaux-sociaux">Réseaux sociaux</a>
                </div>
            </div>
        </div>
    </footer>
    <script src="/js/barreDeRecherche.js" defer></script>
</body>

</html>