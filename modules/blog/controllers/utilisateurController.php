<?php
namespace controllers;
use blog\models\utilisateurModel;
use blog\views\Layout;
use blog\views\utilisateurView;
use Index;

require_once  "modules/blog/views/utilisateurView.php";
require_once  "modules/blog/models/utilisateurModel.php";
require_once  "./index.php";
require_once "modules/blog/views/Layout.php";



    class utilisateurController
    {


        public function connexion(){
                $mail =$_POST['mail'];
                $mdp =$_POST['mdp'];
                $model = new utilisateurModel();
                $model->connexion($mail,$mdp);
                header('location:afficheFormConnexion');


        }

        public function deconnecte()
        {
            session_start();
            session_destroy();
            header("Location:afficheFormConnexion");
        }

        public function inscription()
        {
                $mail =$_POST['mail'];
                $mdp =$_POST['mdp'];
                $model = new utilisateurModel();
                $model->ajouteUtilisateur($mail,$mdp);
                header('location:afficheFormConnexion');

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