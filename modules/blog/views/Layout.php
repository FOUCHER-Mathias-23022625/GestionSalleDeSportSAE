<?php
namespace blog\views;

class Layout { // PSR-12: opening brace next line
    public function __construct(private string $title, private string $content) {}
    public function afficher(): void { // PSR-12: opening brace next line
        ?><!DOCTYPE html>
            <html lang="fr">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <link rel="stylesheet" href="/GestionSalleDeSportSae/assets/styles/footer.css">
                <link rel="stylesheet" href="/GestionSalleDeSportSae/assets/styles/styles.css">
                <link rel="stylesheet" href="/GestionSalleDeSportSae/assets/styles/navbar.css">
                <link rel="stylesheet" href="/GestionSalleDeSportSae/assets/styles/reservation.css">

                <title><?= $this->title; ?></title>
            </head>
            <body>
            <?= $this->content; ?>
            </body>
            </html>
<?php
    }
} ?>