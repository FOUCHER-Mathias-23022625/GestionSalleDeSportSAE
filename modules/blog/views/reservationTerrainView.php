<?php

namespace blog\views;
use navebar;
require_once "navebar.php";
require_once "Layout.php";
class reservationTerrainView
{
    public function afficher()
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
                <form>
                    <label for="sport">Sport sélectionné :</label>
                    <input type="text" id="selected-sport" name="sport" aria-label="textAutoChange" readonly>

                    <label for="creneaux">Créneaux horaires disponibles :</label>
                    <select id="creneaux">
                        <option value="09:00-10:00">09:00 - 10:00</option>
                        <option value="10:00-11:00">10:00 - 11:00</option>
                        <option value="11:00-12:00">11:00 - 12:00</option>
                        <option value="13:00-14:00">13:00 - 14:00</option>
                        <option value="14:00-15:00">14:00 - 15:00</option>
                        <option value="15:00-16:00">15:00 - 16:00</option>
                    </select>

                    <button class="btnVoirResa" type="submit"><span>Voir les terrains disponibles :</span><i></i></button>
                </form>
            </div>
        </div>
    
            <?php include 'footer.php' ?>
            <script type="text/javascript" src="../../../assets/scripts/reservation.js"></script>
        <?php
        (new \Blog\Views\Layout('Le meilleur blog', ob_get_clean()))->afficher();
    }
}
?>