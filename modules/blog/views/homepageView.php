<?php
namespace blog\views;
use navebar;
use index;
require_once 'navebar.php';
require_once 'Layout.php';

class homepageView{


    public function afficher(){

        ob_start();

        $isUserConnected = isset($_SESSION['id']);

        ?>
<?php
        if (isset($_SESSION['alert'])) {
        echo "<script>alert('" . $_SESSION['alert'] . "');</script>";
        // Supprimer l'alerte après l'affichage pour éviter qu'elle n'apparaisse à nouveau lors de la prochaine requête
        unset($_SESSION['alert']);
        }?>
    <main class="homepage">
        <section class="video-section">
            <img class="background-video" src="/GestionSalleDeSportSAE/assets/images/homeVideo.gif">
            <div class="content">
                <h1 id="jouer">JOUER</h1>
                <p>Pratique ton sport dès maintenant !</p>
                <div class="contacts">
                    <a href="#" class="button1" onclick="handleReservationClick(<?= json_encode($isUserConnected) ?>)">RÉSERVER</a>
                </div>
            </div>
        </section>

        <section class="event-section">
            <div class="event-text">
                <h2>Événements sportifs à ne pas manquer</h2>
                <p>Participez à nos compétitions dans une grande variété de sport. Réservez maintenant pour vivre une expérience sportive exceptionnelle !</p>
                <a href="../evenement/afficheEvenement" class="button-link">Voir les événements</a>
            </div>
            <img src="/GestionSalleDeSportSAE/assets/images/evenement.jpg" alt="evenement-img" class="event-img">
        </section>

        <section class="reservation-section">
            <img src="/GestionSalleDeSportSAE/assets/images/reservation.jpg" alt="reservation-img" class="reservation-img">
            <div class="reservation-text">
                <h2>Réservez votre terrain</h2>
                <p>Vous souhaitez organiser des matchs avec vos amis ? Nous vous offrons un grand nombre de terrains à disposition pour vos activités préférées. Réservez facilement un terrain en ligne !</p>
                <a href="../reservationTerrain/displayReservationTerrain" class="button-link">Réserver un terrain</a>
            </div>
        </section>

        <section class="performance-section">
            <div class="performance-text">
                <h2>Accéder à vos performances</h2>
                <p>Accédez à l'évolution de vos performances sportives. Consultez vos progrès, vos statistiques d'entraînement et vos records personnels. Notre outil de suivi vous permet d'analyser vos séances passées et de fixer de nouveaux objectifs pour vous surpasser.</p>
                    <a href="../performance/affichePerf" class="button-link">Voir vos performances</a>
            </div>
            <img src="/GestionSalleDeSportSAE/assets/images/performancee.jpg" alt="performance-img" class="performance-img">
        </section>

        <a href="../abonnement/afficheAbonnement" class="nostarifs-btn">Nos tarifs</a>

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
        <script src="/GestionSalleDeSportSAE/assets/scripts/homepage.js"></script>
    </main>

    <?php
        (new \Blog\Views\Layout('SportHub', ob_get_clean()))->afficher();
 }
}
?>

