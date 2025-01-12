<?php

namespace blog\controllers;
namespace controllers;

use blog\views\Layout;
use DateTime;
use Index;
use blog\models\abonnementModel;
use blog\views\abonnementView;
require_once  "modules/blog/views/abonnementView.php";
require_once  "modules/blog/models/abonnementModel.php";
require_once "modules/blog/views/Layout.php";
//t

class abonnementController
{
    public function __construct(){
        try {
            $abonnementModel = new abonnementModel();
        } catch (PDOException $e) {
            die("Erreur de connexion à la base de données : " . $e->getMessage());
        }
    }

    #Affichage la vue de la page abonnement
    public function nosAbonnements() {

        $abonnementView = new abonnementView();
        $abonnementView->afficher();
    }

    #Apelle du model pour vérifier si l'abonnement de l'utilisateur est valable ou non
    public function checkAbo(): bool {
        $model = new abonnementModel();
        $dateFin = $model->infoAbo()['DateExp'];
        $dateFinObj = new DateTime($dateFin);
        $dateActuelle = new DateTime();
        return $dateFinObj >= $dateActuelle;
    }


    #Apelle du model pour appliquer l'abonnement sélectionné à l'utilisateur
    public function appliquerAbo($abo){
        $model = new abonnementModel();
        $dateFin = $model->infoAbo()['DateExp'];
        $dateFinObj = new DateTime($dateFin);
        $dateActuelle = new DateTime();
        if($dateFinObj < $dateActuelle) {
            $fini=true;
        }
        else{
            $fini=false;

        }
        if($abo=="PREMIUM"){
            if($fini){
                $model->createAbo(6);
            }
            else{
                $model->changerAbo(6);
            }
        }
        elseif ($abo=="CLASSIQUE"){
            if($fini){
                $model->createAbo(1);
            }
            else{
                $model->changerAbo(1);
            }

        }
        elseif ($abo=="ELITE"){
            if($fini){
                $model->createAbo(12);
            }
            else{
                $model->changerAbo(12);
            }

        }
        exit();

    }

}