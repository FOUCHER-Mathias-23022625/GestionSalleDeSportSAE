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
                    foreach ($interfaceAdminController->getReservations() as $reservation): ?>
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
                                    '<?= htmlspecialchars($reservation['heure'] ?? '', ENT_QUOTES) ?>')">❌</button>
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
        </main>

        <script type="text/javascript" src="/GestionSalleDeSportSAE/assets/scripts/interfaceAdmin.js"></script>

        <?php (new \Blog\Views\Layout('Interface Administrateur', ob_get_clean()))->afficher();
    }
}
