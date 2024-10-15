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
        $reservation_status = isset($_SESSION['reservation_status']) ? $_SESSION['reservation_status'] : null;
        unset($_SESSION['reservation_status']);
        $selected_sport = isset($_POST['sport']) ? $_POST['sport'] : null;
        $selected_date = isset($_POST['date']) ? $_POST['date'] : null;
        $selected_terrain = isset($_POST['terrain']) ? $_POST['terrain'] : null;
        $view = new ReservationTerrainView();
        $view->afficher($selected_date,$selected_sport,$reservation_status,$selected_terrain);
    }

    public function afficheRes($selected_date, $selected_sport)
    {
        $request_res = $this->reservationTerrainModele->getReservationTerrain($selected_date, $selected_sport, 1);
        $request_resBis = $this->reservationTerrainModele->getReservationTerrain($selected_date, $selected_sport, 2);
        if ($selected_sport && $selected_date): ?>
            <h2><?php echo htmlspecialchars($selected_date); ?></h2>
            <p><?php echo htmlspecialchars($selected_sport); ?></p>
        <?php
            // Liste complète des créneaux horaires (par exemple de 8h à 20h)
            $full_time_slots = range(8, 20); // Vous pouvez ajuster cette plage selon vos besoins

            // Extraire les heures déjà réservées
            $reserved_time_slots = [];
            $reserved_time_slotsBis = [];
            if (!empty($request_res)) {
                foreach ($request_res as $row) {
                    $reserved_time_slots[] = (int) $row["heure"]; // Convertir les heures en int pour correspondre
                }
            }
            if (!empty($request_resBis)) {
                foreach ($request_resBis as $row) {
                    $reserved_time_slotsBis[] = (int) $row["heure"]; // Convertir les heures en int pour correspondre
                }
            }

            // Trouver les créneaux non réservés
            $available_time_slots = array_diff($full_time_slots, $reserved_time_slots);
            $available_time_slotsBis = array_diff($full_time_slots, $reserved_time_slotsBis);
            ?>
            <div class="Reservation">
                <!-- Afficher les créneaux disponibles pour le terrain 1 -->
                <h3>Terrain 1</h3>
                <div class="card">
                    <?php if (!empty($available_time_slots)): ?>
                        <?php foreach ($available_time_slots as $time): ?>
                            <button class="time-slot" onclick="openModal('<?php echo htmlspecialchars($time); ?>', 1)">
                                <?php echo htmlspecialchars($time); ?>:00 H
                            </button>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p>Aucun créneau disponible pour <?php echo htmlspecialchars($selected_sport); ?> sur Terrain 1 ce jour-là.</p>
                    <?php endif; ?>
                </div>

                <!-- Afficher les créneaux disponibles pour le terrain 2 -->
                <h3>Terrain 2</h3>
                <div class="card">
                    <?php if (!empty($available_time_slotsBis)): ?>
                        <?php foreach ($available_time_slotsBis as $time2): ?>
                            <button class="time-slot" onclick="openModal('<?php echo htmlspecialchars($time2); ?>', 2)">
                                <?php echo htmlspecialchars($time2); ?>:00 H
                            </button>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p>Aucun créneau disponible pour <?php echo htmlspecialchars($selected_sport); ?> sur Terrain 2 ce jour-là.</p>
                    <?php endif; ?>
                </div>
            </div>
        <?php
        else:
            echo "<p>Aucun sport ou date sélectionné.</p>";
        endif;
    }
    // j'ai un probleme, je n'arrive pas a afficher uniquement les terrains dispinibles pour le sport selectionné et pas tout les terrains disponibles

    public function addReservationTerrain()
    {
        $sport = htmlspecialchars($_POST['sport']);
        $date = htmlspecialchars($_POST['date']);
        $heure = htmlspecialchars($_POST['heure']);
        $terrain = htmlspecialchars($_POST['terrain']);
        if ($sport && $date && $heure && $terrain) {
            $this->reservationTerrainModele->insererReservation($sport, $date, $heure, $terrain);
            $_SESSION['reservation_status'] = 'success';
        } else {
            $_SESSION['reservation_status'] = 'fail';
        }
        header('Location: displayReservationTerrain');
        exit();
    }

}
