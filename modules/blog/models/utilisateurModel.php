<?php
namespace models;
namespace blog\models;
use blog\models\bdModel;
//use PDO;
use PDOException;


require_once 'modules/blog/models/bdModel.php';

class utilisateurModel {
    private $connexionBD;

    public function __construct() {
        try {
            $this->connexionBD = new bdModel();
        } catch (PDOException $e) {
            die("Erreur de connexion à la base de données : " . $e->getMessage());
        }
    }



    public function ajouteUtilisateur($mail, $mdp,$prenom,$nom) {
        $requete = $this->connexionBD->pdo->prepare("INSERT INTO utilisateur (EMail, mdp, PrenomU, NomU) VALUES (:mail, :mdp, :prenom, :nom)");
        $hashedMdp = password_hash($mdp, PASSWORD_DEFAULT);
        $requete->bindParam(":mail", $mail);
        $requete->bindParam(":mdp", $hashedMdp);
        $requete->bindParam(":prenom", $prenom);
        $requete->bindParam(":nom", $nom);
        $requete->execute();

        $requete2 = $this->connexionBD->pdo->prepare("SELECT idUtilisateur FROM utilisateur WHERE EMail = :mail");
        $requete2->bindParam(":mail", $mail);
        $requete2->execute();
        $donnees = $requete2->fetch();
        $_SESSION['id'] = $donnees['idUtilisateur'];

        $abo = $this->connexionBD->pdo->prepare("INSERT INTO abonnement (idUtilisateur, DateDeb, DateExp) VALUES (:idUtilisateur, NULL, NULL)");
        $abo->bindParam(":idUtilisateur", $_SESSION['id']);
        $abo->execute();
        return true;
    }

    public function delete_utilisateur($idUtilisateur) {
        $requete = $this->connexionBD->pdo->prepare("DELETE FROM utilisateur WHERE idUtilisateur = :idUtilisateur");
        $requete->bindParam(":idUtilisateur", $idUtilisateur);
        $requete->execute();
        return true;
    }

    public function connexion($mail, $mdp) {
        $requeteConnexion = $this->connexionBD->pdo->prepare("SELECT idUtilisateur, EMail, mdp, admin FROM utilisateur WHERE EMail = :mail");
        $requeteConnexion->bindParam(':mail', $mail);

        if ($requeteConnexion->execute()) {
            $donnees = $requeteConnexion->fetch();
            if ($donnees && password_verify($mdp, $donnees['mdp'])) {
                $_SESSION['id'] = $donnees['idUtilisateur'];
                if($donnees['admin']==1){
                    $_SESSION["admin"] = 1;
                }
                header('Location:../homepage/accueil');

            return true;
            }
            header('Location:../homepage/accueil');
        }
        return false;
    }

    public function utilisateurMail($mail){
        $requeteMail = $this->connexionBD->pdo->prepare("SELECT EMail FROM utilisateur WHERE EMAIL = :mail");
        $requeteMail->bindParam(':mail', $mail);
        $requeteMail->execute();
        $_SESSION['testMail']=$requeteMail->fetchAll();
        if(isset($_SESSION['testMail'])){
            return true;
        }
        else{
            return false;
        }
    }

    public function changementMotDePasse($nvMdp, $mail){
        $hashedMdp = password_hash($nvMdp, PASSWORD_DEFAULT);
        $requete = $this->connexionBD->pdo->prepare("UPDATE utilisateur SET mdp=:mdp where EMail =:mail");
        $requete->bindParam(":mail",$mail);
        $requete->bindParam(":mdp",$hashedMdp);
        $requete->execute();
    }

}
?>