<?php

namespace controllers;
use blog\views\sportView;
use Index;

require_once  "modules/blog/views/sportView.php";
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