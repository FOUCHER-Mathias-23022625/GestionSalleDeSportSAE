<?php

namespace blog\views;
use controllers\reservationUtilisateurController;
require_once "Layout.php";
class reservationUtilisateurView
{

    public function afficher()
    {
        ob_start();?>
        <div class="container">
        <h1>Mes Réservations</h1>

        <h2>Réservations à venir</h2>
        <?php if (!empty($reservationsFutures)): ?>
            <ul>
                <?php foreach ($reservationsFutures as $reservation): ?>
                    <li>
                        Sport: <?php echo htmlspecialchars($reservation['sport']); ?><br>
                        Date: <?php echo htmlspecialchars($reservation['date']); ?><br>
                        Heure: <?php echo htmlspecialchars($reservation['heure']); ?>:00 H
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <p>Vous n'avez aucune réservation à venir.</p>
        <?php endif; ?>

        <h2>Réservations passées</h2>
        <?php if (!empty($reservationsPassees)): ?>
            <ul>
                <?php foreach ($reservationsPassees as $reservation): ?>
                    <li>
                        Sport: <?php echo htmlspecialchars($reservation['sport']); ?><br>
                        Date: <?php echo htmlspecialchars($reservation['date']); ?><br>
                        Heure: <?php echo htmlspecialchars($reservation['heure']); ?>:00 H
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <p>Vous n'avez aucune réservation passée.</p>
        <?php endif; ?>
    </div>
<?php (new \Blog\Views\Layout('Mes Reservations', ob_get_clean()))->afficher();
    }
}