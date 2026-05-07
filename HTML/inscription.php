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

<?php include '../includes/header.php'; ?>

<body>
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
   <!-- FOOTER -->
<?php include '../includes/footer.php'; ?> 

</body>

</html>