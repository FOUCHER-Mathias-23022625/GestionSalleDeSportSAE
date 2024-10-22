<?php
namespace blog\views;
use navebar;
use index;
require_once 'navebar.php';
require_once 'Layout.php';

    class compteView{

        public function afficher($resultat,$resultat2){
            ob_start();
            ?>
            <h2 class="form-title">Compte</h2>
            <form action="maj" method="POST" class="user-form">

                <div class="profile-picture-container">
                    <label for="profile-picture" class="profile-picture-label">
                        <input type="file" id="profile-picture" class="file-input" accept="image/*" onchange="loadImage(event)" />
                        <img id="profile-picture-preview" class="profile-picture" src="path/to/default/profile/picture.png" alt="Profile Picture" />
                    </label>
                </div>

                <label for="NomU" class="form-label">Nom:</label><br>
                <input type="text" id="NomU" class="form-input" name="NomCompte" value="<?php echo $resultat['NomU']; ?>" required><br><br>

                <label for="PrenomU" class="form-label">Prénom:</label><br>
                <input type="text" id="PrenomU" class="form-input" name="PrenomCompte" value="<?php echo $resultat['PrenomU']; ?>" required><br><br>

                <label for="Email" class="form-label">E-mail:</label><br>
                <input type="email" id="Email" class="form-input" name="EmailCompte" value="<?php echo $resultat['EMail']; ?>" required><br><br>

                <label for="DateDeb" class="form-label">Date de début d'abonnement:</label>
                <label class="form-static"> <?php echo $resultat2['DateDeb']; ?> </label><br><br>

                <label for="DateExp" class="form-label">Date de fin d'abonnement :</label>
                <label class="form-static"> <?php echo $resultat2['DateExp']; ?> </label><br><br>

                <input type="submit" class="form-submit" value="Mettre à jour">
            </form>
            <input type="submit" class="form-submit" value="Mettre à jour">
        </form>
        <form action="changementMdp" method="POST" id="form-mdp" class="changementMdp">
            <label>Changement de vôtre mot de passe</label>
            <input id="ancienMdp" name="ancienMdp"  placeholder="Ancien mot de passe"><br>
            <input id="nouveauMdp" name="nouveauMdp" placeholder="Nouveau mot de passe"><br>
            <input type="submit" class="inputSub" id="changement" name="changement" value="Changer le mot de passe" required><br>
            <input type="submit" class="inputSub" id="oublieMdp" name="oublieMdp" value="Mot de passe oublié ?" required><br>
        </form>
        </body>
        <script src="/GestionSalleDeSportSAE/assets/scripts/compte.js"></script>
        </html>
            <?php
            (new \Blog\Views\Layout('compte', ob_get_clean()))->afficher();
        }
    }

?>
