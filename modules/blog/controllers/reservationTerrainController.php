<?php

namespace blog\controllers;

use blog\models\reservationTerrainModele;
use blog\views\reservationTerrainView;

require_once 'modules/blog/models/reservationTerrainModele.php';
class reservationTerrainController
{
    private $reservationTerrainModele;

    public function __construct() {
        $host_name = "mysql-gestionsaetest.alwaysdata.net";
        $user_name = "379076";
        $password  = "gestionSae";
        $database_name = "gestionsaetest_bd";

        $this->reservationTerrainModele = new reservationTerrainModele($host_name, $user_name, $password, $database_name);
    }

    public function displayReservationTerrain()
    {
        $reservation = $this ->reservationTerrainModele ->getReservationTerrain();
        $view = new ReservationTerrainView();
        $view->afficher($reservation);
    }

}