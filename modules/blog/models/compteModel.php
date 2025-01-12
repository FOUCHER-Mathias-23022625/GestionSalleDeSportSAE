<?php
namespace blog\models;

require_once 'modules/blog/views/compteView.php';

class compteModel
{
    private $connexionBD;

    // Initialisation de la connexion à la base de données
    public function __construct()
    {
        $this->connexionBD = new bdModel();
    }

    // Récupère les informations de l'utilisateur connecté
    public function utilisateurInformation()
    {
        $requete = $this->connexionBD->pdo->prepare("
            SELECT NomU, PrenomU, EMail, mdp, pp, admin 
            FROM utilisateur 
            WHERE idUtilisateur = :idUtilisateur
        ");
        $requete->bindParam(":idUtilisateur", $_SESSION["id"]);
        $requete->execute();
        return $requete->fetch();
    }

    // Récupère les dates de début et d'expiration de l'abonnement de l'utilisateur
    public function dateDeb_dateFin()
    {
        $requete = $this->connexionBD->pdo->prepare("
            SELECT DateDeb, DateExp 
            FROM abonnement 
            WHERE idUtilisateur = :idUtilisateur
        ");
        $requete->bindParam(":idUtilisateur", $_SESSION["id"]);
        $requete->execute();
        return $requete->fetch();
    }

    // Modifie les informations de l'utilisateur
    public function edit_utilisateur()
    {
        // Gestion de l'upload de l'image de profil
        if (isset($_FILES['image'])) {
            if ($_FILES['image']['error'] === UPLOAD_ERR_OK) {
                $image = $_FILES['image'];
                $tmpName = $image['tmp_name'];

                // Déplacement de l'image téléchargée vers le dossier cible
                if (!move_uploaded_file($tmpName, 'assets/images/public/' . basename($image['name']))) {
                    die("Erreur lors du déplacement du fichier.");
                }

                // Mise à jour de l'image de profil dans la base de données
                $requete1 = $this->connexionBD->pdo->prepare("
                    UPDATE utilisateur 
                    SET pp = :image 
                    WHERE idUtilisateur = :id
                ");
                $requete1->bindParam(":image", $image['name']);
                $requete1->bindParam(":id", $_SESSION['id']);
                $requete1->execute();
            } else {
                echo 'Erreur lors du téléchargement du fichier.';
                return;
            }
        }

        // Mise à jour des autres informations de l'utilisateur
        $requete = $this->connexionBD->pdo->prepare("
            UPDATE utilisateur 
            SET NomU = :nom, PrenomU = :prenom, EMail = :email 
            WHERE idUtilisateur = :id
        ");

        // Utilisation des valeurs existantes si aucun champ n'est rempli
        $prenom = $_POST['PrenomCompte'] ?? $this->utilisateurInformation()['PrenomU'];
        $nom = $_POST['NomCompte'] ?? $this->utilisateurInformation()['NomU'];
        $email = $_POST['EmailCompte'] ?? $this->utilisateurInformation()['EMail'];

        $requete->bindParam(":prenom", $prenom);
        $requete->bindParam(":nom", $nom);
        $requete->bindParam(":email", $email);
        $requete->bindParam(":id", $_SESSION['id']);
        $requete->execute();
    }

    // Change le mot de passe de l'utilisateur
    public function changementMotDePasse($nvMdp)
    {
        // Hashage du mot de passe
        $hashedMdp = password_hash($nvMdp, PASSWORD_DEFAULT);
        $requete = $this->connexionBD->pdo->prepare("
            UPDATE utilisateur 
            SET mdp = :mdp 
            WHERE idUtilisateur = :idUtilisateur
        ");
        $requete->bindParam(":idUtilisateur", $_SESSION['id']);
        $requete->bindParam(":mdp", $hashedMdp);
        $requete->execute();
    }

    // Supprime l'image de profil de l'utilisateur
    public function delPP()
    {
        $requete = $this->connexionBD->pdo->prepare("
            UPDATE utilisateur 
            SET pp = NULL 
            WHERE idUtilisateur = :idUtilisateur
        ");
        $requete->bindParam(":idUtilisateur", $_SESSION['id']);
        $requete->execute();
        header("Location: ../homepage/accueil");
    }
}
?>
