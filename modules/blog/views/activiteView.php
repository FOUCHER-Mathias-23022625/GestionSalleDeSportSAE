<?php

namespace blog\views;

use navebar;
use Index;

require_once 'navebar.php';
require_once 'Layout.php';
require_once  "modules/blog/controllers/activiteController.php";

class activiteView
{
    public function afficher(){
        ob_start();
        ?>
        <main class="activite-page">
            <section class="activites-section">
                <h1 id="activites">MUSCULATION ET ACTIVITÉS SPORTIVES</h1>
                <div class="activites-bienfaits">
                    <div class="txt-bienfaits">
                        <h2>Nos activités</h2>
                        <p id="bienfaits-txt">Les activités sportives offrent de nombreux bienfaits, tant pour le corps que pour l’esprit.
                            Physiquement, elles permettent de renforcer le système cardiovasculaire, améliorent la souplesse, l’endurance et la force musculaire, et aident à maintenir un poids santé.
                            Sur le plan mental, le sport libère des endorphines, les hormones du bien-être, qui réduisent le stress, l'anxiété et améliorent l’humeur.
                            Outre la santé, les motivations qui nous poussent à s’inscrire dans un club de sport sont multiples et peuvent évoluer au fur et à mesure de notre implication dans les programmes d’entrainement : remise en forme, prise de masse, perte de poids, endurance, rééducation…</p>
                    </div>
                    <img src="/GestionSalleDeSportSAE/assets/images/bienfaits-img.jpg" alt="bienfaits-img" class="bienfaits-img"/>
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

                <div class="evenements-sport-container">
                    <div class="evenements-section" style="background-image: url('/GestionSalleDeSportSAE/assets/images/evenement-bg.jpg');" onclick="window.location.href='/GestionSalleDeSportSAE/evenement/afficheEvenement';">
                        <h2>Événements</h2>
                        <p>Découvrez nos événements sportifs à venir ! Des tournois, des compétitions et des activités uniques sont organisés régulièrement pour mettre en avant l'esprit sportif de notre communauté.</p>
                    </div>

                    <div class="sport-section" style="background-image: url('/GestionSalleDeSportSAE/assets/images/sports-bg.jpg');" onclick="window.location.href='/GestionSalleDeSportSAE/sport/nosSports';">
                        <h2>Sport</h2>
                        <p>Visite notre page dédiée au sport pour découvrir tous les programmes et activités proposées dans notre salle. Que ce soit pour la musculation, les sports collectifs, ou les compétitions, tu trouveras tout ce qu'il faut pour atteindre tes objectifs sportifs !</p>
                    </div>
                </div>
            </section>
        </main>

        <?php
        (new \Blog\Views\Layout('Activités', ob_get_clean()))->afficher();
    }
}
