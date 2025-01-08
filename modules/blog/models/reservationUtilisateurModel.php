<?php

namespace blog\models;
use PDO;
require_once "modules/blog/models/bdModel.php";
class reservationUtilisateurModel
{

    private $connexion;

    public function __construct() {
        $this->connexion = new bdModel();
    }

    // Récupérer les réservations futures
    public function getReservationsFutures($userId)
    {
        $stmt = $this->connexion->pdo->prepare("SELECT * FROM reservationTerrain WHERE user_id = ? AND date >= CURDATE() ORDER BY date ASC");
        $stmt->execute([$userId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Récupérer les réservations passées
    public function getReservationsPassees($userId)
    {
        $stmt = $this->connexion->pdo->prepare("SELECT * FROM reservationTerrain WHERE user_id = ? AND date < CURDATE() ORDER BY date ASC");
        $stmt->execute([$userId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function deleteReservation($userId, $sport, $date, $heure)
    {
        $stmt = $this->connexion->pdo->prepare("DELETE FROM reservationTerrain WHERE user_id = ? AND sport = ? AND date = ? AND heure = ?");
        $stmt->execute([$userId, $sport, $date, $heure]);
    }

}