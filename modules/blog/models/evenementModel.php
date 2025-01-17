<?php

namespace blog\models;
use blog\models\bdModel;
use PDOException;
//t
require_once "modules/blog/models/bdModel.php";

class evenementModel{
    private \PDO $evenementBD;

    public function __construct() {
        try {
            $bd = new bdModel();
            $this->evenementBD = $bd->getConnexion();
        } catch (PDOException $e) {
            die("Erreur de connexion à la base de données : " . $e->getMessage());
        }
    }

    #Récupère les évènements présents dans la base de données pour les afficher dans la vue
    public function getEvenements() {

        try {
            $requete = $this->evenementBD->prepare("SELECT * FROM evenement");
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

    #Vérifie si un utilisateur est connecté ou pas
    public function isUserSubscribed($idEvenement, $nom_utilisateur) {
        $query = $this->evenementBD->prepare(("SELECT * FROM participation WHERE \"IdEvenement\" = :idEvenement AND \"nom_utilisateur\" = :nom_utilisateur"));
        $query->execute([
            ':idEvenement' => $idEvenement,
            ':nom_utilisateur' => $nom_utilisateur
        ]);

        return $query->rowCount() > 0;
    }

    #Inscris l'utilisateur à un évènement (pas encore fonctionnel)
    public function subscribeUser($idEvenement, $nom_utilisateur): bool
    {
        $insert = $this->evenementBD->prepare(("INSERT INTO inscription (\"IdEvenement\", \"nom_utilisateur\") VALUES (:idEvenement, :nom_utilisateur)"));
        return $insert->execute([
            ':idEvenement' => $idEvenement,
            ':nom_utilisateur' => $nom_utilisateur
        ]);
    }

    #Ajoute un évenement à la base de données.
    public function ajouteEven($nomEven, $dateEven, $nomSport): bool
    {
        $nom = $_POST['NomEven'];
        $date = $_POST['DateEven'];
        $sport = $_POST['NomSport'];
        $requete = $this->evenementBD->prepare("INSERT INTO evenement (NomEven, DateEven, NomSport) VALUES (:nom, :date, :sport)");
        $requete->bindParam(":nom",$nom);
        $requete->bindParam(":date",$date);
        $requete->bindParam(":sport",$sport);
        return $requete->execute();
    }

    #Supprime un évènement de la base de données
    public function supprimerEven($dateEven,$nomEven){
        $sql = "DELETE FROM evenement WHERE DateEven = :dateEven AND NomEven = :nomEven";
        $stmt = $this->evenementBD->prepare($sql);
        $stmt->bindParam(":dateEven",$dateEven);
        $stmt->bindParam(":nomEven",$nomEven);
        $stmt->execute();
    }


}
