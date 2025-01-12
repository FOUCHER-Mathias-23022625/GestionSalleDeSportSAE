<?php
namespace blog\views;
//t
use controllers\reservationTerrainController;use blog\views\footer;use navebar;
require_once "navebar.php";
require_once "modules/blog/views/footer.php";
class Layout { // PSR-12: opening brace next line
    private $title;
    private $content;

    public function __construct(string $title, string $content) {
        $this->content = $content;
        $this->title = $title;
    }
    public function afficher(): void {?>
        <!DOCTYPE html>
            <html lang="fr">
                <head>
                    <meta charset="UTF-8">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    <link rel="stylesheet" href="/GestionSalleDeSportSAE/assets/styles/footer.css">
                    <link rel="stylesheet" href="/GestionSalleDeSportSAE/assets/styles/styles.css">
                    <link rel="stylesheet" href="/GestionSalleDeSportSAE/assets/styles/compte.css">
                    <link rel="stylesheet" href="/GestionSalleDeSportSAE/assets/styles/reservation.css">
                    <link rel="stylesheet" href="/GestionSalleDeSportSAE/assets/styles/reservationUtilisateur.css">
                    <link rel="stylesheet" href="/GestionSalleDeSportSAE/assets/styles/homepage.css">
                    <link rel="stylesheet" href="/GestionSalleDeSportSAE/assets/styles/evenement.css">
                    <link rel="stylesheet" href="/GestionSalleDeSportSAE/assets/styles/performance.css">
                    <link rel="stylesheet" href="/GestionSalleDeSportSAE/assets/styles/interfaceAdmin.css">
                    <link rel="stylesheet" href="/GestionSalleDeSportSAE/assets/styles/navbar2.css">
                    <link rel="stylesheet" href="/GestionSalleDeSportSAE/assets/styles/abonnement.css">
                    <link rel="stylesheet" href="/GestionSalleDeSportSAE/assets/styles/activite.css">
                    <link rel="stylesheet" href="/GestionSalleDeSportSAE/assets/styles/classement.css">
                    <link rel="stylesheet" href="/GestionSalleDeSportSAE/assets/styles/sport.css">
                    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
                    <link rel="icon" href="/GestionSalleDeSportSAE/assets/images/logo-ico.ico" type="image/x-icon">
                    <title><?= $this->title; ?></title>
                </head>
                <body>
                    <?php $navebar = new navebar();
                    $navebar->afficher();?>
                    <?= $this->content; ?>
                    <script type="text/javascript" src="/GestionSalleDeSportSAE/assets/scripts/nav.js"></script>
                    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
                    <?php $footer = new footer();
                    $footer->afficher();?>
                </body>
            </html>
<?php
    }
} ?>