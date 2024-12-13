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
        $requete = $this->connexionBD->pdo->prepare("SELECT NomU, PrenomU, EMail, mdp, pp,admin FROM utilisateur WHERE idUtilisateur=:idUtilisateur");
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

        if (isset($_FILES['image'])) {
            if ($_FILES['image']['error'] === UPLOAD_ERR_OK) {
                $image = $_FILES['image'];
                $tmpName = $image['tmp_name'];
                if(!move_uploaded_file($tmpName, 'assets/images/public/'.basename($image['name']))){
                    die();
                }
                $requete1 = $this->connexionBD->pdo->prepare("UPDATE utilisateur set pp=:image, NomU=:nom, PrenomU =:prenom, EMail =:mail where idUtilisateur=:id");
                $requete1->bindParam(":image",$image['name']);
                $requete1->bindParam(":nom",$_POST['NomCompte']);
                $requete1->bindParam(":prenom",$_POST['PrenomCompte']);
                $requete1->bindParam(":mail",$_Post['EmailCompte']);
                $requete1->bindParam(":id",$_SESSION['id']);
                $requete1->execute();
            } else {
                echo 'Erreur lors du téléchargement du fichier.';
            }
        } else {
            echo 'Aucun fichier téléchargé.';
            die();
        }










        $requete = $this->connexionBD->pdo->prepare("UPDATE utilisateur set NomU=:nom, PrenomU=:prenom, EMail=:email where idUtilisateur=:id");
        $requete->bindParam(":prenom", $_POST['PrenomCompte']);
        $requete->bindParam(":nom",$_POST['NomCompte']);
        $requete->bindParam(":email",$_POST['EmailCompte']);
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