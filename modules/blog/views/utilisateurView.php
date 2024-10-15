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

    public function afficher($message='')
    {
  ?>

        <link rel="stylesheet" href="/GestionSalleDeSportSae/assets/styles/login.css">


        <div class="login-container">
            <div class="connexion_box">
                <h2>Connectez-vous à votre espace</h2>
                <form method="POST" action="" id="login-form" class="login-form">
                    <label for="email">Adresse email</label>
                    <div class="input-group">
                        <input type="email" id="email" name="mail"  placeholder="Mon email" required>
                    </div>
                    <label for="password">Mot de passe</label>
                    <div class="input-group">
                        <input type="password" id="password" name="mdp"  placeholder="Mon mot de passe" required>
                    </div>
                    <button type="submit" name="btn-connexion" id="btn-connexion" class="login-btn">Se connecter</button>
                    <button type="submit" name="btn-inscription" id="btn-inscription" class="create-btn">Créer un compte</button>
                </form> <?php echo $message?>
            </div>
        </div>
        <script src="/GestionSalleDeSportSae/assets/scripts/utilisateur.js"></script>
        <?php include 'footer.php';
}

}
?>

