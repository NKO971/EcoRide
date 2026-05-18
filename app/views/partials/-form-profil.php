<?php
// Sécurité : On s'assure que ce fichier n'est pas accessible directement par l'URL
if (!isset($_SESSION['user_id'])) {
    exit('Accès refusé');
}
?>

     <section class="infos-personnelles">
            <h3>Mes informations de profil</h3>
            <form id="form-profil" method="post">
                <div class="profil row">
                    <!-- Affichage des informations utilisateur -->
                <div class="row mb-4 border-bottom pb-3">
                <div class="col-md-6">
                    <span class="text-muted small">Nom :</span> <span class="fw-bold" id="display-nom"><?php echo htmlspecialchars($user['nom'] ?? 'N/A'); ?></span>
                </div>
                <div class="col-md-6">
                    <span class="text-muted small">Prénom :</span> <span class="fw-bold" id="display-prenom"><?php echo htmlspecialchars($user['prenom'] ?? 'N/A'); ?></span>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label for="nom">Nom</label>
                    <input type="text" id="nom" name="nom" placeholder="Votre nom" value="<?php echo htmlspecialchars($user['nom'] ?? ''); ?>" required disabled>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label for="prenom">Prénom</label>
                    <input type="text" id="prenom" name="prenom" placeholder="Votre prénom" value="<?php echo htmlspecialchars($user['prenom'] ?? ''); ?>" required disabled>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" placeholder="votre@email.com" value="<?php echo htmlspecialchars($user['email'] ?? ''); ?>" required disabled>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label for="pseudo">Pseudo</label>
                    <input type="text" id="pseudo" name="pseudo" placeholder="Votre pseudo" value="<?php echo htmlspecialchars($user['pseudo'] ?? ''); ?>" required disabled>
                </div>
            </div>

            <div class="col-md-12">
                <div class="form-group">
                    <label for="adresse">Adresse complète</label>
                    <input type="text" id="adresse" name="adresse" placeholder="123 rue de l'écologie, 31000 Toulouse" value="<?php echo htmlspecialchars($user['adresse'] ?? ''); ?>" disabled>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label for="date_naissance">Date de naissance</label>
                    <input type="date" id="date_naissance" name="date_naissance" value="<?php echo htmlspecialchars($user['date_naissance'] ?? ''); ?>" disabled>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label for="telephone">Téléphone</label>
                    <input type="tel" id="telephone" name="telephone" placeholder="06 00 00 00 00" value="<?php echo htmlspecialchars($user['telephone'] ?? ''); ?>" pattern="[0-9]{10}" disabled>
                </div>
            </div>

            <div class="col-md-12">
                <div class="form-group">
                    <label for="photo_profil">Photo de profil</label>
                    <input type="file" id="photo_profil" name="photo_profil" accept="image/*" disabled>
                </div>
            </div>
        </div>

        <div class="actions-formulaire">
            <button type="button" id="btn-action-profil" class="btn-sauvegarde-profil">
                Modifier mon profil
            </button>
        </div>
    </form>
</section>