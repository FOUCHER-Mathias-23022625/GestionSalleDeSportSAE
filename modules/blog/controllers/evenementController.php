<?php

namespace blog\controllers;
use blog\models\evenementModel;
use blog\views\evenementView;
require_once  "../views/evenementView.php";

class evenementController{


    public function afficheEvenement()
    {
        $evenementView = new evenementView();
        $evenementView->afficher();

    }
}
?>