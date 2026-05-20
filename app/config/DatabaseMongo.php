<?php

class DatabaseMongo {
    private static $manager = null;
    private static $databaseName = "ecoride_nosql";

    // URI de connexion sécurisée vers MongoDB Atlas
    private static $uri = "mongodb+srv://luidginicolas_db_user:fOh5xUY4UIcBED5K@clusterecoride.0prxewg.mongodb.net/?appName=ClusterEcoRide";

    /**
     * Retourne l'instance unique du Manager MongoDB (Pattern Singleton)
     */
    public static function getManager() {
        if (self::$manager === null) {
            try {
                self::$manager = new MongoDB\Driver\Manager(self::$uri);
            } catch (MongoDB\Driver\Exception\Exception $e) {
                die("Erreur de connexion à MongoDB : " . $e->getMessage());
            }
        }
        return self::$manager;
    }

    /**
     * Retourne le nom de la base de données
     */
    public static function getDatabaseName() {
        return self::$databaseName;
    }
}

/* Pour initialiser la connexion à MongoDB
$manager = DatabaseMongo::getManager();
$db = DatabaseMongo::getDatabaseName();
*/