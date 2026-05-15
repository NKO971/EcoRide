
<body>
    <main class="container my-5">
        <div class="row mb-4">
            <div class="col">
                <h1 class="h2 border-bottom pb-2">Tableau de bord</h1>
            </div>
        </div>

        <div class="row g-4">
            <div class="col-12 col-lg-7">
                <div class="card shadow-sm h-100">
                    <div class="card-header bg-white">
                        <h5 class="card-title mb-0">Fréquentation des covoiturages</h5>
                    </div>
                    <div class="card-body">
                        <canvas id="chart-trajets" height="200" data-endpoint="stats-frequentation"></canvas>
                    </div>
                </div>
            </div>

            <div class="col-12 col-lg-5">
                <div class="card shadow-sm h-100 border-success">
                    <div class="card-header bg-success text-white">
                        <h5 class="card-title mb-0">Revenus de la plateforme</h5>
                    </div>
                    <div class="card-body d-flex flex-column justify-content-between">
                        <div class="text-center py-3">
                            <p class="text-muted mb-1">Total accumulé</p>
                            <h2 class="display-4 fw-bold text-success">
                                <span id="total-credits" data-unite="credits">0</span> crédits
                            </h2>
                        </div>
                        <canvas id="chart-credits" height="150"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <section class="mt-5">
            <div class="card shadow-sm">
                <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Gestion des comptes</h5>
                    <div class="input-group input-group-sm w-25">
                        <input type="text" class="form-control" placeholder="Rechercher un pseudo..." id="search-user" name="recherche_pseudo">
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0 align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>Pseudo</th>
                                    <th>Rôle</th>
                                    <th>Statut</th>
                                    <th class="text-end">Actions</th>
                                </tr>
                            </thead>
                            <tbody id="liste-utilisateurs">
<?php 
 if (!empty($users)): 
?>
<?php 
foreach ($users as $u): 
?>
                            <tr>
                                    <td><strong>
<?php 
echo htmlspecialchars($u['pseudo']); 
?>
                                        </strong></td>
                                <td>
<?php 
    if ($u['role_id'] == 1) echo '<span class="badge bg-danger">Admin</span>';
    elseif ($u['role_id'] == 2) echo '<span class="badge bg-primary">Employé</span>';
    else echo '<span class="badge bg-secondary">Utilisateur</span>'
?>
                                </td>
                                <td>
                                    <span class="text-success">Actif</span>
                                </td>
                                <td class="text-end">
                                    <button class="btn btn-sm btn-outline-warning">Modifier</button>
                                    <button class="btn btn-sm btn-outline-danger">Supprimer</button>
                                 </td>
                            </tr>
<?php 
endforeach; 
?>
<?php 
else: 
?>
                            <tr>
                                <td colspan="4" class="text-center py-3">Aucun utilisateur trouvé.</td>
                            </tr>
<?php 
endif; 
?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>

        <section class="mt-5 mb-5">
            <div class="row">
                <div class="col-lg-6 mx-auto">
                    <div class="card shadow-sm border-primary">
                        <div class="card-header bg-primary text-white">
                            <h5 class="mb-0">Créer un nouveau compte employé</h5>
                        </div>
                        <div class="card-body">
<?php 
if (isset($msg)): ?>
                        <div class="alert alert-info">
<?php 
echo $msg; 
?>
                        </div>
<?php 
endif; 
?>

                            <form id="form-creation-employe" action="index.php?page=admin" method="POST">
                                <div class="mb-3">
                                    <label for="emp-nom" class="form-label">Pseudo de l'employé</label>
                                    <input type="text" class="form-control" id="emp-nom" name="pseudo" required>
                                </div>
                                <div class="mb-3">
                                    <label for="emp-email" class="form-label">Adresse Email</label>
                                    <input type="email" class="form-control" id="emp-email" name="email" required>
                                </div>
                                <div class="mb-3">
                                    <label for="emp-password" class="form-label">Mot de passe provisoire</label>
                                    <input type="password" class="form-control" id="emp-password" name="password" required>
                                </div>
                                <button type="submit" name="btn_create_employee" class="btn btn-primary w-100">Créer le compte</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
</body>
