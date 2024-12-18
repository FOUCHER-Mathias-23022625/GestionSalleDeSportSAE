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
        $compteView->afficher($resultat,$resultat2);
    }

    public function majData(){
        $model = new compteModel();

        $model->edit_utilisateur();
        header('location:afficheCompte');
    }
    public function verifMdp($mdp):bool{
        $model = new compteModel();
        $resultat = $model->utilisateurInformation()['mdp'];
        if (password_verify($mdp,$resultat)) {
            return true;
        }
        else{
            return false;
        }
    }

    public function changementMdp(){
        $ancienMdp = $_POST['ancienMdp'];
        $nouveauMdp = $_POST['nouveauMdp'];
        if($this->verifMdp($ancienMdp)){
            $model= new compteModel();
            $model->changementMotDePasse($nouveauMdp);
        }
        header('location:afficheCompte');
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
    
    public function deletePP(){
        $model = new compteModel();
        $model->delPP();
        header('location:afficheCompte');
        exit();
    }
}
