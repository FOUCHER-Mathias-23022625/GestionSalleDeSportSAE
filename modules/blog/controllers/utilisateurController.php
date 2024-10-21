<?php
namespace controllers;
use blog\models\utilisateurModel;
use blog\views\Layout;
use blog\views\utilisateurView;
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

    public function connexion(){
        $mail = $_POST['mail'];
        $mdp = $_POST['mdp'];
        $model = new utilisateurModel();
        $model->connexion($mail, $mdp);
        header('location:afficheFormConnexion');
    }

    public function deconnecte() {
        session_start();
        session_destroy();
        header("Location:afficheFormConnexion");
    }

    public function inscription() {
        $mail = $_POST['mail'];
        $mdp = $_POST['mdp'];
        $model = new utilisateurModel();
        $model->ajouteUtilisateur($mail, $mdp);
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

        public function test($val1,$val2){
            echo $val1." et la valeur 2 est : ".$val2;
        }

    }

    ?>