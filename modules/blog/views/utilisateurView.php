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
        <div class="login-container">
            <h2>Connexion</h2>
            <form method="POST" action="connexion" class="login-form">
                <div class="input-group">
                    <label for="email">Adresse email</label>
                    <input type="email" id="email" name="mail" required>
                </div>
                <div class="input-group">
                    <label for="password">Mot de passe</label>
                    <input type="password" id="password" name="mdp" required>
                </div>
                <button type="submit" name="inscription" id="inscription" class="login-btn">Se connecter</button>
            </form> <?php echo $message?>
        </div>
        <?php include 'footer.php';

}

}
?>

