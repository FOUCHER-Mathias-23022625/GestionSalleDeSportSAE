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
                $requete1 = $this->connexionBD->pdo->prepare("UPDATE utilisateur set pp=:image where idUtilisateur=:id");
                $requete1->bindParam(":image",$image['name']);
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
        if (!isset($_POST['PrenomCompte'])) {
            $_POST['PrenomCompte'] = $this->utilisateurInformation()['PrenomU'];
        }
        if (!isset($_POST['NomCompte'])) {
            $_POST['NomCompte'] = $this->utilisateurInformation()['NomU'];
        }
        if (!isset($_POST['EmailCompte'])) {
            $_POST['EmailCompte'] = $this->utilisateurInformation()['EMail'];
        }

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

    public function delPP(){
        $requete = $this->connexionBD->pdo->prepare("UPDATE utilisateur set pp = null");
        $requete->execute();
        header("location: ../homepage/accueil");
    }
}