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