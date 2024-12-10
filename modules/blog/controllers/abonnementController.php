<?php

namespace blog\controllers;

use blog\models\abonnementModel;
use blog\views\abonnementView;

class abonnementController
{
    public function __construct(){
        try {
            $abonnementModel = new abonnementModel();
        } catch (PDOException $e) {
            die("Erreur de connexion à la base de données : " . $e->getMessage());
        }
    }

    public function afficher() {

        $abonnementView = new abonnementView();
        $abonnementView->afficher();
    }

}