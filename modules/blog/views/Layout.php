<?php
namespace blog\views;
use controllers\reservationTerrainController;use footer;use navebar;
require_once "navebar.php";
require_once "footer.php";
class Layout { // PSR-12: opening brace next line
    public function __construct(private string $title, private string $content) {}
    public function afficher(): void {?>
        <!DOCTYPE html>
            <html lang="fr">
                <head>
                    <meta charset="UTF-8">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    <link rel="stylesheet" href="/GestionSalleDeSportSAE/assets/styles/footer.css">
                    <link rel="stylesheet" href="/GestionSalleDeSportSAE/assets/styles/styles.css">
                    <link rel="stylesheet" href="/GestionSalleDeSportSAE/assets/styles/navbar.css">
                    <link rel="stylesheet" href="/GestionSalleDeSportSAE/assets/styles/compte.css">
                    <link rel="stylesheet" href="/GestionSalleDeSportSAE/assets/styles/reservation.css">
                    <link rel="stylesheet" href="/GestionSalleDeSportSAE/assets/styles/reservationUtilisateur.css">
                    <link rel="stylesheet" href="/GestionSalleDeSportSAE/assets/styles/homepage.css">
                    <link rel="stylesheet" href="/GestionSalleDeSportSAE/assets/styles/evenement.css">
                    <link rel="stylesheet" href="/GestionSalleDeSportSAE/assets/styles/performance.css">
                    <link rel="stylesheet" href="/GestionSalleDeSportSAE/assets/styles/interfaceAdmin.css">
                    <link rel="stylesheet" href="/GestionSalleDeSportSAE/assets/styles/boostrap/boostrap.css">
                    <link rel="stylesheet" href="/GestionSalleDeSportSAE/assets/styles/abonnement.css">
                    <link rel="icon" href="/GestionSalleDeSportSAE/assets/images/logo-ico.ico" type="image/x-icon">
                    <title><?= $this->title; ?></title>
                </head>
                <body>
                    <?php $navebar = new navebar();
                    $navebar->afficher();?>
                    <?= $this->content; ?>
                    <script type="text/javascript" src="/GestionSalleDeSportSAE/assets/scripts/nav.js"></script>
                    <?php $footer = new footer();
                    $footer->afficher();?>
                </body>
            </html>
<?php
    }
} ?>