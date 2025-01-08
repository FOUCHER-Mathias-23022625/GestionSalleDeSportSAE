<?php

namespace controllers;

use blog\models\compteModel;
use blog\models\reservationTerrainModel;
use blog\views\reservationTerrainView;
use JetBrains\PhpStorm\NoReturn;

require_once  "./index.php";
require_once 'modules/blog/models/reservationTerrainModel.php';
require_once 'modules/blog/views/reservationTerrainView.php';
require_once 'modules/blog/models/compteModel.php';
class  reservationTerrainController
{
    private $reservationTerrainModele;
    private $abonnementController;

    public function __construct() {
        $this->reservationTerrainModele = new reservationTerrainModel();
        $this->abonnementController = new abonnementController();
    }

    public function displayReservationTerrain(): void
    {
        if (!isset($_SESSION['id'])) {
            header('Location: /GestionSalleDeSportSAE/utilisateur/afficheFormConnexion');
            exit();
        }
        if (!$this->abonnementController->checkAbo()) {
            header('Location: /GestionSalleDeSportSAE/abonnement/afficheAbonnement');
            exit();
        }

        $reservation_status = isset($_SESSION['reservation_status']) ? $_SESSION['reservation_status'] : null;
        unset($_SESSION['reservation_status']);
        $selected_sport = isset($_POST['sport']) ? $_POST['sport'] : null;
        $selected_date = isset($_POST['date']) ? $_POST['date'] : null;
        $selected_terrain = isset($_POST['terrain']) ? $_POST['terrain'] : null;
        $view = new ReservationTerrainView();
        $view->afficher($selected_date,$selected_sport,$reservation_status);
    }

    public function afficheRes($selected_date, $selected_sport): void
    {
        $request_res = $this->reservationTerrainModele->getReservationTerrain($selected_date, $selected_sport, 1);
        $request_resBis = $this->reservationTerrainModele->getReservationTerrain($selected_date, $selected_sport, 2);
        if ($selected_sport && $selected_date): ?>
            <h2 class="titreSportSelec"><?php echo htmlspecialchars($selected_sport); ?></h2>
            <p class="dateSelectionné"><?php echo htmlspecialchars($selected_date); ?></p>
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
            <section class="Reservation">
                <div class="colonne1">
                    <h3>Terrain 1</h3>
                    <div class="cardRes">
                        <?php if (!empty($available_time_slots)): ?>                        <?php foreach ($available_time_slots as $time): ?>
                                <button class="time-slot" onclick="openModal('<?php echo htmlspecialchars($time); ?>', 1)">
                                    <?php echo htmlspecialchars($time); ?>:00 H
                                </button>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <p>Aucun créneau disponible pour <?php echo htmlspecialchars($selected_sport); ?> sur Terrain 1 ce jour-là.</p>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="colonne1">
                    <h3>Terrain 2</h3>
                    <div class="cardRes">
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
            </section>
        <?php
        endif;
    }


    public function addReservationTerrain(): void
    {
        $id_user = $_SESSION['id'];

        $model=new compteModel();
        $mail = $model->utilisateurInformation()['EMail'];
        $nomUtili = $model->utilisateurInformation()['NomU'];

        $sport = htmlspecialchars($_POST['sport']);
        $date = htmlspecialchars($_POST['date']);
        $heure = htmlspecialchars($_POST['heure']);
        $terrain = htmlspecialchars($_POST['terrain']);
        if ($sport && $date && $heure && $terrain) {
            $result = $this->reservationTerrainModele->insererReservation($sport, $date, $heure, $terrain, $id_user);
            $result = json_decode($result, true);
            if ($result['status'] === 'success') {
                $_SESSION['reservation_status'] = 'success';

                // Préparer le message de l'email
                $sujet = "Confirmation de votre réservation";
                $message = "Bonjour $nomUtili,\n\n Votre réservation a bien été prise en compte. Voici les détails :\n
                Sport : $sport\n
                Date : $date\n
                Heure : $heure\n
                Terrain : $terrain\n\n
                Merci pour votre confiance.\n\n
                Cordialement,\nVotre équipe de SportHub";
                $headers = "From: gestionsaetest@alwaysdata.net\r\n";
                $headers .= "Reply-To: gestionsaetest@alwaysdata.net\r\n";
                $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

                // Envoyer l'email

                mail($mail, $sujet, $message, $headers);
            } else {
                $_SESSION['reservation_status'] = 'error';
                $_SESSION['reservation_message'] = $result['message'];
            }
        } else {
            $_SESSION['reservation_status'] = 'fail';
        }
        header('Location: displayReservationTerrain');
        exit();
    }

}
