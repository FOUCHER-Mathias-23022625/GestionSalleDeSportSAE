<?php

namespace blog\controllers;
namespace controllers;

use blog\views\Layout;
use Index;
use blog\models\activiteModel;
use blog\views\activiteView;
require_once  "modules/blog/views/activiteView.php";
require_once  "modules/blog/models/activiteModel.php";
require_once "modules/blog/views/Layout.php";
//t
class activiteController
{
    public function __construct(){
        try {
            $activiteModel = new activiteModel();
        } catch (PDOException $e) {
            die("Erreur de connexion à la base de données : " . $e->getMessage());
        }
    }


    #Affichage la vue de la page activités
    public function nosActivites() {

        $activiteView = new activiteView();
        $activiteView->afficher();
    }
}