<?php
/**
 * Classe BaseController - Centralise la logique commune de tous les controllers
 * Gère l'initialisation des CSS/JS et l'affichage des vues
 * 
 * @author Refactorisation
 * @version 1.0
 */
class BaseController {
    
    /**
     * Affiche une page avec header/footer et assets dynamiques
     * 
     * @param string $title .......... Titre de la page
     * @param string $viewFile ....... Nom du fichier view (sans chemin)
     * @param array $additionalCss .. CSS supplémentaires spécifiques
     * @param array $additionalJs ... JS supplémentaires spécifiques
     * 
     * @example BaseController::render("Accueil", "home.view.php");
     * @example BaseController::render("Contact", "contact.view.php", ["/EcoRide/css/contact.css"]);
     */
    public static function render($title, $viewFile, $additionalCss = [], $additionalJs = []) {
        
        // CSS par défaut (présents dans chaque page)
        $specificCss = array_merge([
            "/EcoRide/css/bootstrap.min.css",
            "/EcoRide/css/base.css",
            "/EcoRide/css/mediaquerise_base.css"
        ], $additionalCss);
        
        // JS par défaut (présents dans chaque page)
        $specificJS = array_merge([
            "/EcoRide/js/bootstrap.bundle.min.js",
            "/EcoRide/js/jquery-3.7.1.min.js"
        ], $additionalJs);
        
        // Inclusions dans le bon ordre
        require_once __DIR__ . '/../../includes/header.php';
        require_once __DIR__ . '/../views/' . $viewFile;
        require_once __DIR__ . '/../../includes/footer.php';
    }
}
?>