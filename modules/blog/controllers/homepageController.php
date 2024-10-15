<?php

namespace blog\controllers;
use blog\views\homepageView;
use Index;

require_once  "modules/blog/views/evenementView.php";
require_once  "./index.php";

class homepageController
{
    public function displayHome()
    {
        $homepageView = new homepageView();
        $homepageView->afficher();

    }
}
?>