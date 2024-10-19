<?php

namespace controllers;

use blog\models\reservationUtilisateurModele;
use blog\views\reservationUtilisateurView;
require_once  "./index.php";
require_once 'modules/blog/models/reservationUtilisateurModele.php';
require_once 'modules/blog/views/reservationUtilisateurView.php';
class reservationUtilisateurController
{
    private $reservationsUtilisateurModele;

    public function __construct() {
        $host_name = "mysql-gestionsaetest.alwaysdata.net";
        $user_name = "379076";
        $password  = "gestionSae";
        $database_name = "gestionsaetest_bd";

        $this->reservationsUtilisateurModele = new reservationUtilisateurModele($host_name, $user_name, $password, $database_name);
    }

    // Méthode pour afficher les réservations de l'utilisateur
    public function afficherReservationsUtilisateur()
    {
        // Vérifier si l'utilisateur est connecté
        if (!isset($_SESSION['user_id'])) {
            header('Location: /GestionSalleDeSportSAE/utilisateur/afficheFormConnexion');
            exit();
        }

        $userId = $_SESSION['user_id']; // Assurez-vous que l'ID de l'utilisateur est stocké dans la session
        // Récupérer les réservations futures et passées
        $reservationsFutures = $this->reservationsUtilisateurModele->getReservationsFutures($userId);
        $reservationsPassees = $this->reservationsUtilisateurModele->getReservationsPassees($userId);
        $view = new ReservationUtilisateurView();
        $view->afficher($reservationsFutures, $reservationsPassees);
    }
}