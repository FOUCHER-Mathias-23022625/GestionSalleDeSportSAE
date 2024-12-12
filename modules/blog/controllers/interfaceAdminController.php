<?php
namespace blog\controllers;
namespace controllers;


use blog\views\interfaceAdminView;
use blog\models\interfaceAdminModel;
use blog\models\compteModel;
use Index;
use blog\views\Layout;


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
    public function AfficheUsers()
    {
        $users = $this->interfaceAdminModel->GetAllUsers();
        foreach ($users as $user): ?>
            <tr>
                <td><?= htmlspecialchars($user['IdUtilisateur'] ?? '') ?></td>
                <td><?= htmlspecialchars($user['NomU'] ?? '') ?></td>
                <td><?= htmlspecialchars($user['PrenomU'] ?? '') ?></td>
                <td><?= htmlspecialchars($user['EMail'] ?? '') ?></td>
                <td><?= htmlspecialchars($user['admin'] ?? '') ?></td>
                <td class="actions">
                    <button onclick="openConfirmationBox()">Supprimer l'utilisateur</button>
                    <a href="update.php?id=<?= urlencode($user['IdUtilisateur']) ?>" class="edit-icon" title="Mettre à jour">
                        ✏️
                    </a>
                </td>
            </tr>
        <?php endforeach; ?>

        <div id="confirmation-container">
            <div id="confirm-overlay" class="custom-overlay">
                <div id="confirm-box" class="custom-box">
                    <p>Êtes-vous sûr de vouloir supprimer l\'utilisateur ' . htmlspecialchars($userId) . ' ?</p>
                    <div class="custom-actions">
                        <<a href="/GestionSalleDeSportSAE/interfaceAdmin/deleteUser/<?= urlencode($user['IdUtilisateur']) ?>" class="delete-icon" title="Supprimer">Confirmer</a>
                        <button class="custom-cancel-btn" onclick="closeConfirmationBox()">Annuler</button>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }

    public function AfficheReservations()
    {
        $reservations = $this->interfaceAdminModel->GetAllReservations();
        foreach ($reservations as $reservation): ?>
            <tr>
                <td><?= htmlspecialchars($reservation['sport'] ?? '') ?></td>
                <td><?= htmlspecialchars($reservation['user_id'] ?? '') ?></td>
                <td><?= htmlspecialchars($reservation['date'] ?? '') ?></td>
                <td><?= htmlspecialchars($reservation['heure'] ?? '') ?></td>
                <td><?= htmlspecialchars($reservation['terrain'] ?? '') ?></td>
                <td class="actions">
                    <a href="/GestionSalleDeSportSAE/interfaceAdmin/deleteReservation/<?= urlencode($reservation['sport']) ?>/<?= urlencode($reservation['user_id']) ?>/<?= urlencode($reservation['date']) ?>/<?= urlencode($reservation['heure']) ?>" class="delete-icon" title="Supprimer">
                        ❌
                    </a>
                    <a href="update.php?id=<?= urlencode($user['IdUtilisateur']) ?>" class="edit-icon" title="Mettre à jour">
                        ✏️
                    </a>
                </td>
            </tr>
        <?php endforeach;
    }

    public function AfficheEvenements()
    {
        $evenements = $this->interfaceAdminModel->GetAllEvenements();
        foreach ($evenements as $evenement): ?>
            <tr>
                <td><?= htmlspecialchars($evenement['IdEvenement'] ?? '') ?></td>
                <td><?= htmlspecialchars($evenement['NomEven'] ?? '') ?></td>
                <td><?= htmlspecialchars($evenement['DateEven'] ?? '') ?></td>
                <td><?= htmlspecialchars($evenement['NomSport'] ?? '') ?></td>
                <td class="actions">
                    <a href="/GestionSalleDeSportSAE/interfaceAdmin/deleteEvent/<?= urlencode($evenement['IdEvenement']) ?>" class="delete-icon" title="Supprimer">
                        ❌
                    </a>
                    <a href="update.php?id=<?= urlencode($user['IdUtilisateur']) ?>" class="edit-icon" title="Mettre à jour">
                        ✏️
                    </a>
                </td>
            </tr>
        <?php endforeach;
    }

    public function deleteUser($userId)
    {
        $this->interfaceAdminModel->deleteUserMod($userId);
        exit();
    }

    public function deleteEvent($eventId){
        $this->interfaceAdminModel->deleteEvent($eventId);
        exit();
    }

    public function deleteReservation($sport,$userId,$date,$heure){
        $this->interfaceAdminModel->deleteResa($sport,$userId,$date,$heure);
        exit();
    }
}