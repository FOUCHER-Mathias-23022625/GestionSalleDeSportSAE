<?php
namespace blog\views;
use controllers\abonnementController;
use navebar;
use index;
require_once 'navebar.php';
require_once 'Layout.php';
require_once  "modules/blog/controllers/abonnementController.php";

class abonnementView{

    public function afficher(){
        ob_start();
        ?>
        <main class="page-abonnement">
            <h1 class="h1-sub">Nos abonnements</h1>
            <section class="abonnements">
                <div class="offer-container">
                    <h3 class="offer-title">CLASSIQUE</h3>
                    <div class="offer-price">
                        <span class="main-price">20€</span>
                        <span class="price-duration">/mois</span>
                    </div>
                    <p class="adhesion-fees">Frais d’adhésion de 15€</p>
                    <ul class="offer-features">
                        <li><span class="icon">✓</span> Accès illimité à tous les terrains</li>
                        <li><span class="icon">✓</span> Accès aux évènements en solo</li>
                    </ul>
                    <button class="choose-offer-btn">JE CHOISIS CETTE OFFRE</button>
                </div>
                <div class="offer-container premium">
                    <h3 class="offer-title">PREMIUM</h3>
                    <div class="offer-price">
                        <span class="main-price">100€</span>
                        <span class="price-duration">/6 mois</span>
                    </div>
                    <p class="adhesion-fees">Frais d’adhésion de 15€</p>
                    <ul class="offer-features">
                        <li><span class="icon">✓</span>Accès illimité à tous les terrains</li>
                        <li><span class="icon">✓</span>Accès aux évènements en solo</li>
                        <li><span class="icon">✓</span>Possibilité d'inviter 1 personne à vos activités du weekend</li>
                        <li><span class="icon">✓</span>Avantage premium</li>
                    </ul>
                    <button class="choose-offer-btn">JE CHOISIS CETTE OFFRE</button>
                </div>
                <div class="offer-container">
                    <h3 class="offer-title">ELITE</h3>
                    <div class="offer-price">
                        <span class="main-price">200€</span>
                        <span class="price-duration">/an</span>
                    </div>
                    <p class="adhesion-fees">Frais d’adhésion de 15€</p>
                    <ul class="offer-features">
                        <li><span class="icon">✓</span>Accès illimité à tous les terrains</li>
                        <li><span class="icon">✓</span>Accès aux évènements en solo</li>
                        <li><span class="icon">✓</span>Possibilité d'inviter jusqu'à 2 personnes à vos activités</li>
                        <li><span class="icon">✓</span>Avantage premium</li>
                    </ul>
                    <button class="choose-offer-btn">JE CHOISIS CETTE OFFRE</button>
                </div>
            </section>
        </main>

        <?php
        (new \Blog\Views\Layout('abonnement', ob_get_clean()))->afficher();
    }
}

?>
