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
     <section id="home">
        <h1>Bienvenue à Ma Salle de Sport</h1>
        <p>Découvrez nos activités : foot à 5, padel, et plus encore !</p>
        <button>Réserver un terrain</button>
    </section>

    <section id="services">
        <h2>Nos Services</h2>
        <div class="service">
            <h3>Foot à 5</h3>
            <p>Jouez sur nos terrains de qualité</p>
        </div>
        <div class="service">
            <h3>Padel</h3>
            <p>Testez nos terrains de padel pour un moment convivial</p>
        </div>
    </section>

    <section id="reservation">
        <h2>Réservation</h2>
        <form action="reservation.html" method="post">
            <label for="name">Nom :</label>
            <input type="text" id="name" name="name">
            <label for="date">Date :</label>
            <input type="date" id="date" name="date">
            <label for="sport">Sport :</label>
            <select id="sport" name="sport">
                <option value="foot">Foot à 5</option>
                <option value="padel">Padel</option>
            </select>
            <button type="submit">Réserver</button>
        </form>
    </section>

    <footer>
        <p>© 2024 Ma Salle de Sport - Tous droits réservés</p>
    </footer>   
</body>

</html>';
    }
}


