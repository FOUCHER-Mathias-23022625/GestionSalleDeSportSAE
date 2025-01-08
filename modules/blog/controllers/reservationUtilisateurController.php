<?php

namespace controllers;

use blog\models\reservationUtilisateurModel;
use blog\views\reservationUtilisateurView;
require_once  "./index.php";
require_once 'modules/blog/models/reservationUtilisateurModel.php';
require_once 'modules/blog/views/reservationUtilisateurView.php';
class reservationUtilisateurController
{
    private $reservationsUtilisateurModele;

    public function __construct() {


        $this->reservationsUtilisateurModele = new reservationUtilisateurModel();
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

    public function deleteReservationUtilisateur()
    {
        $sport = htmlspecialchars($_POST['sport']);
        $date = htmlspecialchars($_POST['date']);
        $heure = htmlspecialchars($_POST['heure']);
        $userId = $_SESSION['id']; // Assurez-vous que l'ID de l'utilisateur est stocké dans la session

        // Appeler le modèle pour supprimer la réservation
        $this->reservationsUtilisateurModele->deleteReservation($userId, $sport, $date, $heure);

        // Rediriger vers la page des réservations de l'utilisateur
        header('Location: /GestionSalleDeSportSAE/reservationUtilisateur/afficherReservationsUtilisateur');
        exit();
    }
}