<?php

namespace blog\models;

use PDO;
class reservationTerrainModele
{
    private $connexion;

    public function __construct($host_name, $user_name, $password, $database_name) {
        $this->connexion = new PDO("mysql:host=$host_name;dbname=$database_name", $user_name, $password);
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
        $stmt = $this->connexion->prepare($query);

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
        // Connexion à la base de données
        // Requête pour insérer la réservation dans la base de données
        $stmt = $this->connexion->prepare("INSERT INTO reservationTerrain (sport, date, heure, terrain, user_id) VALUES (?, ?, ?, ?,?)");

        if ($stmt->execute([$sport, $date, $heure, $terrain, $userId])) {
            return json_encode(['status' => 'success', 'message' => 'Réservation réussie']);
        } else {
            return json_encode(['status' => 'error', 'message' => 'Erreur lors de la réservation']);
        }
    }
}