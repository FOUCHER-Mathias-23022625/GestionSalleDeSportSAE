<?php

namespace blog\models;

use PDO;
class reservationTerrainModele
{
    private $connexion;

    public function __construct($host_name, $user_name, $password, $database_name) {
        $this->connexion = new PDO("mysql:host=$host_name;dbname=$database_name", $user_name, $password);
    }

    public function getReservationTerrain(){
        $request_res = "SELECT * FROM reservation_terrain ORDER BY heure";
        return $this->connexion->query($request_res)->fetchAll(PDO::FETCH_ASSOC);
    }
}