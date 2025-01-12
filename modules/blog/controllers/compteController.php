<?php
namespace controllers;

use blog\models\compteModel;
use blog\views\Layout;
use blog\views\compteView;
use Index;


require_once "modules/blog/views/compteView.php";
require_once "modules/blog/models/compteModel.php";
require_once "./index.php";
require_once "modules/blog/views/Layout.php";

class compteController {
//T
    // Fonction pour afficher les informations du compte utilisateur
    public function afficheCompte() {
        $model = new compteModel();
        // Récupère les informations de l'utilisateur
        $resultat = $model->utilisateurInformation();

        $model2 = new compteModel();
        // Récupère les dates de début et de fin (probablement de l'activité)
        $resultat2 = $model2->dateDeb_dateFin();

        $compteView = new compteView();
        // Passe les données récupérées à la vue pour affichage
        $compteView->afficher($resultat, $resultat2);
    }

    // Fonction pour mettre à jour les données utilisateur
    public function majData() {
        $model = new compteModel();
        // Met à jour les informations de l'utilisateur
        $model->edit_utilisateur();
        // Redirige vers la page d'affichage des comptes
        header('location:afficheCompte');
    }

    // Vérifie si un mot de passe est correct
    public function verifMdp($mdp): bool {
        $model = new compteModel();
        // Récupère le mot de passe actuel de l'utilisateur
        $resultat = $model->utilisateurInformation()['mdp'];

        // Vérifie si le mot de passe fourni correspond au mot de passe hashé
        if (password_verify($mdp, $resultat)) {
            return true;
        } else {
            return false;
        }
    }

    // Fonction pour changer le mot de passe de l'utilisateur
    public function changementMdp() {
        $ancienMdp = $_POST['ancienMdp'];
        $nouveauMdp = $_POST['nouveauMdp'];

        // Vérifie si l'ancien mot de passe est correct
        if ($this->verifMdp($ancienMdp)) {
            $model = new compteModel();
            // Met à jour le mot de passe avec le nouveau
            $model->changementMotDePasse($nouveauMdp);
            $_SESSION['alert'] = "Votre mot de passe a bien été modifié.";
        } else {
            $_SESSION['alert'] = "Ancien mot de passe incorrect.";
        }
        // Redirige vers la page d'affichage des comptes
        header('location:afficheCompte');
    }

    // Génère un mot de passe aléatoire
    public function generateurMdp() {
        $alphabet = "abcdefghijklmnopqrstuvwxyz";
        $alphabetMaj = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $numero = "0123456789";
        $caractere = ";.,!-";
        $code = '';

        // Génère une partie du mot de passe avec des lettres minuscules
        for ($i = 0; $i < rand(5, 10); $i++) {
            $code .= $alphabet[rand(0, 25)];
        }
        // Génère une partie du mot de passe avec des lettres majuscules
        for ($i = 0; $i < rand(5, 10); $i++) {
            $code .= $alphabetMaj[rand(0, 25)];
        }
        // Génère une partie du mot de passe avec des chiffres
        for ($i = 0; $i < rand(5, 10); $i++) {
            $code .= $numero[rand(0, 9)];
        }
        // Génère une partie du mot de passe avec des caractères spéciaux
        for ($i = 0; $i < rand(5, 10); $i++) {
            $code .= $caractere[rand(0, 4)];
        }
        // Mélange le mot de passe pour rendre les caractères aléatoires
        return str_shuffle($code);
    }

    // Supprime la photo de profil de l'utilisateur
    public function deletePP() {
        $model = new compteModel();
        // Supprime la photo de profil de l'utilisateur
        $model->delPP();
        // Redirige vers la page d'affichage des comptes
        header('location:afficheCompte');
        exit();
    }
}
