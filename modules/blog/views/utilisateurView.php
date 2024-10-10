<?php
namespace blog\views;
use index;
use navebar;
require_once "navebar.php";
//require_once "../../../index.php";

class utilisateurView
{
    public function __construct(){

    }

    public function afficher()
    {
        $navebar = new navebar();
        echo '<!DOCTYPE html>
<html lang="fr">    
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/GestionSalleDeSportSae/assets/styles/reservation.css">
    <link rel="stylesheet" href="/GestionSalleDeSportSae/assets/styles/footer.css">
    <link rel="stylesheet" href="/GestionSalleDeSportSae/assets/styles/styles.css">
    <link rel="stylesheet" href="/GestionSalleDeSportSae/assets/styles/navbar.css">
    <link rel="stylesheet" href="/GestionSalleDeSportSae/assets/styles/login.css"> 
    <title>Réservation de Terrain</title>
</head>
<body>
    <header>
        ' . $navebar->afficher() .
        '
    </header>
    <div class="login-page">
        <img src="/GestionSalleDeSportSae/assets/images/istockphoto-500284607-612x612.jpg" alt="login_img">
        <div class="login-container">
            <h2>Connexion</h2>
            <form method="POST" action="#" class="login-form">
                <div class="input-group">
                    <label for="email">Adresse email</label>
                    <input type="email" id="email" name="mail" required>
                </div>
                <div class="input-group">
                    <label for="password">Mot de passe</label>
                    <input type="password" id="password" name="mdp" required>
                </div>
                <button type="submit" name="inscription" id="inscription" class="login-btn">Se connecter</button>
            </form>
        </div>
    </div>
</body>
</html>';
    }
}
