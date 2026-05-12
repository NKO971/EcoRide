<?php 
// 1. Indispensable pour que le header sache qui est connecté
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<header>
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <a class="navbar-brand" href="/EcoRide/Ecoride_Accueil.php">
                <img src="/EcoRide/Image/EcoRide.svg" alt="logo EcoRide" class="logo">
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <div class="navbar-nav ms-auto align-items-center">
                    <a class="nav-link" href="/EcoRide/Ecoride_Accueil.php">Accueil</a>
                    <a class="nav-link" href="/EcoRide/HTML/resultat.php">Covoiturage</a>
                    <a class="nav-link" href="/EcoRide/HTML/contact.php">Contact</a>

                    <?php if (isset($_SESSION['user_id'])): ?>
                        
                        <div class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle btn-mon-compte" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Mon compte (<?php echo htmlspecialchars($_SESSION['pseudo']); ?>)
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end shadow-sm" aria-labelledby="navbarDropdown">
                                <li class="dropdown-item-text text-center border-bottom pb-2 mb-2">
                                    <span class="badge bg-success py-2 px-3">20 Crédits</span>
                                </li>
                                <li><a class="dropdown-item" href="/EcoRide/HTML/Espace_utilisateur.php">Accéder au profil</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item text-danger" href="/EcoRide/includes/deconnexion.php">Déconnexion</a></li>
                            </ul>
                        </div>

                    <?php else: ?>

                        <a class="nav-link" href="/EcoRide/HTML/connexion.php">Connexion</a>

                    <?php endif; ?>
                    </div>
            </div>
        </div>
    </nav>
</header>