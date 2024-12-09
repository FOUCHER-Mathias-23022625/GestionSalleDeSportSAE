<?php

    namespace blog\models;
use PDO;
use PDOException;

require_once "modules/blog/models/bdModel.php";

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

    public function requete(){
        $requete = $this->connexionBD->pdo->prepare(" SELECT idUtilisateur FROM abonnement WHERE dateExp < DATE_ADD(CURDATE(), INTERVAL 1 MONTH)");
        $requete->execute();
        $donnees = $requete->fetch();
        foreach ($donnees as $id) {
            $requete2 = $this->connexionBD->pdo->prepare(" Select EMail from utilisateur where idUtilisateur =:idUtil");
            $requete2->bindParam(":idUtil", $id["idUtilisateur"]);
            $requete2->execute();
            $donnees2 = $requete2->fetch();
            foreach ($donnees2 as $mail){
                mail($mail["EMail"], "Votre abonnement expire bientot", "Bonjour vôtre abonnement expire dans un mois ! ");
            }

        }
        $this->construct = new verifModel();
        $this->construct->requete();

    }
}
?>

