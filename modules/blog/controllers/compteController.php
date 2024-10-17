<?php
namespace controllers;
use blog\models\compteModel;
use blog\views\Layout;
use blog\views\compteView;
use Index;

require_once  "modules/blog/views/compteView.php";
require_once  "modules/blog/models/compteModel.php";
require_once  "./index.php";
require_once "modules/blog/views/Layout.php";


    class compteController{

        public function afficheCompte(){
            $model = new compteModel();
            $resultat = $model->utilisateurInformation();
            $model2 = new compteModel();
            $resultat2 = $model2->dateDeb_dateFin();
            $compteView = new compteView();
            ob_start();
            $compteView->afficher($resultat,$resultat2);
            $contenu=ob_get_clean();
            $layout = new Layout("compte", $contenu);
            $layout->afficher();
        }

        public function maj(){
            $model = new compteModel();

            $model->edit_utilisateur();
            header('location:afficheCompte');
        }
    }
