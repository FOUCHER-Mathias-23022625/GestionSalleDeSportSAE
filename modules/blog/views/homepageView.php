<?php
namespace blog\views;
use navebar;
use index;
require_once 'navebar.php';

class homepageView{

    public function __construct(){

    }

    public function afficher(){

        $navebar = new naveBar();
        echo '
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Salle de sport</title>
  <link rel="stylesheet" href="/GestionSalleDeSportSAE/assets/styles/homepage.css"/>
  <link rel="stylesheet" href="/GestionSalleDeSportSAE/assets/styles/footer.css"/>
  <link rel="stylesheet" href="/GestionSalleDeSportSAE/assets/styles/navbar.css"/>
  <link rel="stylesheet" href="/GestionSalleDeSportSae/assets/styles/styles.css">
</head>
<body>
    <header>
        ' . $navebar->afficher() .'
    </header>
        
</body>

</html>';
    }
}


