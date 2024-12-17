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
        // Affichage du message d'erreur, s'il existe
        if (isset($_SESSION['error_message'])) {
            echo '<div class="error-messagePerf">' . $_SESSION['error_message'] . '</div>';
            unset($_SESSION['error_message']); // Supprimer le message après l'affichage
        }
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
                            <input type="password" id="new-password" name="mdp" placeholder="Mon mot de passe" required
                                   pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d\S]{8,}$"
                                   title="Le mot de passe doit contenir au moins 8 caractères, dont une majuscule, une minuscule et un chiffre.">

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
                <?php
                if (isset($_SESSION['mailUtilisateur'])) {
                    echo '
                        <form action="verifCode" method="post">
                            <!-- Overlay de la pop-up -->
                            <div class="popup-overlay" id="popupOverlay" style="display: flex">
                                <div class="popup">
                                    <h2>Vérifiez votre adresse e-mail</h2>
                                    <p>Entrez le code à 6 chiffres que nous avons envoyé à votre adresse e-mail.</p>
                                    <div class="input-container">
                                        <input type="text" name="code[]" maxlength="1" oninput="moveFocus(this, 1)">
                                        <input type="text" name="code[]" maxlength="1" oninput="moveFocus(this, 2)">
                                        <input type="text" name="code[]" maxlength="1" oninput="moveFocus(this, 3)">
                                        <input type="text" name="code[]" maxlength="1" oninput="moveFocus(this, 4)">
                                        <input type="text" name="code[]" maxlength="1" oninput="moveFocus(this, 5)">
                                        <input type="text" name="code[]" maxlength="1" oninput="moveFocus(this, 6)">
                                    </div>
                                    <button class="verify-btn" type="submit">Vérifier l\'e-mail</button>
                                </div>
                            </div>
                        </form>';
                }
                ?>
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

