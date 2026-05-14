<?php
// On définit les accès à la base
$host = 'localhost';
$dbname = 'ecoride_db';
$user = 'root';
$pass = ''; // Vide sur Windows, 'root' sur Mac

try {
    // On tente la connexion
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // echo "Le pont est opérationnel, la base de données est connectée.";

} catch (PDOException $e) {
    // Si ça rate, PHP va t'expliquer pourquoi ici
    die("Echec de la connexion : " . $e->getMessage());
}