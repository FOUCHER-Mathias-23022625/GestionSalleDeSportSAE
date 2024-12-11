<?php
namespace blog\models;

use PDO;

class classementModel {
    private $connexion;

    public function __construct() {
        try {
            $bd = new bdModel();
            $this->connexion = $bd->getConnexion();
        } catch (\PDOException $e) {
            // En cas d'erreur, afficher le message et arrêter l'exécution
            echo "Erreur de connexion à la base de données : " . $e->getMessage();
            exit; // Stoppe l'exécution en cas de problème de connexion
        }
    }

}
