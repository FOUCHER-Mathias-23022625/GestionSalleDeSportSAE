<?php

namespace blog\views;

class footer
{

    public function afficher(){ ?>
        <footer class="footerArea">
    <!-- Top Footer Area Start -->
            <div class="containerFooter">
                    <div class="titreFooter">
                        <h3>SportHub</h3>
                    </div>
                <div class="contactFooter">

                    <div class="leftandrightInfoFooter">
                        <div class="leftInfoFooter">
                            <h5>Téléphone :</h5>
                            <p>+33 4 39 45 18 14</p>
                        </div>
                        <div class="rightInfoFooter">
                            <h5>Email :</h5>
                            <p>sporthubcontact@gmail.com</p>
                        </div>
                    </div>
                </div>
                <div class="AProposFooter">
                    <h4>À propos de notre site</h4>
                    <div class="textAProposFooter">
                        <br>
                        <p>Bienvenue sur notre plateforme de gestion de salle de sports, votre solution tout-en-un pour la gestion
                            et la réservation de vos activités sportives.</p>
                        <p>Nous avons conçu ce service pour faciliter l'organisation, la planification et le suivi de vos séances dans
                            nos espaces de fitness, terrains et équipements de pointe.</p>
                        <p> Que vous soyez un coach, un athlète ou un amateur de sport, nous sommes là pour vous aider à atteindre vos objectifs de manière simple et efficace.</p>
                    </div>
                </div>
            </div>
            <div class="Copyrights">
                <p>© All Rights Reserved by <a href="#">SportHub</a></p>
            </div>
        </footer>

<?php
    }
}