<?php
namespace blog\controllers;
use blog\models\compteModel;
use blog\views\Layout;
use blog\views\compteView;
use index;






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
        $layout = new Layout("Utilisateur", $contenu);
        $layout->afficher();
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
            $_SESSION['alert'] = "Votre mot de passe a bien été modifié.";
        }
        else{
            $_SESSION['alert'] = "Ancien mot de passe incorrect.";
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
