<?php
namespace blog\models;
require_once 'modules/blog/views/compteView.php';
class compteModel
{
    private $connexionBD;


    public function __construct()
    {
        $this->connexionBD = new bdModel();
    }

    public function utilisateurInformation()
    {
        $requete = $this->connexionBD->pdo->prepare("SELECT NomU, PrenomU, EMail, mdp FROM utilisateur WHERE idUtilisateur=:idUtilisateur");
        $requete->bindParam(":idUtilisateur", $_SESSION["id"]);
        $requete->execute();
        $requete = $requete->fetch();
        return $requete;
    }

    public function dateDeb_dateFin()
    {
        $requete = $this->connexionBD->pdo->prepare("SELECT DateDeb, DateExp from abonnement where idUtilisateur =:idUtilisateur");
        $requete->bindParam(":idUtilisateur", $_SESSION["id"]);
        $requete->execute();
        $requete = $requete->fetch();
        return $requete;

    }

    public function edit_utilisateur()
    {

        $content = file_get_contents($_FILES['pp']);

        $requete = $this->connexionBD->pdo->prepare("UPDATE utilisateur set NomU=:nom, PrenomU=:prenom, EMail=:email, mdp=:mdp, pp=:content where idUtilisateur=:id");
        $requete->bindParam(":prenom", $_POST['PrenomCompte']);
        $requete->bindParam(":nom",$_POST['NomCompte']);
        $requete->bindParam(":email",$_POST['EmailCompte']);
        $requete->bindParam(":mdp",$_POST['MdpCompte']);
        $requete->bindParam(":content",$content);
        $requete->bindParam(":id",$_SESSION['id']);
        $requete->execute();
    }


    public function changementMotDePasse($nvMdp){
        $hashedMdp = password_hash($nvMdp, PASSWORD_DEFAULT);
        $requete = $this->connexionBD->pdo->prepare("UPDATE utilisateur SET mdp=:mdp where idUtilisateur =:idUtilisateur");
        $requete->bindParam(":idUtilisateur",$_SESSION['id']);
        $requete->bindParam(":mdp",$hashedMdp);
        $requete->execute();



    }
}