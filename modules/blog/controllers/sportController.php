<?php

namespace controllers;
use blog\views\sportView;
use index;





class sportController
{
    public function nosSports()
    {

        $sportView = new sportView();
        $sportView->afficher();

    }
}
?>