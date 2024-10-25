<?php
namespace blog\views;
use navebar;
use index;
require_once 'navebar.php';
require_once 'Layout.php';

class homepageView{


    public function afficher(){

        ob_start();

        $isUserConnected = isset($_SESSION['user_id']);

        ?>
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

        <section class="activites-section">
            <h1 id="activites">MUSCULATION ET ACTIVITÉS SPORTIVES</h1>
            <div class="activites-bienfaits">
                <div class="txt-bienfaits">
                    <h2>Nos activités</h2>
                    <p id="bienfaits-txt">Les activités sportives offrent de nombreux bienfaits, tant pour le corps que pour l’esprit.
                        Physiquement, elles permettent de renforcer le système cardiovasculaire, améliorent la souplesse, l’endurance et la force musculaire, et aident à maintenir un poids santé.
                        Sur le plan mental, le sport libère des endorphines, les hormones du bien-être, qui réduisent le stress, l'anxiété et améliorent l’humeur.
                        Outre la santé, les motivations qui nous poussent à s’inscrire dans un club de sport sont multiples et peuvent évoluer au fur et à mesure de notre implication dans les programmes d’entrainement : remise en forme, prise de masse, perte de poids, endurance, rééducation…
                    </p>
                </div>
                <img src="/GestionSalleDeSportSAE/assets/images/salledesport-img.jpg" alt="bienfaits-img" class="bienfaits-img"/>
            </div>
            <div class="activites-amenagements">
                <img src="/GestionSalleDeSportSAE/assets/images/amenagements-img.jpg" alt="amenagement-img" class="amenagement-img"/>
                <div class="txt-amenagements">
                    <h2>Nos aménagements</h2>
                    <p id="amenagement-txt">Dans notre salle de sport, vous trouverez des installations haut de gamme et les meilleurs équipements du marché et avec une grande diversité de sport : Futsal, Basketball, Tennis, Badminton et un tas d'autres !
                        Nos installations sont adaptées pour que tu atteignes tes objectifs.
                        Que tu sois débutant ou expert, notre équipe est là pour te guider et te motiver tout au long de ton parcours sportif.
                        Nous proposons également des séances de coaching personnalisées pour t'accompagner dans ta progression et maximiser tes résultats.
                        C’est pourquoi ce complexe est équipé de matériel de qualité dernière génération pour te permettre de te surpasser à chaque séance.</p>
                </div>
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
                <button class="btnInscription">Je m'inscris</button>
            </div>
        </section>
        <script src="/GestionSalleDeSportSAE/assets/scripts/homepage.js"></script>

    </main>

    <?php
        (new \Blog\Views\Layout('SportHub', ob_get_clean()))->afficher();
 }
}
?>

