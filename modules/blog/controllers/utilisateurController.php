<?php
namespace controllers;
use blog\models\compteModel;
use blog\models\utilisateurModel;
use blog\views\Layout;
use blog\views\utilisateurView;
use blog\views\verifMailView;
use Index;

require_once "modules/blog/views/utilisateurView.php";
require_once "modules/blog/models/utilisateurModel.php";
require_once "./index.php";
require_once "modules/blog/views/Layout.php";

class utilisateurController
{


    public function __construct() {
        // Afficher les erreurs pour le débogage
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);

        // Démarrer la session
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        // Vérifiez les permissions du répertoire de sessions
        $session_save_path = session_save_path();
        if (!is_writable($session_save_path)) {
            die("Le répertoire de sessions n'est pas accessible en écriture : " . $session_save_path);
        }

        try {
            $utilisateurModel = new utilisateurModel();
        } catch (PDOException $e) {
            die("Erreur de connexion à la base de données : " . $e->getMessage());
        }
    }

    public function connexion() {
        $mail = $_POST['mail'];
        $mdp = $_POST['mdp'];
        $model = new utilisateurModel();

        // Appel à la méthode connexion et vérification des résultats
        if ($model->connexion($mail, $mdp)) {
            // Si connexion réussie, rediriger vers la homepage
            header('location:../homepage/accueil');
        } else {
            // Si connexion échoue, alerte et rediriger vers la page de connexion
            $_SESSION['alert'] = "Email ou mot de passe incorrect.";
            header('location:afficheFormConnexion');
        }
        exit();
    }

    public function deconnecte() {
        session_start();
        session_destroy();
        header("Location:afficheFormConnexion");
    }

    public function inscription() {
        $mail = $_SESSION['mailUtilisateur'];
        $mdp = $_SESSION['mdpUtilisateur'];
        $prenom = $_SESSION['prenomUtilisateur'];
        $nom = $_SESSION['nomUtilisateur'];
        $model = new utilisateurModel();
        $model->ajouteUtilisateur($mail, $mdp, $prenom, $nom);
        header('location:afficheFormConnexion');
    }

    public function modification() {
        $model = new utilisateurModel();
        $id = $_SESSION['id'];
        $mail = $_POST['mail'];
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $dateNaiss = $_POST['dateNaiss'];
        $mdp = $_POST['mdp'];
        $model->edit_utilisateur($id, $mail, $nom, $prenom, $dateNaiss, $mdp);
        header('Location: index.php');
    }

    public function afficheFormConnexion()
    {
        $utilisateurView = new utilisateurView();
        ob_start();
        $utilisateurView->afficher();
        $contenu=ob_get_clean();
        $layout = new Layout("Utilisateur", $contenu);
        $layout->afficher();

    }

    public function generateurMdp(){
        $alphabet="abcdefghijklmnopqrstuvwxyz";
        $alphabetMaj="ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $numero="0123456789";
        $caractere=";.,!-";
        $code='';
        for($i=0;$i<rand(5,10);$i++){
            $code.=$alphabet[rand(0,25)];
        }
        for($i=0;$i<rand(5,10);$i++){
            $code.=$alphabetMaj[rand(0,25)];
        }
        for($i=0;$i<rand(5,10);$i++){
            $code.=$numero[rand(0,9)];
        }
        for($i=0;$i<rand(5,10);$i++){
            $code.=$caractere[rand(0,4)];
        }
        return str_shuffle($code);
    }

    public function changementMdp(){
        $ancienMdp = $_POST['ancienMdp'];
        $nouveauMdp = $_POST['nouveauMdp'];
        if($this->verifMdp($ancienMdp)){
            $model= new compteModel();
            $model->changementMotDePasse($nouveauMdp);
        }
        header("location: afficheFormConnexion");
    }

    public function oublieMdp(){
        $model = new utilisateurModel();
        $persoMail= $_POST["AncienMail"];
        if($model->utilisateurMail($persoMail)){
            $mdp = $this->generateurMdp();
            $model->changementMotDePasse($mdp, $persoMail);
            mail($persoMail,"Nouveau mot de passe", "Bonjour, vôtre mot de passe à été changé. Vôtre nouveau mot de passe est : ".$mdp);
            header("location: afficheFormConnexion");
        }
    }

    public function genereCode(){
        $numero="0123456789";
        $code='';
        for($i=0;$i<6;$i++){
            $code.=$numero[rand(0,9)];
        }
        return $code;
    }



    public function verifMail(){
        $_SESSION['mailUtilisateur'] = $_POST['mail'];
        $_SESSION['mdpUtilisateur'] = $_POST['mdp'];
        $_SESSION['prenomUtilisateur'] = $_POST['prenom'];
        $_SESSION['nomUtilisateur'] = $_POST['nom'];


        $code=$this->genereCode();
        $_SESSION['code']=$code;
        mail($_SESSION['mailUtilisateur'], "Code de vérification", "Votre code de vérification est : \n".$code);
        header("location: afficheFormConnexion");
    }

    public function verifCode(){
        if (isset($_POST['code'])) {
            $code = implode('', $_POST['code']);
            if ($code == $_SESSION['code']){
                $this->inscription();
                $_SESSION['alert'] = "Vous avez bien été inscrit";
                header("location: ../abonnement/afficheAbonnement");
                exit();
            }
            unset($_SESSION['mailUtilisateur']);
            unset($_SESSION['mdpUtilisateur']);
            unset($_SESSION['prenomUtilisateur']);
            unset($_SESSION['nomUtilisateur']);
            $_SESSION['alert'] = "Code de vérification invalide.";
            header("location: afficheFormConnexion");
            exit();


        }
    }


}

?>