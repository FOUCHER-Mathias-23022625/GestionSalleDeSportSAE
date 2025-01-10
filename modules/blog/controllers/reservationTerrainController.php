<?php

namespace controllers;

use blog\models\compteModel;
use blog\models\reservationTerrainModel;
use blog\views\reservationTerrainView;
use JetBrains\PhpStorm\NoReturn;

require_once "./index.php";
require_once 'modules/blog/models/reservationTerrainModel.php';
require_once 'modules/blog/views/reservationTerrainView.php';
require_once 'modules/blog/models/compteModel.php';
//reeee//t

class reservationTerrainController
{
    // Attributs pour gérer les modèles et le contrôleur d'abonnement
    private $reservationTerrainModele;
    private $abonnementController;

    // Constructeur : initialisation des objets nécessaires
    public function __construct() {
        $this->reservationTerrainModele = new reservationTerrainModel();
        $this->abonnementController = new abonnementController();
    }

    // Méthode pour afficher la page de réservation de  terrain
    public function displayReservationTerrain(): void
    {
        // Vérifie que l'utilisateur est connecté
        if (!isset($_SESSION['id'])) {
            $_SESSION['alert'] = "Vous devez être connecté pour accéder à cette page";
            header('Location: /GestionSalleDeSportSAE/utilisateur/afficheFormConnexion');
            exit();
        }

        // Vérifie que l'utilisateur possède un abonnement valide
        if (!$this->abonnementController->checkAbo()) {
            $_SESSION['alert'] = "Vous devez posséder un abonnement pour accéder à cette page";
            header('Location: /GestionSalleDeSportSAE/abonnement/nosAbonnements');
            exit();
        }

        // Récupération des données de session et du formulaire pour afficher les réservations
        $reservation_status = isset($_SESSION['reservation_status']) ? $_SESSION['reservation_status'] : null;
        unset($_SESSION['reservation_status']); // Supprime le statut pour éviter les messages répétés
        $selected_sport = isset($_POST['sport']) ? $_POST['sport'] : null;
        $selected_date = isset($_POST['date']) ? $_POST['date'] : null;
        $selected_terrain = isset($_POST['terrain']) ? $_POST['terrain'] : null;

        // Affiche la vue avec les informations de réservation
        $view = new ReservationTerrainView();
        $view->afficher($selected_date, $selected_sport, $reservation_status);
    }

    // Méthode pour afficher les créneaux de réservation disponibles
    public function afficheRes($selected_date, $selected_sport): void
    {
        // Récupère les créneaux réservés pour les terrains
        $request_res = $this->reservationTerrainModele->getReservationTerrain($selected_date, $selected_sport, 1);
        $request_resBis = $this->reservationTerrainModele->getReservationTerrain($selected_date, $selected_sport, 2);

        if ($selected_sport && $selected_date): ?>
            <h2 class="titreSportSelec"><?php echo htmlspecialchars($selected_sport); ?></h2>
            <p class="dateSelectionné"><?php echo htmlspecialchars($selected_date); ?></p>
            <?php
            // Définit les plages horaires complètes pour les terrains
            $full_time_slots = range(8, 20); // Par exemple, de 8h à 20h

            // Analyse les créneaux déjà réservés
            $reserved_time_slots = [];
            $reserved_time_slotsBis = [];
            foreach ($request_res as $row) {
                $reserved_time_slots[] = (int)$row["heure"];
            }
            foreach ($request_resBis as $row) {
                $reserved_time_slotsBis[] = (int)$row["heure"];
            }

            // Calcule les créneaux disponibles
            $available_time_slots = array_diff($full_time_slots, $reserved_time_slots);
            $available_time_slotsBis = array_diff($full_time_slots, $reserved_time_slotsBis);
            ?>
            <section class="Reservation">
                <!-- Affichage des créneaux disponibles pour le terrain 1 -->
                <div class="colonne1">
                    <h3>Terrain 1</h3>
                    <div class="cardRes">
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
                </div>

                <!-- Affichage des créneaux disponibles pour le terrain 2 -->
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

    // Méthode pour ajouter une réservation
    public function addReservationTerrain(): void
    {
        $id_user = $_SESSION['id'];

        // Récupération des informations utilisateur
        $model = new compteModel();
        $mail = $model->utilisateurInformation()['EMail'];
        $nomUtili = $model->utilisateurInformation()['NomU'];

        // Récupération des données du formulaire
        $sport = htmlspecialchars($_POST['sport']);
        $date = htmlspecialchars($_POST['date']);
        $heure = htmlspecialchars($_POST['heure']);
        $terrain = htmlspecialchars($_POST['terrain']);

        if ($sport && $date && $heure && $terrain) {
            // Insère la réservation en base de données
            $result = $this->reservationTerrainModele->insererReservation($sport, $date, $heure, $terrain, $id_user);
            $result = json_decode($result, true);

            if ($result['status'] === 'success') {
                $_SESSION['reservation_status'] = 'success';

                // Prépare et envoie un email de confirmation
                $sujet = "Confirmation de votre réservation";
                $message = "Bonjour $nomUtili,\n\nVotre réservation a bien été prise en compte. Voici les détails :\n
                Sport : $sport\n
                Date : $date\n
                Heure : $heure\n
                Terrain : $terrain\n\n
                Merci pour votre confiance.\n\nCordialement,\nVotre équipe de SportHub";
                $headers = "From: gestionsaetest@alwaysdata.net\r\n";
                $headers .= "Reply-To: gestionsaetest@alwaysdata.net\r\n";
                $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

                mail($mail, $sujet, $message, $headers);
            } else {
                $_SESSION['reservation_status'] = 'error';
                $_SESSION['reservation_message'] = $result['message'];
            }
        } else {
            $_SESSION['reservation_status'] = 'fail';
        }

        // Redirige vers la page de réservation
        header('Location: displayReservationTerrain');
        exit();
    }
}
