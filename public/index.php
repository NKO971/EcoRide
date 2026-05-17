<?php
// Initialiser la session et charger la BDD
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once __DIR__ . '/../app/config/db.php';

$page = $_GET['page'] ?? 'home'; // Page par défaut : home
switch ($page) {
    case 'mentions':
        require_once __DIR__ . '/../app/controllers/legal_controller.php';
        mentionsLegales($pdo);
        break;

    case 'home':
        require_once __DIR__ . '/../app/controllers/home_controller.php';
        homeController($pdo);
        break;

    case 'covoiturage':
        require_once __DIR__ . '/../app/controllers/covoiturage_controller.php';
        covoiturageController($pdo);
        break;

    case 'connexion':
        require_once __DIR__ . '/../app/controllers/auth_controller.php';
        loginController($pdo); 
        break;

    case 'inscription':
        require_once __DIR__ . '/../app/controllers/auth_controller.php';
        registerController($pdo); 
        break;

    case 'contact':
        require_once __DIR__ . '/../app/controllers/contact_controller.php';
        contactController($pdo);
        break;

    case 'profile':
        require_once __DIR__ . '/../app/controllers/profile_controller.php';
        profileController($pdo);
        break;

    case 'employee':
        require_once __DIR__ . '/../app/controllers/employee_controller.php';
        employeeController($pdo);
        break;

    case 'admin':
        require_once __DIR__ . '/../app/controllers/admin_controller.php';
        adminController($pdo);
        break;

    default:
        // Page par défaut: redirection vers home
        header("Location: ?page=home");
        exit();
}