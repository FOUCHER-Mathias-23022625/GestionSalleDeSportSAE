<?php
namespace blog\views;
use navebar;
require_once "navebar.php";

class UtilisateurView
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
    <link rel="stylesheet" href="../../../assets/styles/reservation.css">
    <link rel="stylesheet" href="../../../assets/styles/footer.css">
    <link rel="stylesheet" href="../../../assets/styles/styles.css">
    <link rel="stylesheet" href="../../../assets/styles/navbar.css">
    <link rel="stylesheet" href="../../../assets/styles/login.css"> 
    <title>Réservation de Terrain</title>
</head>
<body>
    <header>
        ' . $navebar->afficher() . '
    </header>
    <main>
        <div class="login-container">
            <h2>Connexion</h2>
            <form action="login.php" method="POST" class="login-form">
                <div class="input-group">
                    <label for="email">Adresse email</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div class="input-group">
                    <label for="password">Mot de passe</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <button type="submit" class="login-btn">Se connecter</button>
            </form>
        </div>
    </main>
</body>
</html>';
    }
}