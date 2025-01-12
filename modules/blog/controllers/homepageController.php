<?php

namespace controllers;
use blog\views\homepageView;
use index;

require_once "modules/blog/views/homepageView.php";
require_once  "./index.php";
//t

class homepageController
{

    #Affichage de la vue de la page d'accueil
    public function accueil()
    {
        $homepageView = new homepageView();
        $homepageView->afficher();
    }
}
?>