<?php

namespace controllers;
use blog\models\evenementModel;
use blog\views\evenementView;
use Index;

require_once "modules/blog/models/evenementModel.php";
require_once  "modules/blog/views/evenementView.php";
require_once  "./index.php";

class evenementController{
    private $evenementModel;

    public function __construct(){
        $host_name = "127.0.0.1";
        $user_name = "root";
        $password = "";
        $database_name = "saetest";

        $this->model = new evenementModel($host_name, $user_name, $password, $database_name);
        $this->view = new evenementView();
    }

    public function afficheEvenement()
    {
        $evenementView = new evenementView();
        $evenementView->afficher();

    }

    public function inscrireUtilisateur($idEvenement) {
        session_start();

        // Vérifier si l'utilisateur est connecté
        if (!isset($_SESSION['user_id'])) {
            $_SESSION['error'] = "Vous devez être connecté pour vous inscrire à un événement.";
            header("Location: /utilisateur/afficheFormConnexion");
            exit();
        }

        // Récupérer l'ID de l'utilisateur connecté
        $idUtilisateur = $_SESSION['user_id'];

        // Vérifier si l'utilisateur est déjà inscrit à cet événement sinon, l'inscrit pour l'événement
        if ($this->evenementModel->isUserSubscribed($idEvenement, $idUtilisateur)) {
            $_SESSION['error'] = "Vous êtes déjà inscrit à cet événement.";
        } else {
            if ($this->evenementModel->subscribeUser($idEvenement, $idUtilisateur)) {
                $_SESSION['success'] = "Inscription réussie à l'événement.";
            } else {
                $_SESSION['error'] = "Erreur lors de l'inscription à l'événement.";
            }
        }

        // Rediriger vers la page de l'événement ou autre page
        header("Location: /evenements/afficheEvenement");
        exit();
    }
}
?>