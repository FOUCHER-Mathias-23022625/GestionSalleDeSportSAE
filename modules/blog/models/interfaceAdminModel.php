<?php

namespace blog\models;
require_once "modules/blog/models/bdModel.php";

use PDO;

class interfaceAdminModel
{

    private $connexion;

    public function __construct() {
        $this->connexion = new bdModel();
    }

    public function GetAllUsers(){
        $sql = "SELECT * FROM utilisateur";
        $stmt = $this->connexion->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function GetAllReservations(){
        $sql = "SELECT * FROM reservationTerrain";
        $stmt = $this->connexion->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function GetAllEvenements(){
        $sql = "SELECT * FROM Evenement";
        $stmt = $this->connexion->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
}