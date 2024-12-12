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
    $stmt = $this->connexion->pdo->prepare("DELETE FROM evenement WHERE id = ?");
    $stmt->execute([$eventId]);
    }

    public function deleteReservation($sport,$userId,$date,$heure){
        $stmt = $this->connexion->pdo->prepare("DELETE FROM reservationTerrain WHERE sport = ? AND user_id = ? AND date = ? AND heure = ?");
        $stmt->execute([$sport,$userId,$date,$heure]);
    }
}