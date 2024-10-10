<?php

namespace blog\controllers;
use blog\models\evenementModel;
use blog\views\evenementView;
require_once  "../views/evenementView.php";

class evenementController{


}
$evenementView  = new evenementView();
$evenementView->afficher();
?>