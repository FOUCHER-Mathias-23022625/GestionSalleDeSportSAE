<?php
namespace blog\controllers;

require_once __DIR__ . '/../models/performanceModel.php';

use blog\models\performanceModel;

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

class performanceController {
    private $model;

    public function __construct()
    {
        $host_name = "127.0.0.1";
        $user_name = "root";
        $password = "";
        $database_name = "saetest";

        $this->model = new performanceModel($host_name, $user_name, $password, $database_name);
    }

    public function showPerformance() {
        $performance = $this->model->getPerformances(); // Récupère les données de la base
        if (file_exists(__DIR__ . "/../views/performanceView.php")) {
            include __DIR__ . "/../views/performanceView.php";
        } else {
            echo "Vue non trouvée";
        } // Inclut la vue et passe les données
    }
}
