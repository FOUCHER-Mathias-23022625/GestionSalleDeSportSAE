<?php
namespace controllers;

use blog\models\compteModel;
use blog\models\utilisateurModel;
use blog\views\Layout;
use blog\views\utilisateurView;
use blog\views\verifMailView;
use Index;
use PDOException;

// Inclusion des fichiers nécessaires pour les modèles, vues et l'index
require_once "modules/blog/views/utilisateurView.php";
require_once "modules/blog/models/utilisateurModel.php";
require_once "./index.php";
require_once "modules/blog/views/Layout.php";

class utilisateurController
{
    // Constructeur pour initialiser les erreurs et démarrer la session
    public function __construct() {
        // Active l'affichage des erreurs pour faciliter le débogage
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);

        // Démarre la session si elle n'est pas déjà démarrée
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        // Vérifie que le répertoire des sessions est accessible en écriture
        $session_save_path = session_save_path();
        if (!is_writable($session_save_path)) {
            die("Le répertoire de sessions n'est pas accessible en écriture : " . $session_save_path);
        }

        // Tente d'initialiser le modèle utilisateur
        try {
            $utilisateurModel = new utilisateurModel();
        } catch (PDOException $e) {
            die("Erreur de connexion à la base de données : " . $e->getMessage());
        }
    }

    // Fonction pour gérer la connexion utilisateur
    public function connexion() {
        $mail = $_POST['mail'];
        $mdp = $_POST['mdp'];
        $model = new utilisateurModel();

        // Vérifie si l'utilisateur peut se connecter
        if ($model->connexion($mail, $mdp)) {
            $_SESSION['alert'] = "Connexion réussie, bienvenue dans votre espace personnel.";
            header('location:../homepage/accueil'); // Redirige vers la page d'accueil
            exit();
        } else {
            // Si échec, réinitialise les variables de session et affiche une alerte
            $_SESSION['alert'] = "Email ou mot de passe incorrect.";
            unset($_SESSION['mailUtilisateur'], $_SESSION['mdpUtilisateur'], $_SESSION['prenomUtilisateur'], $_SESSION['nomUtilisateur']);
            header('location: afficheFormConnexion'); // Redirige vers le formulaire de connexion
        }
        exit();
    }

    // Fonction pour déconnecter l'utilisateur
    public function deconnecte() {
        session_start();
        session_destroy(); // Détruit la session
        header("Location:afficheFormConnexion"); // Redirige vers le formulaire de connexion
    }

    // Fonction pour inscrire un nouvel utilisateur
    public function inscription() {
        $mail = $_SESSION['mailUtilisateur'];
        $mdp = $_SESSION['mdpUtilisateur'];
        $prenom = $_SESSION['prenomUtilisateur'];
        $nom = $_SESSION['nomUtilisateur'];
        $model = new utilisateurModel();

        // Ajoute l'utilisateur à la base de données
        $model->ajouteUtilisateur($mail, $mdp, $prenom, $nom);
        header('location:afficheFormConnexion'); // Redirige vers le formulaire de connexion
    }

    // Fonction pour modifier les informations de l'utilisateur
    public function modification() {
        $model = new utilisateurModel();
        $id = $_SESSION['id'];
        $mail = $_POST['mail'];
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $dateNaiss = $_POST['dateNaiss'];
        $mdp = $_POST['mdp'];

        // Met à jour les informations utilisateur
        $model->edit_utilisateur($id, $mail, $nom, $prenom, $dateNaiss, $mdp);
        header('Location: index.php'); // Redirige vers l'index
    }

    // Affiche le formulaire de connexion
    public function afficheFormConnexion() {
        $utilisateurView = new utilisateurView();
        ob_start(); // Commence la mise en tampon de sortie
        $utilisateurView->afficher(); // Affiche la vue utilisateur
        $contenu = ob_get_clean(); // Récupère et nettoie le tampon de sortie
        $layout = new Layout("Utilisateur", $contenu);
        $layout->afficher(); // Affiche le layout
    }

    // Génère un mot de passe aléatoire
    public function generateurMdp() {
        $alphabet = "abcdefghijklmnopqrstuvwxyz";
        $alphabetMaj = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $numero = "0123456789";
        $caractere = ";.,!-";
        $code = '';

        // Génère différentes parties aléatoires du mot de passe
        for ($i = 0; $i < rand(5, 10); $i++) $code .= $alphabet[rand(0, 25)];
        for ($i = 0; $i < rand(5, 10); $i++) $code .= $alphabetMaj[rand(0, 25)];
        for ($i = 0; $i < rand(5, 10); $i++) $code .= $numero[rand(0, 9)];
        for ($i = 0; $i < rand(5, 10); $i++) $code .= $caractere[rand(0, 4)];

        return str_shuffle($code); // Mélange le mot de passe généré
    }

    // Change le mot de passe de l'utilisateur
    public function changementMdp() {
        $ancienMdp = $_POST['ancienMdp'];
        $nouveauMdp = $_POST['nouveauMdp'];

        // Vérifie l'ancien mot de passe
        if ($this->verifMdp($ancienMdp)) {
            $model = new compteModel();
            $model->changementMotDePasse($nouveauMdp); // Change le mot de passe
        }
        header('location:../homepage/accueil'); // Redirige vers la page d'accueil
    }

    // Fonction pour gérer le mot de passe oublié
    public function oublieMdp() {
        $model = new utilisateurModel();
        $persoMail = $_POST["AncienMail"];

        // Vérifie si l'email existe et génère un nouveau mot de passe
        if ($model->utilisateurMail($persoMail)) {
            $mdp = $this->generateurMdp();
            $model->changementMotDePasse($mdp, $persoMail); // Met à jour le mot de passe
            mail($persoMail, "Nouveau mot de passe", "Bonjour, votre mot de passe a été changé. Votre nouveau mot de passe est : " . $mdp);
            $_SESSION['alert'] = "Le nouveau mot de passe a été envoyé par mail.";
            header('location:../homepage/accueil'); // Redirige vers la page d'accueil
        }
    }

    // Génère un code de vérification aléatoire
    public function genereCode() {
        $numero = "0123456789";
        $code = '';
        for ($i = 0; $i < 6; $i++) {
            $code .= $numero[rand(0, 9)];
        }
        return $code; // Retourne un code de 6 chiffres
    }

    // Envoie un email de vérification avec un code
    public function verifMail() {
        $_SESSION['mailUtilisateur'] = $_POST['mail'];
        $_SESSION['mdpUtilisateur'] = $_POST['mdp'];
        $_SESSION['prenomUtilisateur'] = $_POST['prenom'];
        $_SESSION['nomUtilisateur'] = $_POST['nom'];

        $code = $this->genereCode(); // Génère un code
        $_SESSION['code'] = $code;
        mail($_SESSION['mailUtilisateur'], "Code de vérification", "Votre code de vérification est : \n" . $code);
        header("location: afficheFormConnexion"); // Redirige vers le formulaire de connexion
    }
    // Vérifie si le code de vérification est correct
    public function verifCode(){
        if (isset($_POST['code'])) {
            $code = implode('', $_POST['code']); // Concatène les parties du code
            if ($code == $_SESSION['code']){
                $this->inscription();// Inscrit l'utilisateur
                $_SESSION['alert'] = "Vous avez bien été inscrit";
                header("location: ../abonnement/afficheAbonnement");// Redirige vers la page d'abonnement
                exit();
            }
            // Si le code est incorrect, réinitialise les variables de session
            unset($_SESSION['mailUtilisateur']);
            unset($_SESSION['mdpUtilisateur']);
            unset($_SESSION['prenomUtilisateur']);
            unset($_SESSION['nomUtilisateur']);
            $_SESSION['alert'] = "Code de vérification invalide.";
            header("location: ../homepage/accueil");
            exit();


        }
    }


}

?>