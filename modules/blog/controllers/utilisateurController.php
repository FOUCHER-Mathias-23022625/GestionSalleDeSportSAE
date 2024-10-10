<?php
namespace controllers;
use blog\models\utilisateurModel;
use blog\views\utilisateurView;
use Index;

require_once  "modules/blog/views/utilisateurView.php";
require_once  "./index.php";
require_once "./index.php";


    class utilisateurController
    {


        public function connexion(){
            $model = new utilisateurModel();
            $model ->connexion();

        }

        public function deconnecte()
        {
            session_start();
            session_destroy();
            header("Location: index.php");
        }

        public function modification()
        {
            $model = new utilisateurModel();
            $id = $_SESSION['id'];
            $mail = $_POST['mail'];
            $nom = $_POST['nom'];
            $prenom = $_POST['prenom'];
            $dateNaiss = $_POST['dateNaiss'];
            $mdp = $_POST['mdp'];
            $this->$model->edit_utilisateur($id, $mail, $nom, $prenom, $dateNaiss, $mdp);
            header('Location: index.php');
        }

        public function afficheFormConnexion()
        {
            $utilisateurView = new utilisateurView();
            $utilisateurView->afficher();

        }

        public function test($val1,$val2){
            echo $val1." et la valeur 2 est : ".$val2;
        }

    }

    ?>