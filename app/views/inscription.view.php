<body>
    <main>
        <div class="container-fluid px-4">
            <div class="row gx-5 justify-content-evenly">
                <div class="col-12 col-md-6 col-lg-5 formulaires_connexion">

                    <?php if (!empty($error)): ?>
                        <div class="alert alert-danger"><?php echo htmlspecialchars($error); ?></div>
                    <?php endif; ?>

                    <?php if (!empty($success)): ?>
                        <div class="alert alert-success"><?php echo htmlspecialchars($success); ?></div>
                    <?php endif; ?>

                    <!-- Formulaire d'inscription -->
                    <form id="inscription-form" method="post" action="?page=inscription">
                        <fieldset class="fieldset-connexion">
                            <legend>Inscription</legend>
                            <div class="connexion" id="pseudo-div">
                                <label for="pseudo">Pseudo</label>
                                <input type="text" id="pseudo" name="pseudo" required>
                            </div>
                            <div class="connexion" id="email-div">
                                <label for="email">Email</label>
                                <input type="email" id="email" name="email" required>
                            </div>
                            <div class="connexion" id="password-div">
                                <label for="password">Mot de passe</label>
                                <input type="password" id="password" name="password" required>
                            </div>
                            <div class="connexion" id="password-confirm-div">
                                <label for="password_confirm">Confirmer le mot de passe</label>
                                <input type="password" id="password_confirm" name="password_confirm" required>
                            </div>
                            <div>
                                <button type="submit" id="btnInscription" class="btn btn-primary">S'inscrire</button>
                            </div>
                            <div>
                                <button class="motDePasseOublie" type="button"
                                    onclick="location.href='?page=connexion'">Déjà inscrit ? Se connecter</button>
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </main>
  
</body>

</html>
