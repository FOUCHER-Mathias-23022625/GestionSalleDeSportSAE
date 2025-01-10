<?php

namespace controllers;
use blog\views\sportView;
use Index;


require_once  "./index.php";


class sportController
{
    public function nosSports()
    {

        $sportView = new sportView();
        $sportView->afficher();

    }
}
?>