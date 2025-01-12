<?php
namespace blog\controllers;
namespace controllers;


use blog\views\interfaceAdminView;
use blog\models\interfaceAdminModel;
use blog\models\compteModel;
use Index;
use blog\views\Layout;

//te
require_once "modules/blog/views/interfaceAdminView.php";
require_once "modules/blog/models/interfaceAdminModel.php";
require_once "modules/blog/models/compteModel.php";
require_once "modules/blog/views/Layout.php";

class interfaceAdminController
{
    private $interfaceAdminModel;
    private $interfaceAdminView;

    public function __construct() {
        $this->interfaceAdminModel = new interfaceAdminModel();
        $this->interfaceAdminView = new interfaceAdminView();
    }

    public function afficherInterfaceAdmin() {
        $modelUtili = new compteModel();
        $userInfo = $modelUtili->utilisateurInformation();
        $userStatus = $userInfo['admin'] ?? 0;

        $viewInterfaceAdmin = new interfaceAdminView();
        if (!isset($_SESSION['id'])) {
            header('Location: /GestionSalleDeSportSAE/utilisateur/afficheFormConnexion');
            exit();
        }
        else{
            if ($userStatus == 0) {
                echo "Redirection vers la page de connexion";
                header('Location: /GestionSalleDeSportSAE/homepage/accueil');
                exit();
            } else {
                $viewInterfaceAdmin->afficher();
            }
        }
    }
    public function getUsers()
    {
        return $this->interfaceAdminModel->GetAllUsers();
    }

    public function getReservations()
    {
        return $this->interfaceAdminModel->GetAllReservations();
    }

    public function getEvenements()
    {
        return $this->interfaceAdminModel->GetAllEvenements();
    }


    public function deleteUser($userId)
    {
        $this->interfaceAdminModel->deleteUserMod($userId);
        header('Location: /GestionSalleDeSportSAE/interfaceAdmin/afficherInterfaceAdmin');
        exit();
    }

    public function updateUser()
    {
        $userId = $_POST['IdUtilisateur']; // Champ caché pour l'ID
        $nom = $_POST['NomU'];
        $prenom = $_POST['PrenomU'];
        $email = $_POST['EMail'];
        $admin = $_POST['admin'];

        // Appeler le modèle pour effectuer la mise à jour
        $this->interfaceAdminModel->updateUserMod($userId, $nom, $prenom, $email, $admin);

        // Redirection après la mise à jour
        header('Location: /GestionSalleDeSportSAE/interfaceAdmin/afficherInterfaceAdmin');
        exit();
    }


    public function deleteEvent($eventId){
        $this->interfaceAdminModel->deleteEvent($eventId);
        header('Location: /GestionSalleDeSportSAE/interfaceAdmin/afficherInterfaceAdmin');
        exit();
    }

    public function updateReservation()
    {
        // Récupération des données du formulaire via POST
        $reservationId = $_POST['reservation_id']; // ID de la réservation (caché dans le formulaire)
        $sport = $_POST['sport'];
        $userId = $_POST['user_id'];
        $date = $_POST['date'];
        $heure = $_POST['heure'];
        $terrain = $_POST['terrain'];

        // Appeler le modèle pour effectuer la mise à jour
        $this->interfaceAdminModel->updateReservationMod($reservationId, $sport, $userId, $date, $heure, $terrain);

        // Redirection après la mise à jour
        header('Location: /GestionSalleDeSportSAE/interfaceAdmin/afficherReservations');
        exit();
    }

    public function deleteReservation($sport,$userId,$date,$heure){
        $this->interfaceAdminModel->deleteReservationMod($sport,$userId,$date,$heure);
        header('Location: /GestionSalleDeSportSAE/interfaceAdmin/afficherInterfaceAdmin');
        exit();
    }

    public function updateEvenement()
    {
        // Récupération des données du formulaire via POST
        $evenementId = $_POST['evenement_id']; // ID de l'événement (caché dans le formulaire)
        $nomEven = $_POST['nom_even'];
        $dateEven = $_POST['date_even'];
        $nomSport = $_POST['nom_sport'];

        // Appeler le modèle pour effectuer la mise à jour
        $this->interfaceAdminModel->updateEvenementMod($evenementId, $nomEven, $dateEven, $nomSport);

        // Redirection après la mise à jour
        header('Location: /GestionSalleDeSportSAE/interfaceAdmin/afficherEvenements');
        exit();
    }
}
