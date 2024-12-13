<?php

namespace controllers;
use blog\models\evenementModel;
use blog\models\performanceModel;
use blog\views\evenementView;
use blog\views\performanceView;
use PDO;
use index;
require_once "modules/blog/models/evenementModel.php";
require_once "modules/blog/views/evenementView.php";

class evenementController{

    private $model;
    private $view;

    public function __construct()
    {

        $this->model = new evenementModel();
        $this->view = new evenementView();
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

        if ($this->model->isUserSubscribed($idEvenement, $idUtilisateur)) {
            $_SESSION['error'] = "Vous êtes déjà inscrit à cet événement.";
        } else {
            if ($this->model->subscribeUser($idEvenement, $idUtilisateur)) {
                $_SESSION['success'] = "Inscription réussie à l'événement.";
            } else {
                $_SESSION['error'] = "Erreur lors de l'inscription à l'événement.";
            }
        }

        header("Location: afficheEvenement");
        exit();
    }
    public function ajouteEven(){
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nomEven = $_POST['NomEven'];
            $dateEven = $_POST['DateEven'];
            $nomSport = $_POST['NomSport'];

            $dateActuelle = date('Y-m-d');
            if ($dateEven < $dateActuelle) {
                $_SESSION['error'] = "La date de l'événement est dépassé.";
                header('Location: afficheEvenement');
                exit();
            }
            if ($this->model->ajouteEven($nomEven, $dateEven, $nomSport)) {
                $_SESSION['success'] = "Événement ajouté avec succès.";
            } else {
                $_SESSION['error'] = "Erreur lors de l'ajout de l'événement.";
            }

            header('Location: afficheEvenement');
            exit();
        }
    }

    public function supprimerEven() {
        $dateEven = $_POST['DateEven'];
        $nomEven = $_POST['NomEven'];
        if ($dateEven && $nomEven) {
            $this->model->supprimerEven($dateEven, $nomEven);

            header('Location: afficheEvenement');
            $_SESSION['valid_message'] = "Suppression de la performance réalisé avec succès.";
            exit();
        } else {
            $_SESSION['error_message'] = "Erreur avec les clés.";
            echo "Clés invalides pour la suppression.";
        }
    }

}
