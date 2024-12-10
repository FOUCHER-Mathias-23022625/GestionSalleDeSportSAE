<?php

namespace blog\controllers;
namespace controllers;

use blog\views\Layout;
use Index;
use blog\models\abonnementModel;
use blog\views\abonnementView;
require_once  "modules/blog/views/abonnementView.php";
require_once  "modules/blog/models/abonnementModel.php";
require_once "modules/blog/views/Layout.php";


class abonnementController
{
    public function __construct(){
        try {
            $abonnementModel = new abonnementModel();
        } catch (PDOException $e) {
            die("Erreur de connexion à la base de données : " . $e->getMessage());
        }
    }

    public function afficheAbonnement() {

        $abonnementView = new abonnementView();
        $abonnementView->afficher();
    }

}