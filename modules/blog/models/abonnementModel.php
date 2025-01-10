<?php

namespace blog\models;

class abonnementModel
{
    private $connexionBD;


    public function __construct()
    {
        $this->connexionBD = new bdModel();
    }

    public function infoAbo(){
        $requete = $this->connexionBD->pdo->prepare("SELECT idUtilisateur, DateExp, DateDeb FROM abonnement WHERE idUtilisateur = :id");
        $requete->bindParam(":id", $_SESSION['id']);
        $requete->execute();
        return $requete->fetch();
    }

    public function createAbo($mois){
        $requete = $this->connexionBD->pdo->prepare("UPDATE  abonnement SET DateDeb=:dateDeb, DateExp=:dateExp WHERE idUtilisateur =:id");

        $dateDeb = new \DateTime();  // date actuelle
        $dateDebFormatted = $dateDeb->format('Y-m-d');
        $dateExp = clone $dateDeb;  // Clonage de l'objet DateTime
        $dateExp->modify('+' . $mois . ' month');
        $dateExpFormatted = $dateExp->format('Y-m-d');

        $requete->bindParam(":dateDeb", $dateDebFormatted);
        $requete->bindParam(":dateExp", $dateExpFormatted);
        $requete->bindParam(":id", $_SESSION["id"]);
        $requete->execute();
        header("location: ../homepage/accueil");
    }

    public function changerAbo($mois){
        $requete = $this->connexionBD->pdo->prepare("UPDATE abonnement SET DateExp = :date WHERE idUtilisateur = :id");
        $date = $this->infoAbo()['DateExp'];
        $dateExp = new \DateTime($date); // Clonage de l'objet DateTime
        $dateExp->modify('+' . $mois . ' month');
        $dateFormatted = $dateExp->format('Y-m-d');
        $requete->bindParam(":date", $dateFormatted);
        $requete->bindParam(":id", $_SESSION['id']);
        $requete->execute();
        header("location: ../homepage/accueil");
    }
}