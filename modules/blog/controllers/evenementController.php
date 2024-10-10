<?php

namespace controllers;
use blog\models\evenementModel;
use blog\views\evenementView;
use Index;
require_once  "modules/blog/views/evenementView.php";
require_once  "./index.php";

class evenementController{


    public function afficheEvenement()
    {
        $evenementView = new evenementView();
        $evenementView->afficher();

    }
}
?>