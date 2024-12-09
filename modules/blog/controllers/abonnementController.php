<?php

namespace blog\controllers;

use blog\models\abonnementModel;
use blog\models\evenementModel;
use blog\views\abonnementView;
use blog\views\evenementView;

class abonnementController
{
    public function __construct(){
        try {
            $abonnementModel = new abonnementModel();
        } catch (PDOException $e) {
            die("Erreur de connexion à la base de données : " . $e->getMessage());
        }
    }

    public function abonnements() {

        $abonnementView = new abonnementView();
        $abonnementView->afficher();
    }

}