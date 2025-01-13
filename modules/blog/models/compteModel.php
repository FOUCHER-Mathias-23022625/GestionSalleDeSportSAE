<?php
namespace blog\models;
require_once 'modules/blog/views/compteView.php';
//t
class compteModel
{
    private $connexionBD;


    public function __construct()
    {
        $this->connexionBD = new bdModel();
    }
// Récupère les informations de l'utilisateur connecté
    public function utilisateurInformation()
    {
        $requete = $this->connexionBD->pdo->prepare("SELECT NomU, PrenomU, EMail, mdp, pp,admin FROM utilisateur WHERE idUtilisateur=:idUtilisateur");
        $requete->bindParam(":idUtilisateur", $_SESSION["id"]);
        $requete->execute();
        $requete = $requete->fetch();
        return $requete;
    }
// Récupère les dates de début et d'expiration de l'abonnement de l'utilisateur
    public function dateDeb_dateFin()
    {
        $requete = $this->connexionBD->pdo->prepare("SELECT DateDeb, DateExp from abonnement where idUtilisateur =:idUtilisateur");
        $requete->bindParam(":idUtilisateur", $_SESSION["id"]);
        $requete->execute();
        $requete = $requete->fetch();
        return $requete;

    }
// Modifie les informations de l'utilisateur
    public function edit_utilisateur()
    {

        if (isset($_FILES['image'])) {
            if ($_FILES['image']['error'] === UPLOAD_ERR_OK) {
                $image = $_FILES['image'];
                $tmpName = $image['tmp_name'];
                if(!move_uploaded_file($tmpName, 'assets/images/public/'.basename($image['name']))){
                    die();
                }
                $requete1 = $this->connexionBD->pdo->prepare("UPDATE utilisateur set pp=:image where idUtilisateur=:id"); // Mise à jour des autres informations de l'utilisateur
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

        $requete = $this->connexionBD->pdo->prepare("UPDATE utilisateur set NomU=:nom, PrenomU=:prenom, EMail=:email where idUtilisateur=:id");// Utilisation des valeurs existantes si aucun champ n'est rempli
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


    // Change le mot de passe de l'utilisateur
    public function changementMotDePasse($nvMdp){
        $hashedMdp = password_hash($nvMdp, PASSWORD_DEFAULT); // Hashage du mot de passe
        $requete = $this->connexionBD->pdo->prepare("UPDATE utilisateur SET mdp=:mdp where idUtilisateur =:idUtilisateur");
        $requete->bindParam(":idUtilisateur",$_SESSION['id']);
        $requete->bindParam(":mdp",$hashedMdp);
        $requete->execute();



    }
// Supprime l'image de profil de l'utilisateur
    public function delPP(){
        $requete = $this->connexionBD->pdo->prepare("UPDATE utilisateur set pp = null");
        $requete->execute();
        header("location: ../homepage/accueil");
    }
}