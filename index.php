<?php
require_once 'modules/blog/controllers/utilisateurController.php';
require_once 'modules/blog/controllers/evenementController.php';
require_once 'modules/blog/controllers/reservationTerrainController.php';
require_once 'modules/blog/controllers/performanceController.php';
require_once  'modules/blog/controllers/homepageController.php';


class Index {
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
                    return "Méthode non trouvée : " . $url[2];
                }
            } else {
                return "Contrôleur non trouvé : " . $controllerName;
            }
        } else {
            header('location:homepage/displayHome') ;
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
