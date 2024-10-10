<?php

namespace blog\views;
use navebar;
require_once "navebar.php";
require_once "Layout.php";
class reservationTerrainView
{
    public function afficher($request_res,$selected_date,$selected_sport)
    {
        $navebar = new navebar();
        $navebar->afficher();
        ob_start();?>
        <div class="reservationChoice">
            <h1>Réserver un terrain de sport</h1>
            <p>Sélectionnez un sport pour voir les créneaux disponibles et réservez votre terrain !</p>

            <div class="icons">
                <div class="icon" onclick="showForm('tennis', this)" id="tennis">
                    <img src="../../../assets/images/icons-sport/tennis.png" alt="Tennis Image" />
                </div>
                <div class="icon" onclick="showForm('football', this)" id="football">
                    <img src="../../../assets/images/icons-sport/football.png" alt="Football Image" />
                </div>
                <div class="icon" onclick="showForm('basket', this)" id="basket">
                    <img src="../../../assets/images/icons-sport/basket.png" alt="Basket Image" />
                </div>
                <div class="icon" onclick="showForm('volley-ball', this)" id="volley-ball">
                    <img src="../../../assets/images/icons-sport/volley-ball.png" alt="Volley-ball Image" />
                </div>
                <div class="icon" onclick="showForm('badminton', this)" id="badminton">
                    <img src="../../../assets/images/icons-sport/badminton.png" alt="badminton Image" />
                </div>
                <div class="icon" onclick="showForm('ping-pong', this)" id="ping-pong">
                    <img src="../../../assets/images/icons-sport/ping-pong.png" alt="ping-pong Image" />
                </div>
            </div>

            <div id="sport-preview">
                <h2 id="preview-title">Sélectionnez un sport pour le prévisualiser</h2>
                <img id="sport-image-preview" src="" alt="Aperçu du sport sélectionné" />
            </div>

            <div id="form-container">
                <form class="event-form" action="/?page=struture&form=modifForm" method="POST">
                    <label for="sport">Sport sélectionné :</label>
                    <input type="text" id="selected-sport" name="sport" aria-label="textAutoChange" readonly>
                    <label for="date">Sélectionnez une date :</label>
                    <input type="date" id="date" name="date">

                    <button class="btnVoirResa" type="submit"><span>Voir les terrains disponibles :</span><i></i></button>
                </form>
            </div>
        </div>
        <div class="Reservation">
            <div class="card">
                <?php if ($selected_sport && $selected_date): ?>
                    <h2><?php echo htmlspecialchars($selected_sport); ?></h2>
                    <p><?php echo htmlspecialchars($selected_date); ?></p>

                    <?php if (!empty($request_res)): ?>
                        <!-- Affichage des créneaux horaires -->
                        <?php foreach ($request_res as $row): ?>
                            <div class="time-slot"><?php echo htmlspecialchars($row["heure"]); ?>:00 H</div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <!-- Message si aucun créneau n'est disponible -->
                        <p>Aucun Crenaux de <?php echo htmlspecialchars($selected_sport); ?> disponible pour ce jour.</p>
                    <?php endif; ?>

                <?php else: ?>
                    <p>Aucun sport ou date sélectionné.</p>
                <?php endif; ?>
            </div>
        </div>
        <?php include 'footer.php' ?>
        <script type="text/javascript" src="../../../assets/scripts/reservation.js"></script>
        <?php
        (new \Blog\Views\Layout('Le meilleur blog', ob_get_clean()))->afficher();
    }
}
?>