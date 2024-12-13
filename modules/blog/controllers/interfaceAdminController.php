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
                    <button onclick="openConfirmationBox(<?= urlencode($user['IdUtilisateur']) ?>)">❌</button>
                    <button onclick="openEditForm(<?= htmlspecialchars(json_encode($user)) ?>)">✏️</button>
                </td>
            </tr>
        <?php endforeach; ?>
        <!-- Confirmation box qui nous permets de valider la suppression et qui appelle la fonction qui supprime -->
        <div id="confirmation-container">
            <div id="confirm-overlay" class="custom-overlay">
                <div id="confirm-box" class="custom-box">
                    <p>Êtes-vous sûr de vouloir supprimer l'utilisateur ?</p>
                    <div class="custom-actions">
                        <a id="confirm-link" href="#" class="delete-icon" title="Supprimer">Confirmer</a>
                        <button class="custom-cancel-btn" onclick="closeConfirmationBox()">Annuler</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Edit box qui nous permets de modifier les informations d'un utilisateur -->
        <div id="edit-container">
            <div id="edit-overlay-user" class="custom-overlay">
                <div class="custom-box">
                    <form class="custom-form" action="/GestionSalleDeSportSAE/interfaceAdmin/updateUser" method="POST">
                        <input type="hidden" name="IdUtilisateur" id="edit-id">

                        <label for="edit-nom">Nom :</label>
                        <input type="text" name="NomU" id="edit-nom" required>

                        <label for="edit-prenom">Prénom :</label>
                        <input type="text" name="PrenomU" id="edit-prenom" required>

                        <label for="edit-email">Email :</label>
                        <input type="email" name="EMail" id="edit-email" required>

                        <label for="edit-admin">Admin :</label>
                        <select name="admin" id="edit-admin" required>
                            <option value="0">Non</option>
                            <option value="1">Oui</option>
                        </select>

                        <div class="custom-actions">
                            <button type="submit" class="custom-save-btn">Sauvegarder</button>
                            <button type="button" class="custom-cancel-btn" onclick="closeEditBoxUser()">Annuler</button>
                        </div>
                    </form>
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
                    <button onclick="openConfirmationBoxReserv(
                            '<?= htmlspecialchars($reservation['sport'] ?? '', ENT_QUOTES) ?>',
                            '<?= htmlspecialchars($reservation['user_id'] ?? '', ENT_QUOTES) ?>',
                            '<?= htmlspecialchars($reservation['date'] ?? '', ENT_QUOTES) ?>',
                            '<?= htmlspecialchars($reservation['heure'] ?? '', ENT_QUOTES) ?>'
                            )">❌</button>
                    <button onclick='openEditReservationBox(<?= json_encode($reservation, JSON_HEX_TAG) ?>)'>✏️</button>
                </td>
            </tr>
        <?php endforeach; ?>

            <!-- Confirmation box qui nous permets de valider la suppression et qui appelle la fonction qui supprime -->
        <div id="confirmation-container">
            <div id="confirm-overlay" class="custom-overlay">
                <div id="confirm-box" class="custom-box">
                    <p>Êtes-vous sûr de vouloir supprimer cette réservation ?</p>
                    <div class="custom-actions">
                        <a id="confirm-link" href="#" class="delete-icon" title="Supprimer">Confirmer</a>
                        <button class="custom-cancel-btn" onclick="closeConfirmationBox()">Annuler</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Edit box qui nous permets de modifier les informations d'une reservation -->

        <div id="edit-container">
            <div id="edit-overlay-resa" class="custom-overlay">
                <div class="custom-box">
                    <form class="custom-form" action="/GestionSalleDeSportSAE/interfaceAdmin/updateReservation" method="POST">
                        <label for="edit-sport">Sport choisis :</label>
                        <input type="text" name="sport" id="edit-sport" required>

                        <label for="edit-user-id">L'id de l'utilisateur :</label>
                        <input type="text" name="userId" id="edit-user-id" required>

                        <label for="edit-date">Date :</label>
                        <input type="date" name="date" id="edit-date" required>

                        <label for="edit-heure">Heure :</label>
                        <input type="time" id="edit-heure" name="heure" required>

                        <label for="edit-terrain">Terrain :</label>
                        <select name="terrain" id="edit-terrain" required>
                            <option value="1">1</option>
                            <option value="2">2</option>
                        </select>

                        <div class="custom-actions">
                            <button type="submit" class="custom-save-btn">Sauvegarder</button>
                            <button type="button" class="custom-cancel-btn" onclick="closeEditBoxResa()">Annuler</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <?php
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
                    <button onclick="openConfirmationBoxEvent(<?= isset($evenement['IdEvenement']) ? urlencode($evenement['IdEvenement']) : 'null' ?>)">❌</button>
                    <button onclick='openEditEvenementBox(<?= json_encode($evenement, JSON_HEX_TAG) ?>)'>️️️️✏️</button>
                </td>
            </tr>
        <?php endforeach; ?>

        <div id="confirmation-container">
            <div id="confirm-overlay" class="custom-overlay">
                <div id="confirm-box" class="custom-box">
                    <p>Êtes-vous sûr de vouloir supprimer cette évènement ?</p>
                    <div class="custom-actions">
                        <a id="confirm-link" href="#" class="delete-icon" title="Supprimer">Confirmer</a>
                        <button class="custom-cancel-btn" onclick="closeConfirmationBox()">Annuler</button>
                    </div>
                </div>
            </div>
        </div>

        <div id="edit-container">
            <div id="edit-overlay-event" class="custom-overlay">
                <div class="custom-box">
                    <form class="custom-form" action="/GestionSalleDeSportSAE/interfaceAdmin/updateEvenement" method="POST">
                        <input type="hidden" name="evenement_id" id="edit-evenement-id">

                        <label for="edit-nom-even">Nom de l'événement :</label>
                        <input type="text" name="nom_even" id="edit-nom-even" required>

                        <label for="edit-date-even">Date de l'événement :</label>
                        <input type="date" name="date_even" id="edit-date-even" required>

                        <label for="edit-nom-sport">Nom du sport :</label>
                        <input type="text" name="nom_sport" id="edit-nom-sport" required>

                        <div class="custom-actions">
                            <button type="submit" class="custom-save-btn">Sauvegarder</button>
                            <button type="button" class="custom-cancel-btn" onclick="closeEditBoxEvent()">Annuler</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

<?php    }


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
