<?php

namespace blog\models;
require_once "modules/blog/models/bdModel.php";

use PDO;
class reservationTerrainModele
{
    private $connexion;

    public function __construct() {
        $this->connexion = new bdModel();
    }

    /*public function getReservationTerrain($date, $sport){
        if (empty($date) || empty($sport)) {
            return []; // Retournez un tableau vide si l'un des paramètres est manquant
        }
        $request_res = "SELECT * FROM reservationTerrain Where sport =$sport and date= $date ORDER BY heure";
        return $this->connexion->query($request_res)->fetchAll(PDO::FETCH_ASSOC);
    } */

    public function getReservationTerrain($date, $sport, $terrain) {
        // Vérifiez que les paramètres $date et $sport ne sont pas vides
        if (empty($date) || empty($sport) || empty($terrain)) {
            return []; // Retournez un tableau vide si l'un des paramètres est manquant
        }

        // Requête SQL avec des placeholders
        $query = "SELECT * FROM reservationTerrain WHERE sport = :sport AND date = :date AND terrain = :terrain ORDER BY heure";

        // Préparation de la requête
        $stmt = $this->connexion->pdo->prepare($query);

        // Liaison des paramètres sécurisée
        $stmt->bindParam(':sport', $sport);
        $stmt->bindParam(':date', $date);
        $stmt->bindParam(':terrain', $terrain);

        // Exécution de la requête
        $stmt->execute();

        // Retour des résultats
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function insererReservation($sport, $date, $heure, $terrain, $userId)
    {
        // Vérifier le nombre de réservations pour l'utilisateur à la date donnée
        $stmt = $this->connexion->pdo->prepare("SELECT COUNT(*) FROM reservationTerrain WHERE user_id = ? AND date = ?");
        $stmt->execute([$userId, $date]);
        $reservationCount = $stmt->fetchColumn();

        if ($reservationCount >= 2) {
            return json_encode(['status' => 'error', 'message' => 'Vous ne pouvez pas reserver plus de 2 créneaux horaires par jour.']);
        }

        // Vérifier les créneaux horaires pour des sports différents
        $stmt = $this->connexion->pdo->prepare("SELECT COUNT(*) FROM reservationTerrain WHERE user_id = ? AND date = ? AND heure = ?");
        $stmt->execute([$userId, $date, $heure]);
        $timeSlotCount = $stmt->fetchColumn();

        if ($timeSlotCount > 0) {
            return json_encode(['status' => 'error', 'message' => 'Vous avez déjà réservé un créneau horaire pour un autre sport à cette heure.']);
        }

        // Insérer la réservation
        $stmt = $this->connexion->pdo->prepare("INSERT INTO reservationTerrain (sport, date, heure, terrain, user_id) VALUES (?, ?, ?, ?, ?)");
        if ($stmt->execute([$sport, $date, $heure, $terrain, $userId])) {
            return json_encode(['status' => 'success', 'message' => 'Réservation réussie']);
        } else {
            return json_encode(['status' => 'error', 'message' => 'Erreur lors de la réservation']);
        }
    }
}