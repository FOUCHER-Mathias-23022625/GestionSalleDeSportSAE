<?php

namespace controllers;
use blog\views\homepageView;
use Index;


require_once  "./index.php";


class homepageController
{
    public function accueil()
    {

        $homepageView = new homepageView();
        $homepageView->afficher();

    }
}
?>