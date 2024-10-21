<?php
namespace blog\models;
use PDO;
use PDOException;

require_once "modules/blog/models/bdModel.php";

class utilisateurModel {
    private $connexionBD;

    public function __construct() {
        try {
            $this->connexionBD = new bdModel();
        } catch (PDOException $e) {
            die("Erreur de connexion à la base de données : " . $e->getMessage());
        }
    }

    public function ajouteUtilisateur($mail, $mdp) {
        $requete = $this->connexionBD->pdo->prepare("INSERT INTO utilisateur (EMail, mdp) VALUES (:mail, :mdp)");
        $hashedMdp = password_hash($mdp, PASSWORD_DEFAULT);
        $requete->bindParam(":mail", $mail);
        $requete->bindParam(":mdp", $hashedMdp);
        $requete->execute();

        $requete2 = $this->connexionBD->pdo->prepare("SELECT idUtilisateur FROM utilisateur WHERE EMail = :mail");
        $requete2->bindParam(":mail", $mail);
        $requete2->execute();
        $donnees = $requete2->fetch();
        $_SESSION['id'] = $donnees['idUtilisateur'];

        $abo = $this->connexionBD->pdo->prepare("INSERT INTO abonnement (idUtilisateur, DateDeb, DateExp) VALUES (:idUtilisateur, :dateDeb, :dateExp)");
        $abo->bindParam(":idUtilisateur", $_SESSION['id']);

        $dateDeb = new \DateTime();  // date actuelle
        $dateDebFormatted = $dateDeb->format('Y-m-d H:i:s');
        $dateExp = clone $dateDeb;  // Clonage de l'objet DateTime
        $dateExp->modify('+1 year');
        $dateExpFormatted = $dateExp->format('Y-m-d H:i:s');

        $abo->bindParam(":dateDeb", $dateDebFormatted);
        $abo->bindParam(":dateExp", $dateExpFormatted);
        $abo->execute();
    }

    public function delete_utilisateur($idUtilisateur) {
        $requete = $this->connexionBD->pdo->prepare("DELETE FROM utilisateur WHERE idUtilisateur = :idUtilisateur");
        $requete->bindParam(":idUtilisateur", $idUtilisateur);
        $requete->execute();
    }

    public function connexion($mail, $mdp) {
        $requeteConnexion = $this->connexionBD->pdo->prepare("SELECT idUtilisateur, EMail, mdp FROM utilisateur WHERE EMail = :mail");
        $requeteConnexion->bindParam(':mail', $mail);

        if ($requeteConnexion->execute()) {
            $donnees = $requeteConnexion->fetch();
            if ($donnees && password_verify($mdp, $donnees['mdp'])) {
                $_SESSION['id'] = $donnees['idUtilisateur'];
                header('Location:afficheFormConnexion/');
            } else {
                header('Location:eee');
            }
        }
    }
}
?>