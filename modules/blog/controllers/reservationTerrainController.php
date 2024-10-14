<?php

namespace controllers;

use blog\models\reservationTerrainModele;
use blog\views\reservationTerrainView;
require_once  "./index.php";
require_once 'modules/blog/models/reservationTerrainModele.php';
require_once 'modules/blog/views/reservationTerrainView.php';
class reservationTerrainController
{
    private $reservationTerrainModele;

    public function __construct() {
        $host_name = "mysql-gestionsaetest.alwaysdata.net";
        $user_name = "379076";
        $password  = "gestionSae";
        $database_name = "gestionsaetest_bd";

        $this->reservationTerrainModele = new reservationTerrainModele($host_name, $user_name, $password, $database_name);
    }

    public function displayReservationTerrain()
    {

        $selected_sport = isset($_POST['sport']) ? $_POST['sport'] : null;
        $selected_date = isset($_POST['date']) ? $_POST['date'] : null;
        $reservation = $this ->reservationTerrainModele ->getReservationTerrain($selected_sport,$selected_date);
        if ($selected_sport && $selected_date) {
            $reservation = $this->reservationTerrainModele->getReservationTerrain($selected_date, $selected_sport);
        } else {
            $reservation = [];
        }
        $view = new ReservationTerrainView();
        $view->afficher($reservation,$selected_date,$selected_sport);
    }

    public function afficheRes($selected_sport, $selected_date,$request_res)
    {
        if ($selected_sport && $selected_date): ?>
            <h2><?php echo htmlspecialchars($selected_date); ?></h2>
            <p><?php echo htmlspecialchars($selected_sport); ?></p>

            <?php
            // Liste complète des créneaux horaires (par exemple de 8h à 20h)
            $full_time_slots = range(8, 20); // Vous pouvez ajuster cette plage selon vos besoins

            // Extraire les heures déjà réservées
            $reserved_time_slots = [];
            if (!empty($request_res)) {
                foreach ($request_res as $row) {
                    $reserved_time_slots[] = (int) $row["heure"]; // Convertir les heures en int pour correspondre
                }
            }

            // Trouver les créneaux non réservés
            $available_time_slots = array_diff($full_time_slots, $reserved_time_slots);
            ?>

            <?php if (!empty($available_time_slots)): ?>
                <!-- Affichage des créneaux horaires disponibles -->
                <?php foreach ($available_time_slots as $time): ?>
                    <button class="time-slot" onclick="openModal('<?php echo htmlspecialchars($time); ?>')">
                        <?php echo htmlspecialchars($time); ?>:00 H
                    </button>
                <?php endforeach; ?>
            <?php else: ?>
                <!-- Message si aucun créneau n'est disponible -->
                <p>Aucun créneau disponible pour <?php echo htmlspecialchars($selected_sport); ?> ce jour-là.</p>
            <?php endif; ?>

        <?php else: ?>
            <p>Aucun sport ou date sélectionné.</p>
        <?php endif;
    }

    public function addReservationTerrain()
    {
        $sport = htmlspecialchars($_POST['sport']);
        $date = htmlspecialchars($_POST['date']);
        $heure = htmlspecialchars($_POST['heure']);
        $this->reservationTerrainModele->insererReservation($sport, $date, $heure);
    }

}
