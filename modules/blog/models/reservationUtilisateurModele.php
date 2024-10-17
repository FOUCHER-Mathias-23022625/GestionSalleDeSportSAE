<?php

namespace blog\models;
use PDO;

class reservationUtilisateurModele
{

    private $connexion;

    public function __construct($host_name, $user_name, $password, $database_name) {
        $this->connexion = new PDO("mysql:host=$host_name;dbname=$database_name", $user_name, $password);
    }

    // Récupérer les réservations futures
    public function getReservationsFutures($userId)
    {
        $stmt = $this->connexion->prepare("SELECT * FROM reservationTerrain WHERE user_id = ? AND date >= CURDATE()");
        $stmt->execute([$userId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Récupérer les réservations passées
    public function getReservationsPassees($userId)
    {
        $stmt = $this->connexion->prepare("SELECT * FROM reservationTerrain WHERE user_id = ? AND date < CURDATE()");
        $stmt->execute([$userId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

}