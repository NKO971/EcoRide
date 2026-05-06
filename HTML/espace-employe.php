<!DOCTYPE html>
<html lang="fr">
<!-- Mes pages coté back office ont des différences  -->

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EcoRide - Espace Employé</title>
    <link rel="stylesheet" href="/EcoRide/css/bootstrap.min.css">
    <link rel="stylesheet" href="/EcoRide/css/base.css">
    <link rel="stylesheet" href="/EcoRide/css/mediaquerise_base.css">
    <link rel="stylesheet" href="/EcoRide/css/espace-employe.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet">

    <script src="/EcoRide/js/bootstrap.bundle.min.js" defer></script>
    <script src="/EcoRide/js/jquery-3.7.1.min.js" defer></script>
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container-fluid">
                <div class="navbar-brand">
                    <img src="/EcoRide/Image/EcoRide.svg" alt="logo EcoRide" class="logo">
                    <span class="ms-2 border-start ps-2">Espace Back Office</span>
                </div>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarNav">
                    <div class="navbar-nav ms-auto align-items-center">
                        <a class="nav-link" href="#section-avis">Modération Avis</a>
                        <a class="nav-link" href="#section-litiges">Gestion Litiges</a>

                        <div class="ms-lg-4 d-flex align-items-center">
                            <span class="navbar-text me-3 text-white d-none d-lg-inline">
                                <span class="material-symbols-outlined align-middle">account_circle</span>
                                Session : Employé
                            </span>
                            <button type="button" id="btnLogout" class="btn btn-outline-danger btn-sm">
                                Déconnexion
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
    </header>

    <main class="container py-5">
        <!-- Profile de l'employé -->
        <div class="profile-employe d-flex align-items-center mb-5 p-3 bg-white shadow-sm rounded-4 ">
            <div class="avatar-wrapper">
                <img src="/EcoRide/Photo profile/pexels-italo-melo-881954-2379005.jpg" alt="Photo de l'employé"
                    class="avatar-img">
                <span class="status-indicator"></span>
            </div>

            <div class="ms-3">
                <h3 class="h5 mb-0" style="color: var(--color-dark);" id="nom-employe">Bienvenue, ...</h3>
                <p class="small mb-0" style="color: var(--color-light);">Équipe de modération • EcoRide Toulouse</p>
            </div>
        </div>

        <!-- Tableau de bord de modération -->
        <h1 class="mb-5">Tableau de bord de modération</h1>

        <section id="section-avis" class="card shadow-sm mb-5">
            <div class="card-header bg-white">
                <h2 class="h5 mb-0">Avis en attente de validation</h2>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>N° Trajet</th>
                                <th>Pseudo</th>
                                <th>Commentaire</th>
                                <th>Note</th>
                                <th class="text-end">Action</th>
                            </tr>
                        </thead>
                        <tbody id="avis-table-body">
                            <tr data-avis-id="1">
                                <td data-covoiturage-id="101">#CV-101</td>
                                <td data-utilisateur-pseudo="Client42">Client42</td>
                                <td data-commentaire="Chauffeur un peu en retard mais sympa.">Chauffeur un peu en retard mais sympa.</td>
                                <td data-note="3"><span class="text-warning">★★★☆☆</span></td>
                                <td class="text-end">
                                    <button class="btn btn-primary btn-sm" onclick="validerAvis(1)">Valider</button>
                                    <button class="btn btn-danger btn-sm" onclick="refuserAvis(1)">Refuser</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>

        <!-- Section des litiges -->
        <section id="section-litiges" class="card shadow-sm">
            <div class="card-header bg-white">
                <h2 class="h5 mb-0 text-danger">Signalements d'incidents</h2>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-striped mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>N° Trajet</th>
                                <th>Signalé par</th>
                                <th>Concerne / Type</th>
                                <th>Détails Trajet</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="litiges-table-body">
                            <tr data-covoiturage-id="885">
                                <td data-covoiturage-id="885"><strong>#CV-885</strong></td>
                                <td data-utilisateur-id="5" data-utilisateur-pseudo="Marc92">Marc92 <br> <small class="text-muted">marc@mail.com</small></td>
                                <td data-organisateur-id="8" data-organisateur-pseudo="Julie_V">Julie_V <br> <small class="text-muted">julie@mail.com</small></td>
                                <td data-lieu-depart="Paris" data-lieu-arrivee="Lyon" data-date-depart="12/05/2026">Paris → Lyon <br> <small>12/05/2026</small></td>
                                <td>
                                    <button class="btn btn-outline-secondary btn-sm" onclick="voirDescriptif(885)">Voir descriptif</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </main>
    <script src="/js/espace-employe.js" defer></script>
</body>

</html>