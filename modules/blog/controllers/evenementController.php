<?php

namespace controllers;
use blog\models\evenementModel;
use blog\views\evenementView;
use PDO;
use index;
require_once "modules/blog/models/evenementModel.php";
require_once "modules/blog/views/evenementView.php";
class evenementController{

    public function __construct(){
        try {
            $evenementModel = new evenementModel();
        } catch (PDOException $e) {
            die("Erreur de connexion à la base de données : " . $e->getMessage());
        }
    }

    public function afficheEvenement() {

        $evenementView = new evenementView();
        $evenementView->afficher();
    }

    public function inscrireUtilisateur($idEvenement) {
        session_start();

        if (!isset($_SESSION['id'])) {
            $_SESSION['error'] = "Vous devez être connecté pour vous inscrire à un événement.";
            header("Location: /utilisateur/afficheFormConnexion");
            exit();
        }

        $idUtilisateur = $_SESSION['id'];

        if ($this->evenementModel->isUserSubscribed($idEvenement, $idUtilisateur)) {
            $_SESSION['error'] = "Vous êtes déjà inscrit à cet événement.";
        } else {
            if ($this->evenementModel->subscribeUser($idEvenement, $idUtilisateur)) {
                $_SESSION['success'] = "Inscription réussie à l'événement.";
            } else {
                $_SESSION['error'] = "Erreur lors de l'inscription à l'événement.";
            }
        }

        header("Location: /evenements/afficheEvenement");
        exit();
    }
}
