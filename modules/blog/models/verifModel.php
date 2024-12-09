<?php

namespace blog\models;
use PDO;
use PDOException;

require_once "www/GestionSalleDeSportSAE/modules/blog/models/bdModel.php";

class verifModel
{
    private $connexionBD;

    public function __construct()
    {
        try {
            $this->connexionBD = new bdModel();
        } catch (PDOException $e) {
            die("Erreur de connexion à la base de données : " . $e->getMessage());
        }
    }


 public function requeteMois()
    {
        $requete = $this->connexionBD->pdo->prepare("SELECT idUtilisateur FROM abonnement WHERE dateExp = DATE_ADD(CURDATE(), INTERVAL 1 MONTH)");
        $requete->execute();
        $donnees = $requete->fetchAll(PDO::FETCH_ASSOC);

        if (!empty($donnees)) {
            foreach ($donnees as $id) {
                $requete2 = $this->connexionBD->pdo->prepare("SELECT EMail FROM utilisateur WHERE idUtilisateur = :idUtil");
                $requete2->bindParam(":idUtil", $id["idUtilisateur"]);
                $requete2->execute();
                $donnees2 = $requete2->fetchAll(PDO::FETCH_ASSOC);

                foreach ($donnees2 as $mail) {
                    mail($mail["EMail"], "Votre abonnement expire bientôt", "Bonjour, votre abonnement expire dans un mois !");
                }
            }
        } else {
            echo "Aucun abonnement expirant dans moins d'un mois.";
        }
    }

    public function requeteSemaine()
    {
        $requete = $this->connexionBD->pdo->prepare("SELECT idUtilisateur FROM abonnement WHERE dateExp = DATE_ADD(CURDATE(), INTERVAL 1 WEEK)");
        $requete->execute();
        $donnees = $requete->fetchAll(PDO::FETCH_ASSOC);

        if (!empty($donnees)) {
            foreach ($donnees as $id) {
                $requete2 = $this->connexionBD->pdo->prepare("SELECT EMail FROM utilisateur WHERE idUtilisateur = :idUtil");
                $requete2->bindParam(":idUtil", $id["idUtilisateur"]);
                $requete2->execute();
                $donnees2 = $requete2->fetchAll(PDO::FETCH_ASSOC);

                foreach ($donnees2 as $mail) {
                    mail($mail["EMail"], "Votre abonnement expire bientôt", "Bonjour, votre abonnement expire dans une semaine !");
                }
            }
        } else {
            echo "Aucun abonnement expirant dans moins d'un mois.";
        }
    }
}

// Instanciation et appel des deux fonctions
$instance = new verifModel();
$instance->requeteMois();
$instance->requeteSemaine();


?>

