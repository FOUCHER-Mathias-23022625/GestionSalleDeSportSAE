<?php
//t
namespace blog\views;
use controllers\reservationTerrainController;
require_once "Layout.php";
class reservationTerrainView
{
    public function afficher($selected_date,$selected_sport,$reservation_status)
    {

        ob_start();
        ?>
        <?php if ($reservation_status === 'success'): ?>
        <script type="text/javascript">
            alert("Votre réservation a été confirmée avec succès !");
        </script>
        <?php elseif ($reservation_status === 'error'): ?>
            <script type="text/javascript">
                alert("<?php echo $_SESSION['reservation_message']; ?>");
            </script>
        <?php elseif ($reservation_status === 'fail'): ?>
            <script type="text/javascript">
                alert("Échec de la réservation. Veuillez réessayer.");
            </script>
        <?php endif; ?>
        <section class="reservationChoice">
            <h1>Réserver un terrain de sport</h1>
            <p>Sélectionnez un sport pour voir les créneaux disponibles et réservez votre terrain !</p>
            <ul class="icons">
                <li class="icon" onclick="showForm('tennis', this)" id="tennis">
                    <img src="/GestionSalleDeSportSAE/assets/images/icons-sport/tennis.png" alt="Tennis Image" />
                </li>
                <li class="icon" onclick="showForm('football', this)" id="football">
                    <img src="/GestionSalleDeSportSAE/assets/images/icons-sport/football.png" alt="Football Image" />
                </li>
                <li class="icon" onclick="showForm('basket', this)" id="basket">
                    <img src="/GestionSalleDeSportSAE/assets/images/icons-sport/basket.png" alt="Basket Image" />
                </li>
                <li class="icon" onclick="showForm('volley-ball', this)" id="volley-ball">
                    <img src="/GestionSalleDeSportSAE/assets/images/icons-sport/volley-ball.png" alt="Volley-ball Image" />
                </li>
                <li class="icon" onclick="showForm('badminton', this)" id="badminton">
                    <img src="/GestionSalleDeSportSAE/assets/images/icons-sport/badminton.png" alt="badminton Image" />
                </li>
                <li class="icon" onclick="showForm('ping-pong', this)" id="ping-pong">
                    <img src="/GestionSalleDeSportSAE/assets/images/icons-sport/ping-pong.png" alt="ping-pong Image" />
                </li>
            </ul>

            <div id="sport-preview">
                <h2 id="preview-title">Sélectionnez un sport pour le prévisualiser</h2>

            </div>

            <div id="form-container">
                <form class="event-form" action="" method="POST">
                    <label for="sport" id="sportSelec">Sport sélectionné :</label>
                    <input type="text" id="selected-sport" name="sport" aria-label="textAutoChange" readonly>
                    <label for="date" id="dateSelec">Sélectionnez une date :</label>
                    <input type="date" id="date" name="date" min="<?php echo date('Y-m-d'); ?>">

                    <button class="btnVoirResa" type="submit"><span>Voir les terrains disponibles :</span><i></i></button>
                </form>
            </div>
        </section>
        <?php $afficherResDispo = new reservationTerrainController();
        $afficherResDispo->afficheRes($selected_date,$selected_sport); ?>

        <section id="reservationModal" class="modal">
            <form action="/GestionSalleDeSportSAE/reservationTerrain/addReservationTerrain" method="POST">
                <div class="modal-content">
                    <span class="close-btn" onclick="closeModal()">&times;</span>
                    <h2>Confirmer la réservation :</h2>
                    <p id="reservationDetails">Vous avez sélectionné le créneau horaire <span id="selectedTime"></span>:00 H <br>
                        pour le sport <?php echo $selected_sport ?><br
                        >Sur le terrain <span id="selectedTerrain"> </span>
                        <br>à la date <?php echo $selected_date?>.</p>
                    <input type="hidden" name="sport" id="sport" value="<?php echo $selected_sport ?>">
                    <input type="hidden" name="date" id="date" value="<?php echo $selected_date ?>">
                    <input type="hidden" name="heure" id="inputSelectedTime">
                    <input type="hidden" name="terrain" id="inputSelectedTerrain">
                    <button type="submit" class="validerResa">Confirmer</button>
                    <button onclick="closeModal()" class="annulerResa">Annuler</button>
                </div>
            </form>
        </section>
        <script type="text/javascript" src="/GestionSalleDeSportSAE/assets/scripts/reservation.js"></script>
        <?php
        (new \Blog\Views\Layout('Reservation de Terrain', ob_get_clean()))->afficher();
    }
}
?>