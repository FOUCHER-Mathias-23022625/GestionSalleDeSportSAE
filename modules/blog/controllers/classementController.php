<?php
namespace controllers;
use blog\models\classementModel;
use blog\views\classementView;

require_once "modules/blog/views/classementView.php";
require_once "modules/blog/models/classementModel.php";
require_once "./index.php";



ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

class classementController
{
    private $model;
    private $view;

    public function __construct()
    {

        $this->model = new classementModel();
        $this->view = new classementView();
    }
    public function getClassement()
    {
        $sql = "SELECT nom, prenom, COUNT(resultat) AS victoires 
                FROM performances 
                WHERE resultat = 1 
                GROUP BY id_user 
                ORDER BY victoires DESC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
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


}
