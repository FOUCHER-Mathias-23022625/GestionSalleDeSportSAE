<?php
namespace blog\views;
use blog\models\evenementModel;use navebar;
use index;
require_once 'navebar.php';
require_once 'Layout.php';

class evenementView{

    public function __construct(){

    }

    public function afficher(){

        ob_start();

        $evenementModel = new evenementModel();
        $evenements = $evenementModel->getEvenements();

        ?>
    <main class="page-event">
        <h1 class="h1-event">Les évènements à venir</h1>

        <?php foreach ($evenements as $evenement) : ?>
                    <div class="evenement">
                        <?php
                        switch ($evenement['NomSport']) {
                            case 'futsal':
                                $image = '/GestionSalleDeSportSAE/assets/images/istockphoto-1406854849-612x612.jpg';
                                break;
                            case 'basketball':
                                $image = '/GestionSalleDeSportSAE/assets/images/basket-img.png';
                                break;
                            case 'badminton':
                                $image = '/GestionSalleDeSportSAE/assets/images/raquette-volant-de-badminton.jpg';
                                break;
                            default:
                                $image = '/GestionSalleDeSportSAE/assets/images/logo-img.png';
                                break;
                        }
                        ?>
                        <img  id="event-img" src="<?= $image ?>" alt="<?= $evenement['NomEven'] ?>">
                        <div class="txt">
                            <h3><?= $evenement['NomEven'] ?></h3>
                            <?php
                            switch ($evenement['NomSport']) {
                            case 'futsal':
                                $description = "Le Tournoi de Futsal est l'événement sportif idéal pour les amateurs de football rapide et intense. Le futsal, une version en salle du football, se joue à cinq contre cinq sur un terrain plus petit. Que vous soyez débutant ou expert, ce tournoi est l'occasion parfaite de partager des moments de convivialité, et de montrer vos talents. Formez votre équipe et inscrivez-vous dès maintenant pour vivre une expérience inoubliable sur le terrain !";
                                break;
                            case 'basketball':
                                $description = "Rejoignez notre Tournoi de Basketball et vivez l'excitation du jeu sur le terrain ! En équipe de 5, montrez vos compétences dans des matchs intenses où chaque point compte. Que vous soyez un passionné du basket ou simplement à la recherche d'un défi sportif, ce tournoi est une occasion idéale de partager l'adrénaline du jeu avec vos amis. Ne manquez pas cette opportunité de montrer votre talent, inscrivez-vous maintenant !";
                                break;
                            case 'badminton':
                                $description = "Envie de mêler rapidité et précision ? Participez à notre Tournoi de Badminton, un sport à la fois technique et dynamique ! En simple ou en double, affrontez vos adversaires dans des matchs rapides où chaque échange est crucial. Ce tournoi est l'occasion parfaite pour tester vos réflexes, affiner votre stratégie, et partager un moment fun avec d'autres passionnés. Inscrivez-vous sans attendre et venez montrer vos meilleures smashes sur le court !";
                                break;
                            default:
                                $description = "Préparez-vous à vivre une journée d’action et de défis lors de notre Événement Sportif Multi-Discipline ! Si vous êtes à la recherche de nouvelles expériences sportives, cet événement vous offre une occasion unique de vous dépasser et de rencontrer d'autres passionnés. Avec plusieurs tournois, activités et défis sportifs, il y a quelque chose pour tout le monde, quel que soit votre niveau. Formez votre équipe, venez seul, ou avec des amis. Inscrivez-vous maintenant et soyez de la partie !";
                                break;

                        }
                        ?>
                            <p><?= $description ?></p>
                            <p>Date: <?= $evenement['DateEven'] ?></p>
                            <button class="sinscrire">Je participe</button>
                        </div>
                    </div>
                <?php endforeach; ?>
        <div class="overlay_popup" id="overlay_popup">
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

        </div>
        <?php
        if (isset($_SESSION['id'])) {
        ?>

        <section class="add_event">
            <h3>Ajouter un évenement</h3>
            <form action="ajouteEven" method="POST">
               <div class="inputbox">
                    <input type="text" name="NomEven" required="required">
                   <span>Nom de l'événement</span>
            </div>

            <p>Date de l'événement</p>
            <div class="inputbox">
                <input type="date" name="DateEven" required="required">
            </div>
            <div class="inputbox">
                <input type="text" name="NomSport" required="required">
                <span>Nom du sport</span>
            </div>
            <div class="inputbox">
                <input type="submit" id="addEventButton" value="Ajouter l'événement">
            </div>
            </form>
        </section>
        <?php
        }
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
                <button class="btnInscription">Je m'inscris</button>
            </div>
        </div>
        <script src="/GestionSalleDeSportSAE/assets/scripts/evenement.js"></script>
    </main>

    <?php
        (new \Blog\Views\Layout('Évenement', ob_get_clean()))->afficher();
    }
}

?>
