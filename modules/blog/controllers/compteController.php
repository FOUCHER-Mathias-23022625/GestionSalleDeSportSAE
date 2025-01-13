<?php
namespace controllers;
use blog\models\compteModel;
use blog\views\Layout;
use blog\views\compteView;
use Index;
//t
require_once  "modules/blog/views/compteView.php";
require_once  "modules/blog/models/compteModel.php";
require_once  "./index.php";
require_once "modules/blog/views/Layout.php";


class compteController{
    // Fonction pour afficher la vue
    public function afficheCompte(){
        $model = new compteModel();
        $resultat = $model->utilisateurInformation(); // Récupère les informations de l'utilisateur
        $model2 = new compteModel();
        $resultat2 = $model2->dateDeb_dateFin();// Récupère les dates de début et de fin de l'abonnement
        $compteView = new compteView();
        // Passe les données récupérées à la vue pour affichage
        $compteView->afficher($resultat,$resultat2);
    }
    // Fonction pour mettre à jour les données utilisateur
    public function majData(){
        $model = new compteModel();

        $model->edit_utilisateur();// Met à jour les informations de l'utilisateur
        header('location:afficheCompte');
    }
    // Vérifie si un mot de passe est correct
    public function verifMdp($mdp):bool{
        $model = new compteModel();
        $resultat = $model->utilisateurInformation()['mdp'];// Récupère le mot de passe actuel de l'utilisateur
        if (password_verify($mdp,$resultat)) {
            return true;
        }
        else{
            return false;
        }
    }
// Fonction pour changer le mot de passe de l'utilisateur
    public function changementMdp(){
        $ancienMdp = $_POST['ancienMdp'];
        $nouveauMdp = $_POST['nouveauMdp'];
        if($this->verifMdp($ancienMdp)){ // Vérifie si l'ancien mot de passe est correct
            $model= new compteModel();
            $model->changementMotDePasse($nouveauMdp); // Met à jour le mot de passe avec le nouveau
            $_SESSION['alert'] = "Votre mot de passe a bien été modifié.";
        }
        else{
            $_SESSION['alert'] = "Ancien mot de passe incorrect.";
        }
        header('location:afficheCompte');
    }
    // Génère un mot de passe aléatoire
    public function generateurMdp(){
        $alphabet="abcdefghijklmnopqrstuvwxyz";
        $alphabetMaj="ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $numero="0123456789";
        $caractere=";.,!-";
        $code='';
        for($i=0;$i<rand(5,10);$i++){ // Génère une partie du mot de passe avec des lettres minuscules
            $code.=$alphabet[rand(0,25)];
        }
        for($i=0;$i<rand(5,10);$i++){ // Génère une partie du mot de passe avec des lettres majuscules
            $code.=$alphabetMaj[rand(0,25)];
        }
        for($i=0;$i<rand(5,10);$i++){ // Génère une partie du mot de passe avec des chiffre
            $code.=$numero[rand(0,9)];
        }
        for($i=0;$i<rand(5,10);$i++){ // Génère une partie du mot de passe avec des caractères spéciaux
            $code.=$caractere[rand(0,4)];
        }
        return str_shuffle($code);// Mélange le mot de passe pour rendre les caractères aléatoires
    }
// Supprime la photo de profil de l'utilisateur
    public function deletePP(){
        $model = new compteModel();
        $model->delPP(); // Supprime la photo de profil de l'utilisateur
        header('location:afficheCompte');
        exit();
    }
}