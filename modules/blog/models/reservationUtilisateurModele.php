<?php

namespace blog\models;
use PDO;
require_once "modules/blog/models/bdModel.php";
class reservationUtilisateurModele
{

    private $connexion;

    public function __construct() {
        $this->connexion = new bdModel();
    }

    // Récupérer les réservations futures
    public function getReservationsFutures($userId)
    {
        $stmt = $this->connexion->pdo->prepare("SELECT * FROM reservationTerrain WHERE user_id = ? AND date >= CURDATE()");
        $stmt->execute([$userId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Récupérer les réservations passées
    public function getReservationsPassees($userId)
    {
        $stmt = $this->connexion->pdo->prepare("SELECT * FROM reservationTerrain WHERE user_id = ? AND date < CURDATE()");
        $stmt->execute([$userId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

}