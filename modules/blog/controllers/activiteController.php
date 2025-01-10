<?php

namespace blog\controllers;
namespace controllers;

use blog\views\Layout;
use Index;
use blog\models\activiteModel;
use blog\views\activiteView;



class activiteController
{
    public function __construct(){
        try {
            $activiteModel = new activiteModel();
        } catch (PDOException $e) {
            die("Erreur de connexion à la base de données : " . $e->getMessage());
        }
    }

    public function nosActivites() {

        $activiteView = new activiteView();
        $activiteView->afficher();
    }
}