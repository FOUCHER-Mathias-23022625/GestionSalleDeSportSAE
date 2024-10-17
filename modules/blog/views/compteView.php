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
        <!DOCTYPE html>
        <html lang="fr">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Compte</title>
        </head>
        <body>
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

            <label for="mdp" class="form-label">Mot de passe:</label><br>
            <input type="password" id="mdp" class="form-input" name="MdpCompte" value="<?php echo $resultat['mdp']; ?>" required><br><br>

            <label for="DateDeb" class="form-label">Date de début d'abonnement:</label>
            <label class="form-static"> <?php echo $resultat2['DateDeb']; ?> </label><br><br>

            <label for="DateExp" class="form-label">Date de fin d'abonnement :</label>
            <label class="form-static"> <?php echo $resultat2['DateExp']; ?> </label><br><br>

            <input type="submit" class="form-submit" value="Mettre à jour">
        </form>
        </body>
        </html>
            <?php
            (new \Blog\Views\Layout('compte', ob_get_clean()))->afficher();
        }
    }

?>
