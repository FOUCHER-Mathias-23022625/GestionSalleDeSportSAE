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

            <div class="lists-container">
                <!-- Future Reservations List -->
                <div class="future-reservations">
                    <h2>Réservations à venir</h2>
                    <?php if (!empty($reservationsFutures)): ?>
                        <ul>
                            <?php foreach ($reservationsFutures as $reservation): ?>
                                <li>
                                    <div class="reservation-info">
                                        <div>Sport: <?php echo htmlspecialchars($reservation['sport']); ?></div>
                                        <div>Date: <?php echo htmlspecialchars($reservation['date']); ?></div>
                                        <div>Heure: <?php echo htmlspecialchars($reservation['heure']); ?>:00 H</div>
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
                                <li>
                                    <div class="reservation-info">
                                        <div>Sport: <?php echo htmlspecialchars($reservation['sport']); ?></div>
                                        <div>Date: <?php echo htmlspecialchars($reservation['date']); ?></div>
                                        <div>Heure: <?php echo htmlspecialchars($reservation['heure']); ?>:00 H</div>
                                    </div>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    <?php else: ?>
                        <p>Vous n'avez aucune réservation passée.</p>
                    <?php endif; ?>
                </div>
            </div>
        </section>
        <?php (new \Blog\Views\Layout('Mes Reservations', ob_get_clean()))->afficher();
    }
}