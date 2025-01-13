<?php
namespace blog\models;

use PDO;

class interfaceAdminModel
{

    private $connexion;

    // Constructeur : initialise la connexion à la base de données
    public function __construct() {
        $this->connexion = new bdModel();
    }

    // Récupère tous les utilisateurs dans la table 'utilisateur'
    public function GetAllUsers(){
        $sql = "SELECT * FROM utilisateur";
        $stmt = $this->connexion->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    // Récupère toutes les réservations dans la table 'reservationTerrain'
    public function GetAllReservations(){
        $sql = "SELECT * FROM reservationTerrain";
        $stmt = $this->connexion->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    // Récupère tous les événements dans la table 'evenement'
    public function GetAllEvenements(){
        $sql = "SELECT * FROM evenement";
        $stmt = $this->connexion->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    // Supprime un utilisateur et son abonnement en fonction de son ID
    public function deleteUserMod($userId){
        $stmt = $this->connexion->pdo->prepare("DELETE FROM utilisateur WHERE IdUtilisateur = :userId");
        $stmt2 = $this->connexion->pdo->prepare("DELETE FROM abonnement WHERE IdUtilisateur = :userId");
        $stmt->bindParam(":userId", $userId);
        $stmt2->bindParam(":userId", $userId);
        $stmt2->execute();
        $stmt->execute();
    }

    // Met à jour les informations d'un utilisateur (nom, prénom, email, admin) en fonction de son ID
    public function updateUserMod($userId, $nom, $prenom, $email, $admin){
        $stmt = $this->connexion->pdo->prepare("UPDATE  NomU = :nom, PrenomU = :prenom, EMail = :email, admin = :admin WHERE IdUtilisateur = :userId");
        $stmt->bindParam(":userId", $userId);
        $stmt->bindParam(":nom", $nom);
        $stmt->bindParam(":prenom", $prenom);
        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":admin", $admin);
        $stmt->execute();
    }

    // Supprime un événement en fonction de son ID
    public function deleteEvent($eventId){
        $stmt = $this->connexion->pdo->prepare("DELETE FROM evenement WHERE IdEvenement = ?");
        $stmt->execute([$eventId]);
    }

    // Met à jour une réservation (sport, utilisateur, date, heure, terrain) en fonction de ses critères
    public function updateReservationMod($sport, $userId, $date, $heure, $terrain)
    {
        $stmt = $this->connexion->pdo->prepare("UPDATE reservationTerrain SET sport = :sport, user_id = :user_id, date = :date, heure = :heure, terrain = :terrain  WHERE sport = :sport AND user_id = :user_id AND date = :date AND heure = :heure ");
        $stmt->bindParam(":sport", $sport);
        $stmt->bindParam(":user_id", $userId);
        $stmt->bindParam(":date", $date);
        $stmt->bindParam(":heure", $heure);
        $stmt->bindParam(":terrain", $terrain);
        $stmt->execute();
    }

    // Supprime une réservation en fonction de plusieurs critères (sport, utilisateur, date, heure)
    public function deleteReservationMod($sport, $userId, $date, $heure){
        $stmt = $this->connexion->pdo->prepare("DELETE FROM reservationTerrain WHERE sport = ? AND user_id = ? AND date = ? AND heure = ?");
        $stmt->execute([$sport, $userId, $date, $heure]);
    }

    // Met à jour un événement (nom, date, sport) en fonction de son ID
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
