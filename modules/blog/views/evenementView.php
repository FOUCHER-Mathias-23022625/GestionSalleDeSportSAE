<?php
namespace blog\views;
use navebar;
use index;
require_once 'navebar.php';
require_once 'Layout.php';

class evenementView{

    public function __construct(){

    }

    public function afficher(){

        ob_start();
        ?>
    <main class="page-event">
        <h1 class="h1-event">Les évènements à venir</h1>
        <section class="event-test">
            <div class = "evenement">
                <img id="foot-event" src="/GestionSalleDeSportSAE/assets/images/istockphoto-1406854849-612x612.jpg">
                <div class="txt">
                    <h3>Tournoi de foot salle</h3>
                    <p>Vous souhaitez passer un bon moment avec d'autres adhérents avec à la clé 2 séances de sport gratuites ? Inscrivez-vous direct ! Il reste encore n places</p>
                    <button class="sinscrire">Je participe</button>
                </div>
            </div>
            <div class = "evenement">
                <img id="basket-event" src="/GestionSalleDeSportSAE/assets/images/basket-img.png">
                <div class="txt">
                    <h3>Tournoi de basketball</h3>
                    <p>Vous souhaitez passer un bon moment avec d'autres adhérents ? Inscrivez-vous direct !</p>
                    <button class="sinscrire">Je participe</button>
                </div>
            </div>
            <div class = "evenement">
                <img id="badminton-event" src="/GestionSalleDeSportSAE/assets/images/raquette-volant-de-badminton.jpg">
                <div class="txt">
                    <h3>Tournoi de badminton</h3>
                    <p>Vous souhaitez passer un bon moment avec d'autres adhérents ? Inscrivez-vous direct !</p>
                    <button class="sinscrire">Je participe</button>
                </div>
            </div>
            <div class="popup_inscription" id="popup_event">
                <span class="close" id="closePopup">&times;</span>
                <h3>Participer</h3>
                <form>
                    <div id="participantsList">
                        <div class="inputbox">
                            <input type="text" required="required" name="participantName[]">
                            <span>Nom</span>
                        </div>
                    </div>
                    <div class="inputbox">
                        <input type="button" value="Ajouter un participant" id="addParticipant">
                    </div>
                    <div class="inputbox">
                        <input id="submitButton" type="button" value="Valider">
                    </div>
                </form>
            </div>
        </section>
        <?php
        /*
        foreach ($evenements as $evenement) {
            ?>
            <div class="evenement">
                <img src="<?= $evenement['image'] ?>" alt="<?= $evenement['nom'] ?>">
                <div class="txt">
                    <h3><?= $evenement['nom'] ?></h3>
                    <p>Il reste encore <?= $evenement['placesRestantes'] ?> places</p>

                    <!-- Formulaire pour s'inscrire -->
                    <form method="POST" action="/inscription.php">
                        <input type="hidden" name="idEvenement" value="<?= $evenement['id'] ?>">
                        <button type="submit" class="sinscrire">Je participe</button>
                    </form>
                </div>
            </div>
            <?php
        }
        */
        ?>

        <div class="inscription_footer">
            <div class="txt_inscription">
                <p>Envie de vous surpasser ou simplement de vous remettre en forme ?</p>
                <p>Rejoignez-nous dès maintenant en vous inscrivant !</p>
            </div>
            <div class="arrow">
                <img id="arrow" src="/GestionSalleDeSportSAE/assets/images/arrow-removebg-preview.png">
            </div>
            <div class="form_inscription">
                <input type="text" placeholder="Votre adresse mail">
                <button class="btnInscription">Je m\'inscris</button>
            </div>
        </div>
        <script src="/GestionSalleDeSportSAE/assets/scripts/evenement.js"></script>
    </main>

    <?php
        (new \Blog\Views\Layout('Évenement', ob_get_clean()))->afficher();
    }
}

?>
