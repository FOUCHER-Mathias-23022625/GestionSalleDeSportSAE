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
        ?>

        <link rel="stylesheet" href="/GestionSalleDeSportSAE/assets/styles/login.css">


        <div class="login-container">
            <div class="connexion_box">

                <form method="POST" action="" id="login-form" class="login-form">
                    <h2>Connectez-vous à votre espace</h2>
                    <label for="email">Adresse email</label>
                    <div class="input-group">
                        <input type="email" id="email" name="mail" placeholder="Mon email" required>
                    </div>
                    <label for="password">Mot de passe</label>
                    <div class="input-group">
                        <input type="password" id="password" name="mdp" placeholder="Mon mot de passe" required>
                    </div>
                    <button type="submit" name="btn-connexion" id="btn-connexion" class="login-btn">Se connecter</button>
                    <button type="button" name="btn-inscription" id="btn-inscription" class="create-btn">Créer un compte</button>
                    <input type="button" class="login-btn" id="oublieMdp-btn" name="oublieMdp" value="Mot de passe oublié ?"><br>
                </form>

                <div id="registration-form"  style="display: none;">
                    <h2>Créer un compte</h2>
                    <form method="POST" action="" id="signup-form" class="signup-form">
                        <label for="new-email">Adresse email</label>
                        <div class="input-group">
                            <input type="email" id="new-email" name="mail" placeholder="Mon email" required>
                        </div>
                        <label for="new-password">Mot de passe</label>
                        <div class="input-group">
                            <input type="password" id="new-password" name="mdp" placeholder="Mon mot de passe" required>
                        </div>
                        <label>Prenom</label>
                        <div class="input-group">
                            <input type="text"  name="prenom" placeholder="Prenom" required>
                        </div>
                        <label>Nom</label>
                        <div class="input-group">
                            <input type="text"  name="nom" placeholder="Nom" required>
                        </div>
                        <button type="submit" name="btn-signup" id="inscription" class="login-btn">S'inscrire</button>
                        <button type="button" id="btn-cancel" class="create-btn">Annuler</button>
                    </form>
                </div>
                <div id="oublie-mdp-form" style="display: none">
                    <h2>Renseignez votre mail</h2>
                    <form method="POST" action="oublieMdp">
                        <div class="input-group">
                            <input type="text"  name="AncienMail" placeholder="Mail" required>
                        </div>
                        <button type="submit" id="ancienMail" class="login-btn">Valider</button>
                        <button type="button" id="btn-cancel2" class="create-btn">Annuler</button>
                    </form>
                </div>
            </div>
        </div>


        <script src="/GestionSalleDeSportSAE/assets/scripts/utilisateur.js"></script>
        <?php
    }

}
?>

