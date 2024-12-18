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

        if (isset($_SESSION['alert'])) {
            echo "<script>alert('" . $_SESSION['alert'] . "');</script>";
            unset($_SESSION['alert']);
        }
        ?>
<div class="login-container">
    <form action="majData" method="POST" id="compte-info"class="connexion_box" enctype="multipart/form-data">
        <h2 class="form-title">Compte</h2>
            <label>Photo de profil</label><br>
        <div class="input-group">
            <input
                    type="file"
                    id="image"
                    name="image"
                    accept="image/png, image/jpeg, image/jpg"
            >
            <button type="submit" formaction="deletePP" formmethod="POST" id="supprPP" class="crayon">❌</button><br><br>
        </div>


            <label for="NomU" class="form-label">Nom:</label><br>
        <div class="input-group">
            <input type="text" id="NomU"  name="NomCompte" value="<?php echo $resultat['NomU']; ?>" disabled required>
            <button type="button" id="nomModif" class="crayon">✏️</button><br><br>
        </div>
            <label for="PrenomU" class="form-label">Prénom:</label><br>
        <div class="input-group">
            <input type="text" id="PrenomU"  name="PrenomCompte" value="<?php echo $resultat['PrenomU']; ?>" disabled required>
            <button type="button" id="prenomModif" class="crayon">✏️</button><br><br>
        </div>

            <label for="Email" class="form-label">E-mail:</label><br>
        <div class="input-group">
            <input type="email" id="Email"  name="EmailCompte" value="<?php echo $resultat['EMail']; ?>" disabled required>
            <button type="button" id="mailModif" class="crayon">✏️</button><br><br>
        </div>
        <!--validation-->
        <input type="submit" id="maj_btn" class="form-submit" value="Mettre à jour">
        <label>Changement de vôtre mot de passe</label>
        <div class="input-group">
            <input id="ancienMdp" type="password" name="ancienMdp"  placeholder="Ancien mot de passe"><br><br>
        </div>
        <div class="input-group">
            <input id="nouveauMdp" type="password" name="nouveauMdp" placeholder="Nouveau mot de passe"
                   pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d\S]{8,}$"
                   title="Le mot de passe doit contenir au moins 8 caractères, dont une majuscule, une minuscule et un chiffre."><br><br>
        </div>
        <input type="submit" class="inputSub" id="changement" name="changement" value="Changer le mot de passe" required><br><br>
            <label for="DateDeb" class="form-label">Date de début d'abonnement:</label>
            <label class="form-static"> <?php if($resultat2['DateDeb']!=null){
                echo $resultat2['DateDeb'];
                }
                else{
                    echo "Pas d'abonnement";
                }?> </label><br><br>

            <label for="DateExp" class="form-label">Date de fin d'abonnement :</label>
            <label class="form-static"> <?php if($resultat2['DateExp']!=null){
                    echo $resultat2['DateExp'];
                }
                else{
                    echo "Pas d'abonnement";
                }?> </label><br><br>
        </form>
</div>
        <script src="/GestionSalleDeSportSAE/assets/scripts/compte.js"></script>
        <?php
        (new \Blog\Views\Layout('compte', ob_get_clean()))->afficher();
    }
}

?>
