<?php
namespace controllers;
use blog\models\classementModel;
use blog\views\classementView;

require_once "modules/blog/views/classementView.php";
require_once "modules/blog/models/classementModel.php";
require_once "./index.php";

class classementController
{
    private $model;
    private $view;
    private $db;

    // Constructeur : Initialise le modèle et la vue
    public function __construct()
    {
        $this->model = new classementModel();
        $this->view = new classementView();
    }

    // Affiche le classement général en utilisant le modèle et la vue
    public function afficheClassement()
    {
        $model = new classementModel('mysql-gestionsaetest.alwaysdata.net', '379076', 'gestionSae', 'gestionsaetest_bd');
        $view = new classementView();

        // Vérifie si l'utilisateur est connecté
        if (!isset($_SESSION['id'])) {
            // Redirige vers la page de connexion si non connecté
            header('Location: /GestionSalleDeSportSAE/utilisateur/afficheFormConnexion');
        }

        // Affiche le classement via la vue
        $view->afficher();
    }

    // Récupère et retourne le classement basé sur les victoires
    public function afficheClassementVictoire()
    {
        // Vérifie si l'utilisateur est connecté
        if (!isset($_SESSION['id'])) {
            // Redirige vers la page de connexion si non connecté
            header('Location: /GestionSalleDeSportSAE/utilisateur/afficheFormConnexion');
            exit;
        }

        // Récupère les données de classement par victoires depuis le modèle
        $classement = $this->model->getClassementVictoires();

        // Retourne les données de classement
        return $classement;
    }

    // Récupère et retourne le classement basé sur le nombre de performances
    public function afficheClassementNBPerformance()
    {
        // Vérifie si l'utilisateur est connecté
        if (!isset($_SESSION['id'])) {
            // Redirige vers la page de connexion si non connecté
            header('Location: /GestionSalleDeSportSAE/utilisateur/afficheFormConnexion');
            exit;
        }

        // Récupère les données de classement par performances depuis le modèle
        $classement = $this->model->getClassementPerformances();

        // Retourne les données de classement
        return $classement;
    }

    // Récupère et retourne le classement basé sur le temps cumulé
    public function afficheClassementTempsCumule()
    {
        // Vérifie si l'utilisateur est connecté
        if (!isset($_SESSION['id'])) {
            // Redirige vers la page de connexion si non connecté
            header('Location: /GestionSalleDeSportSAE/utilisateur/afficheFormConnexion');
            exit;
        }

        // Récupère les données de classement par temps cumulé depuis le modèle
        $classement = $this->model->getClassementTemps();

        // Retourne les données de classement
        return $classement;
    }
}
