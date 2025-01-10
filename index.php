<?php
require_once 'modules/blog/controllers/utilisateurController.php';
require_once 'modules/blog/controllers/evenementController.php';
require_once 'modules/blog/controllers/reservationTerrainController.php';
require_once 'modules/blog/controllers/performanceController.php';
require_once 'modules/blog/controllers/homepageController.php';
require_once 'modules/blog/controllers/reservationUtilisateurController.php';
require_once 'modules/blog/controllers/compteController.php';
require_once 'modules/blog/controllers/interfaceAdminController.php';
require_once 'modules/blog/controllers/abonnementController.php';
require_once 'modules/blog/controllers/activiteController.php';
require_once 'modules/blog/controllers/classementController.php';
require_once 'modules/blog/controllers/sportController.php';

//t


class index {
    public function url() {
        if (isset($_SERVER['REQUEST_URI'])) {
            $url = explode('/', trim($_SERVER['REQUEST_URI'], '/'));
            return $url;
        } else {
            return 'erreur';
        }
    }

    public function routeur($url) {
        if (isset($url[0]) && !empty($url[1])) {
            $controllerName =  'controllers\\' .$url[1].'Controller';

            if (class_exists($controllerName)) {
                $controller = new $controllerName();

                // Vérifier si la méthode existe dans le contrôleur
                if (isset($url[2]) && method_exists($controller, $url[2])) {
                    $methodName = $url[2];

                    // Extraire les paramètres supplémentaires de l'URL
                    $params = array_slice($url, 3);


                    // Appeler la méthode avec les paramètres
                    return call_user_func_array([$controller, $methodName], $params);
                } else {
                    header('location:/GestionSalleDeSportSAE/homepage/accueil') ;
                }
            } else {
                header('location:homepage/accueil') ;
            }
        } else {
            header('location:homepage/accueil') ;
        }
    }

}

// Instancier la classe Index et exécuter le routeur
$index = new Index();
$url = $index->url();

if (is_array($url)) {
    echo $index->routeur($url);
} else {
    header('location: index.php');
}
?>
