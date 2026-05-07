<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Security-Policy" content="default-src 'self'; script-src 'self' https://fonts.googleapis.com; style-src 'self' 'unsafe-inline' https://fonts.googleapis.com; font-src 'self' https://fonts.gstatic.com;">
    <title>EcoRide - Connexion</title>
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

<?php include '../includes/header.php'; ?>

<body>
    <main>
        <div class="container-fluid px-4">
            <div class="row gx-5 justify-content-evenly">
                <div class="col-12 col-md-6 col-lg-5 formulaires_connexion">
                    <!-- Formulaire de connexion -->
                    <form id="connexion-form" method="post">
                        <fieldset class="fieldset-connexion">
                            <legend>Connexion</legend>
                            <div class="connexion" id="email-div">
                                <label for="email">Email</label>
                                <input type="email" id="email" name="email" required>
                            </div>
                            <div class="connexion" id="password-div">
                                <label for="password">Mot de passe</label>
                                <input type="password" id="password" name="password" required>
                            </div>
                            <div class="connexion">
                                <label class="checkbox">
                                    <!-- Ici pas de for parceque la checkbox est a l'intérieur du label -->
                                    <input type="checkbox" name="restez-connecte">
                                    Restez connecté
                                </label>
                            </div>
                            <div>
                                <button type="submit" id="btnConnexion" class="btn btn-primary">Connexion</button>
                            </div>
                            <div>
                                <button class="motDePasseOublie" type="button"
                                    onclick="location.href='mot-de-passe-mot-de-passe-oublie.html'">Mot de passe
                                    oublié</button>
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </main>
  
    <!-- FOOTER -->
<?php include '../includes/footer.php'; ?>

    <script src="/js/connexion.js" defer></script>
</body>

</html>