<?php
use modules\blog\models\utilisateurModel;
    class utilisateurController{


        public function index()
        {
            $model = new utilisateurModel();
            if (isset($_POST['connexion'])) {
                $this->$model->connecte();
            }
            if (isset($_POST['deconnexion'])) {
                $this->deconnecte();
            }
            if (isset($_POST['modif'])) {
                $this->modification;
        }}

        public function deconnecte()
        {
                session_start();
                session_destroy();
                header("Location: index.php");
        }

        public function modification(){
            $model = new utilisateurModel();
            $id = $_SESSION['id'];
            $mail = $_POST['mail'];
            $nom = $_POST['nom'];
            $prenom = $_POST['prenom'];
            $dateNaiss = $_POST['dateNaiss'];
            $mdp = $_POST['mdp'];
            $this->model->modification($id, $mail, $nom, $prenom, $dateNaiss, $mdp);
            header('Location: index.php');
        }

    }
    ?>