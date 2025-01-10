<?php
namespace controllers;
use blog\models\classementModel;
use blog\views\classementView;
use index;





ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

class classementController
{
    private $model;
    private $view;
    private $db;

    public function __construct()
    {

        $this->model = new classementModel();
        $this->view = new classementView();
    }
    public function afficheClassement()
    {
        $model = new classementModel('mysql-gestionsaetest.alwaysdata.net', '379076', 'gestionSae', 'gestionsaetest_bd');
        $view = new classementView();
        if(!isset($_SESSION['id'])) {
            header('Location: /GestionSalleDeSportSAE/utilisateur/afficheFormConnexion');
        }
        $view->afficher();
    }
    public function afficheClassementVictoire()
    {
        if (!isset($_SESSION['id'])) {
            header('Location: /GestionSalleDeSportSAE/utilisateur/afficheFormConnexion');
            exit;
        }

        // Récupération des données depuis le modèle
        $classement = $this->model->getClassementVictoires();

        // Retourne les données du classement
        return $classement;
    }
    public function afficheClassementNBPerformance()
    {
        if (!isset($_SESSION['id'])) {
            header('Location: /GestionSalleDeSportSAE/utilisateur/afficheFormConnexion');
            exit;
        }

        // Récupération des données depuis le modèle
        $classement = $this->model->getClassementPerformances();

        // Retourne les données du classement
        return $classement;
    }

    public function afficheClassementTempsCumule()
    {
        if (!isset($_SESSION['id'])) {
            header('Location: /GestionSalleDeSportSAE/utilisateur/afficheFormConnexion');
            exit;
        }

        // Récupération des données depuis le modèle
        $classement = $this->model->getClassementTemps();

        // Retourne les données du classement
        return $classement;
    }

}
