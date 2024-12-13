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
        $stmt = $this->connexion->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function GetAllReservations(){
        $sql = "SELECT * FROM reservationTerrain";
        $stmt = $this->connexion->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function GetAllEvenements(){
        $sql = "SELECT * FROM evenement";
        $stmt = $this->connexion->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function deleteUserMod($userId){
        $stmt = $this->connexion->pdo->prepare("DELETE FROM utilisateur WHERE IdUtilisateur = :userId");
        $stmt2 = $this->connexion->pdo->prepare("DELETE FROM abonnement WHERE IdUtilisateur = :userId");
        $stmt->bindParam(":userId", $userId);
        $stmt2->bindParam(":userId", $userId);
        $stmt2->execute();
        $stmt->execute();
    }

    public function updateUserMod($userId,$nom,$prenom,$email,$admin){
        $stmt = $this->connexion->pdo->prepare("UPDATE utilisateur SET NomU = :nom, PrenomU = :prenom, EMail = :email, admin = :admin WHERE IdUtilisateur = :userId");
        $stmt->bindParam(":userId", $userId);
        $stmt->bindParam(":nom", $nom);
        $stmt->bindParam(":prenom", $prenom);
        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":admin", $admin);
        $stmt->execute();
    }

    public function deleteEvent($eventId){
    $stmt = $this->connexion->pdo->prepare("DELETE FROM evenement WHERE IdEvenement = ?");
    $stmt->execute([$eventId]);
    }

    public function updateReservationMod($reservationId, $sport, $userId, $date, $heure, $terrain)
    {
        $stmt = $this->connexion->pdo->prepare("UPDATE reservations SET sport = :sport, user_id = :user_id, date = :date, heure = :heure, terrain = :terrain WHERE id = :reservation_id");
        $stmt->bindParam(":reservation_id", $reservationId);
        $stmt->bindParam(":sport", $sport);
        $stmt->bindParam(":user_id", $userId);
        $stmt->bindParam(":date", $date);
        $stmt->bindParam(":heure", $heure);
        $stmt->bindParam(":terrain", $terrain);
        $stmt->execute();
    }


    public function deleteReservationMod($sport,$userId,$date,$heure){
        $stmt = $this->connexion->pdo->prepare("DELETE FROM reservationTerrain WHERE sport = ? AND user_id = ? AND date = ? AND heure = ?");
        $stmt->execute([$sport,$userId,$date,$heure]);
    }

    public function updateEvenementMod($evenementId, $nomEven, $dateEven, $nomSport)
    {
        $stmt = $this->connexion->pdo->prepare("UPDATE evenement SET NomEven = :nom_even, DateEven = :date_even, NomSport = :nom_sport WHERE IdEvenement = :evenement_id");
        $stmt->bindParam(":evenement_id", $evenementId);
        $stmt->bindParam(":nom_even", $nomEven);
        $stmt->bindParam(":date_even", $dateEven);
        $stmt->bindParam(":nom_sport", $nomSport);
        $stmt->execute();
    }
}