<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EcoRide - Inscription</title>
    <link rel="stylesheet" href="/EcoRide/css/bootstrap.min.css">
    <link rel="stylesheet" href="/EcoRide/css/base.css">
    <link rel="stylesheet" href="/EcoRide/css/mediaquerise_base.css">
    <link rel="stylesheet" href="/EcoRide/css/connexion-inscription.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet">
    <!-- Je récupère des icons sur google front -->
    <script src="/EcoRide/js/bootstrap.bundle.min.js" defer></script>
    <script src="/EcoRide/js/jquery-3.7.1.min.js" defer></script>


</head>

<body>

  <header>
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <a class="navbar-brand" href="/HTML/EcoRide_Accueil.html">
                <img src="/Image/EcoRide.svg" alt="logo EcoRide" class="logo">
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
                        <a class="nav-link dropdown-toggle btn-mon-compte" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Mon compte
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end shadow-sm" aria-labelledby="navbarDropdown">
                            <li class="dropdown-item-text text-center border-bottom pb-2 mb-2">
                                <span class="badge bg-success py-2 px-3">20 Crédits</span>
                            </li>
                            <li><a class="dropdown-item" href="/HTML/Espace_utilisateur.html">Accéder au profil</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item text-danger" href="#">Déconnexion</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </nav>
</header>

<main class="container my-5">
    <div class="row inscription-form-et-img">
        
        <div class="col-12 col-lg-6">
            <div class="formulaires2">
                <form action="inscription_traitement.php" method="post">
                    <fieldset class="fieldset-inscription">
                        <legend>Inscription</legend>
                        <div class="inscription">
                            <label for="nom">Nom</label>
                            <input type="text" id="nom" name="nom" placeholder="Entrez votre nom" required>
                        </div>
                        <div class="inscription">
                            <label for="prenom">Prénom</label>
                            <input type="text" id="prenom" name="prenom" placeholder="Entrez votre prénom" required>
                        </div>
                        <div class="inscription">
                            <label for="pseudo">Pseudo</label>
                            <input type="text" id="pseudo" name="pseudo" placeholder="Entrez votre pseudo" required>
                        </div>
                        <div class="inscription">
                            <label for="email">Email</label>
                            <input type="email" id="email" name="email" placeholder="@example.com" required>
                        </div>
                        <div class="inscription">
                            <label for="password">Mot de passe</label>
                            <input type="password" id="password" name="password" placeholder="8 caractère min, 1 majuscule, 1 chiffre"
                            pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$"
                            title="Le mot de passe doit contenir au moins 8 caractères, une majuscule et un chiffre" required>
                        </div>
                        <div class="inscription">
                            <label for="confirmer-password">Confirmer mot de passe</label>
                            <input type="password" id="confirmer-password" name="confirmer-password" placeholder="Confirmer" required>
                        </div>
                        <div>
                            <button type="submit">Inscription</button>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>

        <div class="col-12 col-lg-6 text-center">
            <img src="/EcoRide/Image/convertible car-bro.png" alt="Image de voiture" class="image-voiture img-fluid">
        </div>

    </div>
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
</body>

</html>