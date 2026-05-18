<?php
class User {
    private $db;

    // On injecte la connexion PDO à la création de l'objet
    public function __construct($pdo) {
        $this->db = $pdo;
    }

    /**
     * Inscription avec injection de 20 crédits
     */
    public function register($nom, $prenom, $pseudo, $email, $password) {
        $hash = password_hash($password, PASSWORD_BCRYPT);
        
        // On force le role_id à 3 (User) et les crédits à 20
        $sql = "INSERT INTO utilisateur (nom, prenom, pseudo, email, password, role_id, solde_credits) 
                VALUES (:nom, :prenom, :pseudo, :email, :password, 3, 20)";
        
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            'nom'      => $nom,
            'prenom'   => $prenom,
            'pseudo'   => $pseudo,
            'email'    => $email,
            'password' => $hash
        ]);
    }

    /**
     *L'Admin crée un compte employé
     * role_id = 2, solde_credits = 0
     */
    public function createEmployee($pseudo, $email, $password) {
        $hash = password_hash($password, PASSWORD_BCRYPT);
        // On force le role_id à 2 (Employé) et les crédits à 0
        $sql = "INSERT INTO utilisateur (pseudo, email, password, role_id, solde_credits) 
                VALUES (:pseudo, :email, :password, 2, 0)";
        
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            'pseudo'   => $pseudo,
            'email'    => $email,
            'password' => $hash
        ]);
    }

    /**
     * Connexion : Vérifie l'email et le mot de passe
     */
    public function login($email, $password) {
        $stmt = $this->db->prepare("SELECT * FROM utilisateur WHERE email = :email");
        $stmt->execute(['email' => $email]);
        $user = $stmt->fetch();

        // Si l'utilisateur existe, on vérifie le mot de passe haché
        if ($user && password_verify($password, $user['password'])) {
            return $user;
        }
        return false;
    }

    /**
     * Récupère un utilisateur par ID
     */
    public function getById($id) {
        $stmt = $this->db->prepare("SELECT * FROM utilisateur WHERE utilisateur_id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Récupère tous les utilisateurs
     */
    public function getAll() {
        $stmt = $this->db->prepare("SELECT * FROM utilisateur");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Met à jour le profil d'un utilisateur
     */
    public function updateProfile($id, $pseudo, $email, $nom, $prenom, $adresse, $date_naissance, $telephone) {
        $sql = "UPDATE utilisateur 
        SET pseudo = :pseudo,
         email = :email,
         nom = :nom,
         prenom = :prenom,
         adresse = :adresse,
         date_naissance = :date_naissance,
         telephone = :telephone
        WHERE utilisateur_id = :id";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            'id'             => $id,
            'pseudo'         => $pseudo,
            'email'          => $email,
            'nom'            => $nom,
            'prenom'         => $prenom,
            'adresse'        => $adresse,
            'date_naissance' => $date_naissance, // Sera inséré comme NULL en BDD si la valeur est null
        'telephone'      => $telephone
        ]);
    }

    /**
     * Guard : Méthode statique pour vérifier les permissions
     */
    public static function canAccess($requiredRoleId) {
        if (!isset($_SESSION['role_id'])) {
            return false;
        }
        return (int)$_SESSION['role_id'] === (int)$requiredRoleId;
    }
}