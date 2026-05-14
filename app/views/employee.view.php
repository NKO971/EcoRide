
<body>
    <main class="container py-5">
        <!-- Profile de l'employé -->
        <div class="profile-employe d-flex align-items-center mb-5 p-3 bg-white shadow-sm rounded-4 ">
            <div class="avatar-wrapper">
                <img src="/EcoRide/Photo profile/pexels-italo-melo-881954-2379005.jpg" alt="Photo de l'employé"
                    class="avatar-img">
                <span class="status-indicator"></span>
            </div>

            <div class="ms-3">
                <h3 class="h5 mb-0" style="color: var(--color-dark);" id="nom-employe">Bienvenue, <?php echo htmlspecialchars($employee['pseudo'] ?? 'Employé'); ?></h3>
                <p class="small mb-0" style="color: var(--color-light);">Équipe de modération • EcoRide</p>
            </div>
        </div>

        <!-- Tableau de bord de modération -->
        <h1 class="mb-5">Tableau de bord de modération</h1>

        <section id="section-avis" class="card shadow-sm mb-5">
            <div class="card-header bg-white">
                <h2 class="h5 mb-0">Avis en attente de validation</h2>
            </div>
            <div class="card-body p-0">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Auteur</th>
                            <th>Note</th>
                            <th>Commentaire</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td colspan="4" class="text-center text-muted py-4">Aucun avis en attente</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </section>

        <!-- Trajets signalés -->
        <section id="section-signalements" class="card shadow-sm">
            <div class="card-header bg-white">
                <h2 class="h5 mb-0">Trajets signalés</h2>
            </div>
            <div class="card-body p-0">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Trajet</th>
                            <th>Motif</th>
                            <th>Signalé par</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td colspan="4" class="text-center text-muted py-4">Aucun signalement</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </section>
    </main>

</body>

</html>
