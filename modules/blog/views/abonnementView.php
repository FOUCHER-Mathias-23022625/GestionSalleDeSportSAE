<?php
namespace blog\views;
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
            <div id="paymentModal" class="modal">
                <div class="modal-content">
                    <h3>Confirmer votre abonnement</h3>
                    <p>Vous avez choisi l'abonnement <span id="selectedOffer"></span>.</p>
                    <p>Montant : <span id="selectedPrice"></span></p>

                    <form id="paymentForm">
                        <input type="text" id="cardNumber" placeholder="Numéro de carte bancaire" required>
                        <input type="text" id="cardHolder" placeholder="Nom du titulaire" required>
                        <input type="text" id="expiryDate" placeholder="Date d'expiration (MM/AA)" required>
                        <input type="text" id="cvv" placeholder="CVV" required>
                    </form>

                    <button id="confirmPayment">Confirmer le paiement</button>
                    <button id="cancelPayment" class="cancel-payment-btn">Annuler</button>
                </div>
            </div>

            <script src="/GestionSalleDeSportSAE/assets/scripts/abonnement.js"></script>

        </main>

        <?php
        (new \Blog\Views\Layout('abonnement', ob_get_clean()))->afficher();
    }
}

?>
