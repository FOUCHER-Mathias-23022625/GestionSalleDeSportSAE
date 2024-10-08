<?php
namespace blog\controllers;

require_once __DIR__ . '/../models/performanceModel.php';

use blog\models\performanceModel;

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
        include __DIR__ . "/../views/performanceView.php"; // Inclut la vue et passe les données
    }
}
