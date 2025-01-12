<?php

namespace controllers;
use blog\views\sportView;
use Index;

require_once  "modules/blog/views/sportView.php";
require_once  "./index.php";


class sportController
{

    #Affichage de la vue de la page des sports.
    public function nosSports()
    {
        $sportView = new sportView();
        $sportView->afficher();
    }
}
?>