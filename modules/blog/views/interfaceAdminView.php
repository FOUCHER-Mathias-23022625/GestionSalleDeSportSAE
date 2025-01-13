<?php
namespace blog\views;

use controllers\interfaceAdminController;

require_once "Layout.php";
require_once  "modules/blog/controllers/interfaceAdminController.php";
require_once "modules/blog/models/interfaceAdminModel.php";
//t
class interfaceAdminView
{

    public function __construct()
    {
    }

    public function afficher()
    {
        ob_start();?>
        <main class="admin-container">
            <h1>Bienvenue sur la page admin</h1>

            <!-- Section Utilisateurs -->
            <section>
                <h2>Utilisateurs</h2>
                <div class="search-filter-container">
                    <input type="text" id="search-utilisateurs" placeholder="Rechercher un utilisateur...">
                </div>
                <table>
                    <tr>
                        <th>ID</th>
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>Email</th>
                        <th>Admin</th>
                        <th>Actions</th>
                    </tr>
                    <?php
                    $interfaceAdminController = new interfaceAdminController();
                    //sert a afficher toute les utilisateurs de la base de données
                    foreach ($interfaceAdminController->getUsers() as $user): ?>
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
                </table>
            </section>

            <!-- Section Réservations -->
            <section>
                <h2>Réservations</h2>
                <div class="search-filter-container">
                    <input type="text" id="search-reservations" placeholder="Rechercher une réservation...">
                </div>
                <table>
                    <tr>
                        <th>Sport</th>
                        <th>User ID</th>
                        <th>Date</th>
                        <th>Heure</th>
                        <th>Terrain</th>
                        <th>Actions</th>
                    </tr>
                    <?php $interfaceAdminController = new interfaceAdminController();
                    //sert a afficher toute les reservation de la base de données
                    foreach ($interfaceAdminController->getReservations() as $reservation): ?>
                        <tr>
                            <td><?= htmlspecialchars($reservation['sport'] ?? '') ?></td>
                            <td><?= htmlspecialchars($reservation['user_id'] ?? '') ?></td>
                            <td><?= htmlspecialchars($reservation['date'] ?? '') ?></td>
                            <td><?= htmlspecialchars($reservation['heure'] ?? '') ?></td>
                            <td><?= htmlspecialchars($reservation['terrain'] ?? '') ?></td>
                            <td class="actions">
                                <button data-sport="<?= htmlspecialchars($reservation['sport'] ?? '', ENT_QUOTES) ?>"
                                        data-user-id="<?= htmlspecialchars($reservation['user_id'] ?? '', ENT_QUOTES) ?>"
                                        data-date="<?= htmlspecialchars($reservation['date'] ?? '', ENT_QUOTES) ?>"
                                        data-heure="<?= htmlspecialchars($reservation['heure'] ?? '', ENT_QUOTES) ?>"
                                        onclick="openConfirmationBoxReserv(this)">❌</button>
                                <button onclick='openEditReservationBox(<?= json_encode($reservation, JSON_HEX_TAG) ?>)'>✏️</button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </table>
            </section>

            <!-- Section Événements -->
            <section>
                <h2>Événements</h2>
                <div class="search-filter-container">
                    <input type="text" id="search-evenements" placeholder="Rechercher un événement...">
                </div>
                <table>
                    <tr>
                        <th>ID Événement</th>
                        <th>Nom de l'événement</th>
                        <th>Date</th>
                        <th>Sport</th>
                        <th>Actions</th>
                    </tr>
                    <?php $interfaceAdminController = new interfaceAdminController();
                    //sert a afficher toute les évenements de la base de données

                    foreach ($interfaceAdminController->getEvenements() as $evenement): ?>
                        <tr>
                            <td><?= htmlspecialchars($evenement['IdEvenement'] ?? '') ?></td>
                            <td><?= htmlspecialchars($evenement['NomEven'] ?? '') ?></td>
                            <td><?= htmlspecialchars($evenement['DateEven'] ?? '') ?></td>
                            <td><?= htmlspecialchars($evenement['NomSport'] ?? '') ?></td>
                            <td class="actions">
                                <button onclick="openConfirmationBoxEvent(<?= isset($evenement['IdEvenement']) ? urlencode($evenement['IdEvenement']) : 'null' ?>)">❌</button>
                                <button onclick='openEditEvenementBox(<?= json_encode($evenement, JSON_HEX_TAG) ?>)'>✏️</button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </table>
            </section>
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
            <!-- Edit box qui nous permets de modifier les informations d'un utilisateur -->
            <div id="edit-container">
                <div id="edit-overlay-user" class="custom-overlay">
                    <div class="custom-box">
                        <form class="custom-form" action="/GestionSalleDeSportSAE/interfaceAdmin/updateUser" method="POST">
                            <input type="hidden" name="IdUtilisateur" id="edit-id">
                            <div class="custom-inputNom">
                                <label for="edit-nom">Nom :</label>
                                <input type="text" name="NomU" id="edit-nom" required>
                            </div>
                            <br>
                            <div class="custom-inputPrenom">
                                <label for="edit-prenom">Prénom :</label>
                                <input type="text" name="PrenomU" id="edit-prenom" required>
                            </div>
                            <br>
                            <div class="custom-inputMail">
                                <label for="edit-email">Email :</label>
                                <input type="email" name="EMail" id="edit-email" required>
                            </div>
                            <br>
                            <div class="custom-inputAdmin">
                                <label for="edit-admin">Admin :</label>
                                <select name="admin" id="edit-admin" required>
                                    <option value="0">Non</option>
                                    <option value="1">Oui</option>
                                </select>
                            </div>
                            <br>
                            <div class="custom-actions">
                                <button type="submit" class="custom-save-btn">Sauvegarder</button>
                                <button type="button" class="custom-cancel-btn" onclick="closeEditBoxUser()">Annuler</button>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- Edit box qui nous permets de modifier les informations d'une réservation -->
                </div>
                <div id="edit-container">
                    <div id="edit-overlay-resa" class="custom-overlay">
                        <div class="custom-box">
                            <form class="custom-form" action="/GestionSalleDeSportSAE/interfaceAdmin/updateReservation" method="POST">
                                <div class="admin-reservationSport">
                                    <label for="edit-sport">Sport choisis :</label>
                                    <input type="text" name="sport" id="edit-sport" required>
                                </div>
                                <br>
                                <div class="admin-reservationIdUser">
                                    <label for="edit-user-id">L'id de l'utilisateur :</label>
                                    <input type="text" name="userId" id="edit-user-id" required>
                                </div>
                                <br>
                                <div class="admin-reservationDate">
                                    <label for="edit-date">Date :</label>
                                    <input type="date" name="date" id="edit-date" required>
                                </div>
                                <br>
                                <div class="admin-reservationHeure">
                                    <label for="edit-heure">Heure :</label>
                                    <input type="time" id="edit-heure" name="heure" required>
                                </div>
                                <br>
                                <div class="admin-reservationTerrain">
                                    <label for="edit-terrain">Terrain :</label>
                                    <select name="terrain" id="edit-terrain" required>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                    </select>
                                </div>
                                <br>
                                <div class="custom-actions">
                                    <button type="submit" class="custom-save-btn">Sauvegarder</button>
                                    <button type="button" class="custom-cancel-btn" onclick="closeEditBoxResa()">Annuler</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            <!-- Edit box qui nous permets de modifier les informations d'un événement -->
            <div id="edit-container">
                <div id="edit-overlay-event" class="custom-overlay">
                    <div class="custom-box">
                        <form class="custom-form" action="/GestionSalleDeSportSAE/interfaceAdmin/updateEvenement" method="POST">
                            <input type="hidden" name="evenement_id" id="edit-evenement-id">
                            <div class="admin-evenNom">
                                <label for="edit-nom-even">Nom de l'événement :</label>
                                <input type="text" name="nom_even" id="edit-nom-even" required>
                            </div>
                            <br>
                            <div class="admin-evenDate">
                                <label for="edit-date-even">Date de l'événement :</label>
                                <input type="date" name="date_even" id="edit-date-even" required>
                            </div>
                            <br>
                            <div class="admin-evenSport">
                                <label for="edit-nom-sport">Nom du sport :</label>
                                <input type="text" name="nom_sport" id="edit-nom-sport" required>
                            </div>
                            <br>
                            <div class="custom-actions">
                                <button type="submit" class="custom-save-btn">Sauvegarder</button>
                                <button type="button" class="custom-cancel-btn" onclick="closeEditBoxEvent()">Annuler</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </main>

        <script type="text/javascript" src="/GestionSalleDeSportSAE/assets/scripts/interfaceAdmin.js"></script>

        <?php (new \Blog\Views\Layout('Interface Administrateur', ob_get_clean()))->afficher();
    }
}
