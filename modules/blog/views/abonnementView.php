<?php
namespace blog\views;
use controllers\abonnementController;
use navebar;
use index;
require_once 'navebar.php';
require_once 'Layout.php';
require_once  "modules/blog/controllers/abonnementController.php";

class abonnementView{

    public function afficher($resultat,$resultat2){
        ob_start();
        ?>
        <main class="page-abonnement">
            <h1 class="h1-sub">Nos abonnements</h1>

            <div class="offer-container">
                <h3 class="offer-title">CLASSIC</h3>
                <div class="offer-price">
                    <span class="main-price">20€</span>
                    <span class="price-duration">/mois</span>
                </div>
                <p class="promo-price">Les 4 premières semaines à <span class="promo-highlight">19€</span></p>
                <p class="adhesion-fees">Frais d’adhésion de 15€</p>
                <ul class="offer-features">
                    <li>Accès illimité à tous les terrains</li>
                    <li>Accès aux évènements en solo</li>
                </ul>
                <button class="choose-offer-btn">JE CHOISIS CETTE OFFRE</button>
            </div>

        </main>

        <?php
        (new \Blog\Views\Layout('abonnement', ob_get_clean()))->afficher();
    }
}

?>
