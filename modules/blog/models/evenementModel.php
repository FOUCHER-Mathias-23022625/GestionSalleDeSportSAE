<?php

namespace blog\models;
use blog\models\bdModel;
require_once "modules/blog/models/bdModel.php";

class evenementModel{
    private $evenementBD;

    public function __construct() {
        try {
            $this->evenementBD = new bdModel();
        } catch (PDOException $e) {
            die("Erreur de connexion à la base de données : " . $e->getMessage());
        }
    }

    public function getEvenements() {

        try {
            $requete = $this->evenementBD->pdo->prepare("SELECT * FROM evenement");
            $result = $requete->execute();
            if (!$result) {
                throw new \Exception("Erreur lors de l'exécution de la requête SQL");
            }
            return $result = $requete->fetchAll(\PDO::FETCH_ASSOC);

        } catch (\Exception $e) {
            echo "Erreur : " . $e->getMessage();
            return [];
        }
    }

    public function isUserSubscribed($idEvenement, $nom_utilisateur) {
        $query = $this->evenementBD->pdo->prepare(("SELECT * FROM participation WHERE \"IdEvenement\" = :idEvenement AND \"nom_utilisateur\" = :nom_utilisateur"));
        $query->execute([
            ':idEvenement' => $idEvenement,
            ':nom_utilisateur' => $nom_utilisateur
        ]);

        return $query->rowCount() > 0;
    }

    public function subscribeUser($idEvenement, $nom_utilisateur) {
        $insert = $this->evenementBD->pdo->prepare(("INSERT INTO participation (\"IdEvenement\", \"nom_utilisateur\") VALUES (:idEvenement, :nom_utilisateur)"));
        return $insert->execute([
            ':idEvenement' => $idEvenement,
            ':nom_utilisateur' => $nom_utilisateur
        ]);
    }

    public function ajouteEven(){
        $nom = $_POST['NomEven'];
        $date = $_POST['DateEven'];
        $sport = $_POST['NomSport'];
        $requete = $this->evenementBD->pdo->prepare("INSERT INTO evenement (NomEven, DateEven, NomSport) VALUES (:nom, :date, :sport)");
        $requete->bindParam(":nom",$nom);
        $requete->bindParam(":date",$date);
        $requete->bindParam(":sport",$sport);
        $requete->execute();
    }

}
