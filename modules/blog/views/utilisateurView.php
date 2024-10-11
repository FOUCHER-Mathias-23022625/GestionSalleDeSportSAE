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
        $navebar = new navebar();

        $navebar->afficher();
  ?>

        <link rel="stylesheet" href="/GestionSalleDeSportSae/assets/styles/login.css">

        <div class="login-container">
            <div class="connexion_box">
                <h2>Connectez-vous à votre espace</h2>
                <form method="POST" action="connexion" class="login-form">
                    <label for="email">Adresse email</label>
                    <div class="input-group">
                        <input type="email" id="email" name="mail"  placeholder="Mon email" required>
                    </div>
                    <label for="password">Mot de passe</label>
                    <div class="input-group">
                        <input type="password" id="password" name="mdp"  placeholder="Mon mot de passe" required>
                    </div>
                    <button type="submit" name="inscription" id="inscription" class="login-btn">Se connecter</button>
                    <button type="new_acc" name="creer-compte" id="creer-compte" class="create-btn">Créer un compte</button>
                </form> <?php echo $message?>
            </div>
        </div>
        <?php include 'footer.php';
}

}
?>

