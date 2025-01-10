<?php
namespace blog\views;
use navebar;
use Index;
//t
require_once 'navebar.php';
require_once 'Layout.php';

class sportView {

    public function afficher(){

        ob_start();
        ?>
        <main class="sport-page">
            <h1 id="sports">Nos Sports</h1>
            <section class="sports">
                <div class="image-sport-basketball" title="Basketball">
                    <img src="/GestionSalleDeSportSAE/assets/images/basket-sport.jpg" alt="Image Sport basketball">
                </div>
                <div class="image-sport-futsal" title="Futsal">
                    <img src="/GestionSalleDeSportSAE/assets/images/futsal-sport.jpg" alt="Image Sport futsal">
                </div>
                <div class="image-sport-tennis" title="Tennis">
                    <img src="/GestionSalleDeSportSAE/assets/images/tennis-sport.jpg" alt="Image 3">
                </div>
                <div class="image-sport-volley" title="Volleyball">
                    <img src="/GestionSalleDeSportSAE/assets/images/volley-sport.jpg" alt="Image 4">
                </div>
                <div class="image-sport-pingpong" title="Ping-Pong">
                    <img src="/GestionSalleDeSportSAE/assets/images/pingpong-sport.jpg" alt="Image 6">
                </div>
                <div class="image-sport-badminton" title="Badminton">
                    <img src="/GestionSalleDeSportSAE/assets/images/badminton-sport.jpg" alt="Image 5">
                </div>
            </section>
            <a type="button" href="../utilisateur/afficheFormConnexion" class="sport-btnInscription">Rejoignez-nous !</a>
        </main>
        <?php
        (new \Blog\Views\Layout('Sports', ob_get_clean()))->afficher();

    }
}

?>