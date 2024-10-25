<?php

namespace blog\views;
use controllers\reservationUtilisateurController;
require_once "Layout.php";
class reservationUtilisateurView
{

    public function afficher($reservationsFutures, $reservationsPassees)
    {
        ob_start();?>
        <section class="containerUtilisateurReservation">
            <h1>Mes Réservations</h1>

            <!-- Résumé rapide -->
            <div class="summary-container">
                <h2>Résumé</h2>
                <div class="summary-info">
                    <p>Nombre de réservations à venir : <?php echo count($reservationsFutures); ?></p>
                    <p>Nombre de réservations passées : <?php echo count($reservationsPassees); ?></p>
                </div>
            </div>

            <!-- Champ de recherche et filtres -->
            <div class="search-filter-container">
                <input type="text" id="search" placeholder="Rechercher une réservation...">
                <select id="filter">
                    <option value="">Tous les sports</option>
                    <option value="football">Foot</option>
                    <option value="ping-pong">ping-pong</option>
                    <option value="basket">basket</option>
                    <option value="badminton">badminton</option>
                    <option value="Volley-ball">Volley-ball</option>
                    <option value="tennis">Tennis</option>
                    <!-- Ajoute d'autres sports selon tes besoins -->
                </select>
            </div>

            <div class="lists-container">
                <!-- Future Reservations List -->
                <div class="future-reservations">
                    <h2>Réservations à venir</h2>
                    <?php if (!empty($reservationsFutures)): ?>
                        <ul>
                            <?php foreach ($reservationsFutures as $reservation): ?>
                                <li class="reservation-card">
                                    <div class="reservation-info">
                                        <div><i class="fas fa-running"></i> Sport: <?php echo htmlspecialchars($reservation['sport']); ?></div>
                                        <div><i class="fas fa-calendar-alt"></i> Date: <?php echo htmlspecialchars($reservation['date']); ?></div>
                                        <div><i class="fas fa-clock"></i> Heure: <?php echo htmlspecialchars($reservation['heure']); ?>:00 H</div>
                                    </div>
                                    <!-- Bouton d'action rapide -->
                                    <div class="action-buttons">
                                        <button class="btn details-btn" onclick="openModaldeleteUtilisateur('<?php echo htmlspecialchars($reservation['sport']); ?>', '<?php echo htmlspecialchars($reservation['heure']); ?>', '<?php echo htmlspecialchars($reservation['date']); ?>')">Annuler</button>
                                    </div>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    <?php else: ?>
                        <p>Vous n'avez aucune réservation à venir.</p>
                    <?php endif; ?>
                </div>

                <!-- Past Reservations List -->
                <div class="past-reservations">
                    <h2>Réservations passées</h2>
                    <?php if (!empty($reservationsPassees)): ?>
                        <ul>
                            <?php foreach ($reservationsPassees as $reservation): ?>
                                <li class="reservation-card">
                                    <div class="reservation-info">
                                        <div><i class="fas fa-running"></i> Sport: <?php echo htmlspecialchars($reservation['sport']); ?></div>
                                        <div><i class="fas fa-calendar-alt"></i> Date: <?php echo htmlspecialchars($reservation['date']); ?></div>
                                        <div><i class="fas fa-clock"></i> Heure: <?php echo htmlspecialchars($reservation['heure']); ?>:00 H</div>
                                    </div>
                                    <!-- Bouton pour plus de détails -->
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    <?php else: ?>
                        <p>Vous n'avez aucune réservation passée.</p>
                    <?php endif; ?>
                </div>
            </div>
        </section>

        <!-- Modal pour afficher les détails de la réservation -->
        <div class="modal-overlay"></div>
        <form id="modal-delete-utilisateur" class="modalDeleteUser" action="/GestionSalleDeSportSAE/reservationUtilisateur/deleteReservationUtilisateur" method="POST">
            <h2>Annuler la réservation</h2>
            <span class="close-btn" onclick="closeModalDelete()">&times;</span>
            <p>Voulez-vous vraiment annuler la réservation du : <span id="selectedDate"></span> à <span id="selectedTime"></span> :00 H
                <br>Pour le sport : <span id="selectedSport"></span></p>
            <input type="hidden" name="sport" id="inputSelectedSport">
            <input type="hidden" name="date" id="inputSelectedDate">
            <input type="hidden" name="heure" id="inputSelectedTime">
            <button type="submit" class="btn cancel-btn">Confirmer</button>
        </form>

        <script src="/GestionSalleDeSportSAE/assets/scripts/reservationUtilisateur.js"></script>
        <?php (new \Blog\Views\Layout('Mes Reservations', ob_get_clean()))->afficher();
    }
}