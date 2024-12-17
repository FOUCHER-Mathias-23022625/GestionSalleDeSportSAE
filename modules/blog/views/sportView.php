<?php

namespace blog\views;
use navebar;
use index;
require_once 'navebar.php';
require_once 'Layout.php';

class sportView {

    public function afficher(){

        ob_start();
        ?>
        <main class="sport-page">
            <h1 id="sports">Nos Sports</h1>
            <section class="sport-section">
                <div class="image-sport-basketball" class title="Basketball">
                    <img src="/GestionSalleDeSportSAE/assets/images/basket-sport.jpg" alt="Image Sport basketball">
                </div>
                <div class="image-sport-futsal" class title="Futsal">
                    <img src="/GestionSalleDeSportSAE/assets/images/futsal-sport.jpg" alt="Image Sport futsal">
                </div>
                <div class="image-sport-tennis" class title="Tennis">
                    <img src="/GestionSalleDeSportSAE/assets/images/tennis-sport.jpg" alt="Image 3">
                </div>
                <div class="image-sport-volley" class title="Volleyball">
                    <img src="/GestionSalleDeSportSAE/assets/images/volley-sport.jpg" alt="Image 4">
                </div>
                <div class="image-sport-pingpong" class title="Ping-Pong">
                    <img src="/GestionSalleDeSportSAE/assets/images/pingpong-sport.jpg" alt="Image 6">
                </div>
                <div class="image-sport-badminton" class title="Badminton">
                    <img src="/GestionSalleDeSportSAE/assets/images/badminton-sport.jpg" alt="Image 5">
                </div>
            </section>
            <section class="inscription_footer">
                <div class="txt_inscription">
                    <p>Envie de vous surpasser ou simplement de vous remettre en forme ?</p>
                    <p>Rejoignez-nous dès maintenant en vous inscrivant !</p>
                </div>
                <div class="arrow">
                    <img id="arrow" src="/GestionSalleDeSportSAE/assets/images/arrow-removebg-preview.png">
                </div>
                <div class="form_inscription">
                    <input type="text" placeholder="Votre adresse mail">
                    <button class="btnInscription">Recevoir la newsletter</button>
                </div>
            </section>
        </main>
        <?php
        (new \Blog\Views\Layout('Sports', ob_get_clean()))->afficher();

    }
}

?>