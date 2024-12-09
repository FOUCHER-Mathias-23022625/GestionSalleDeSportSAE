<?php
namespace blog\views;
use controllers\compteController;
use navebar;
use index;
require_once 'navebar.php';
require_once 'Layout.php';
require_once  "modules/blog/controllers/compteController.php";

class compteView{

    public function afficher($resultat,$resultat2){
        ob_start();
        ?>
<div class="login-container">
    <form action="maj" method="POST" class="connexion_box" enctype="multipart/form-data">
        <h2 class="form-title">Compte</h2>
            <label>Photo de profil</label><br>
        <div class="input-group">
            <input type="file" id="image" name="image" ><br><br>
        </div>


            <label for="NomU" class="form-label">Nom:</label><br>
        <div class="input-group">
            <input type="text" id="NomU"  name="NomCompte" value="<?php echo $resultat['NomU']; ?>" required><br><br>
        </div>
            <label for="PrenomU" class="form-label">Prénom:</label><br>
        <div class="input-group">
            <input type="text" id="PrenomU"  name="PrenomCompte" value="<?php echo $resultat['PrenomU']; ?>" required><br><br>
        </div>

            <label for="Email" class="form-label">E-mail:</label><br>
        <div class="input-group">
            <input type="email" id="Email"  name="EmailCompte" value="<?php echo $resultat['EMail']; ?>" required><br><br>
        </div>

            <label for="DateDeb" class="form-label">Date de début d'abonnement:</label>
            <label class="form-static"> <?php echo $resultat2['DateDeb']; ?> </label><br><br>

            <label for="DateExp" class="form-label">Date de fin d'abonnement :</label>
            <label class="form-static"> <?php echo $resultat2['DateExp']; ?> </label><br><br>

            <input type="submit" id="maj_btn" class="form-submit" value="Mettre à jour">
        </form>
</div>


        <form action="changementMdp" method="POST" id="form-mdp" class="changementMdp">
            <label>Changement de vôtre mot de passe</label>
            <input id="ancienMdp" name="ancienMdp"  placeholder="Ancien mot de passe"><br>
            <input id="nouveauMdp" name="nouveauMdp" placeholder="Nouveau mot de passe"><br>
            <input type="submit" class="inputSub" id="changement" name="changement" value="Changer le mot de passe" required><br>
            <input type="submit" class="inputSub" id="oublieMdp" name="oublieMdp" value="Mot de passe oublié ?" required><br>
        </form>
        <script src="/GestionSalleDeSportSAE/assets/scripts/compte.js"></script>
        <?php
        (new \Blog\Views\Layout('compte', ob_get_clean()))->afficher();
    }
}

?>
