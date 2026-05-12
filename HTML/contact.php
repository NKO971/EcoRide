<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EcoRide - Accueil</title>
    <link rel="stylesheet" href="/EcoRide/css/bootstrap.min.css">
    <link rel="stylesheet" href="/EcoRide/css/base.css">
    <link rel="stylesheet" href="/EcoRide/css/mediaquerise_base.css">
    <link rel="stylesheet" href="/EcoRide/css/contact.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet">
    <script src="/EcoRide/js/bootstrap.bundle.min.js" defer></script>
    <script src="/EcoRide/js/jquery-3.7.1.min.js" defer></script>
    <!-- Je récupère des icons sur google front -->

</head>

<?php require '../includes/header.php'; ?>

<body>
    <main>

        <form id="formulaire" action="" method="post">
            <fieldset id="">
                <h1 class="row justify-content-md-center">Formulaire de contact</h1>
                <div class="row justify-content-md-center">
                    <div class="col-4">
                        <div class="mb-3" id="nom-div">
                            <label for="nom" class="form-label">Nom</label>
                            <input type="text" class="form-control" id="nom" placeholder="Entrez votre nom">
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="mb-3" id="prenom-div">
                            <label for="prenom" class="form-label">Prénom</label>
                            <input type="text" class="form-control" id="prenom" placeholder="Entrez votre prénom">
                        </div>
                    </div>
                </div>
                <div class="row justify-content-md-center">
                    <div class="col-8">
                        <div class="mb-3" id="message-div">
                            <label for="message" class="form-label">Message</label>
                            <textarea class="form-control" id="message" rows="3"></textarea>
                        </div>
                    </div>
                </div>
                <div class="row mb-3 justify-content-center">
                    <div class="col-2">
                        <button class="btn btn-primary" type="submit">Envoyer</button>
                    </div>
                </div>
            </fieldset>
        </form>
    </main>
     
    <!-- FOOTER -->
<?php require '../includes/footer.php'; ?>

<script src="/js/contact.js" type="module" defer></script>
</body>

</html>