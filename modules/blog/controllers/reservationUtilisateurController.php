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


        $this->reservationsUtilisateurModele = new reservationUtilisateurModele();
    }

    // Méthode pour afficher les réservations de l'utilisateur
    public function afficherReservationsUtilisateur()
    {
        // Vérifier si l'utilisateur est connecté
        if (!isset($_SESSION['id'])) {
            header('Location: /GestionSalleDeSportSAE/utilisateur/afficheFormConnexion');
            exit();
        }

        $userId = $_SESSION['id']; // Assurez-vous que l'ID de l'utilisateur est stocké dans la session
        // Récupérer les réservations futures et passées
        $reservationsFutures = $this->reservationsUtilisateurModele->getReservationsFutures($userId);
        $reservationsPassees = $this->reservationsUtilisateurModele->getReservationsPassees($userId);
        $view = new ReservationUtilisateurView();
        $view->afficher($reservationsFutures, $reservationsPassees);
    }
}