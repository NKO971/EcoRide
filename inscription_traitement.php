<?php
require_once 'config/db.php';

// On vérifie si le formulaire a été envoyé
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // 1. Récupération des données du formulaire
    // Les noms entre [''] doivent être EXACTEMENT les "name" de ton HTML
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $pseudo = $_POST['pseudo'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirmer_password = $_POST['confirmer-password'];

    // Vérification que les mots de passe soit identiques
    if ($password !== $confirmer_password) {
        die("Erreur : Les mots de passe ne correspondent pas.");
    }

    // Hachage du mot de passe règle de sécurité
    $password_hache = password_hash($password, PASSWORD_DEFAULT);

    try {
        // Préparation de la requête SQL (Protection contre les injections SQL)
        // Vérifie que les noms des colonnes (nom, prenom, etc.) correspondent à ta table SQL
        $sql = "INSERT INTO utilisateur (nom, prenom, pseudo, email, mot_de_passe) VALUES (:nom, :prenom, :pseudo, :email, :mdp)";
        $stmt = $pdo->prepare($sql);

        // Exécution en reliant les étiquettes aux vraies valeurs
        $stmt->execute([
            ':nom' => $nom,
            ':prenom' => $prenom,
            ':pseudo' => $pseudo,
            ':email' => $email,
            ':mdp' => $password_hache
        ]);

        echo "Félicitations $pseudo, ton compte a été créé avec succès !";
        // Plus tard, on pourra rediriger vers la page de connexion ici ?

    } catch (PDOException $e) {
        // Si l'email existe déjà ou qu'il y a un bug
        echo "Erreur lors de l'enregistrement : " . $e->getMessage();
    }
}