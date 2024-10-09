<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Salle de sport</title>
  <link rel="stylesheet" href="/GestionSalleDeSportSAE/assets/styles/evenement.css"/>
  <?php include 'naveBar.php'?>
</head>
<body>
<h1>Les évènements à venir</h1>
<div class = "evenement">
    <img id="foot" src="/GestionSalleDeSportSAE/assets/images/istockphoto-1406854849-612x612.jpg">
  <div class="txt">
    <h3>Tournoi de foot salle</h3>
      <p>Vous souhaitez passer un bon moment avec d'autres adhérents avec à la clé 2 séance de sport gratuite ? Inscrivez-vous direct ! Il reste encore n places</p>
    <button class="sinscrire">Je participe</button>
  </div>
</div>
<div class = "evenement">
  <img id="basket" src="/GestionSalleDeSportSAE/assets/images/22336935-basketball-contexte-illustration-ai-generatif-gratuit-photo.jpg">
  <div class="txt">
    <h3>Tournoi de basketball</h3>
    <p>Vous souhaitez passer un bon moment avec d'autres adhérents ? Inscrivez-vous direct !</p>
    <button class="sinscrire">Je participe</button>
  </div>
</div>
<div class = "evenement">
  <img id="badminton" src="/GestionSalleDeSportSAE/assets/images/raquette-volant-de-badminton.jpg">
  <div class="txt">
    <h3>Tournoi de badminton</h3>
    <p>Vous souhaitez passer un bon moment avec d'autres adhérents ? Inscrivez-vous direct !</p>
    <button class="sinscrire">Je participe</button>
  </div>
</div>
<div class="popup_inscription">
    <h3>Inscription</h3>
    <p>Entrez votre nom</p>
</div>
  <div class="inscription_footer">
    <div class="txt_inscription">
      <p>Envie de vous surpasser ou simplement de vous remettre en forme ?</p>
      <p>Rejoignez-nous dès maintenant en vous inscrivant !</p>
    </div>
    <div class="arrow">
      <img id="arrow" src="/GestionSalleDeSportSAE/assets/images/arrow-removebg-preview.png">
    </div>
    <div class="form_inscription">
      <input type="text" placeholder="Votre adresse mail">
        <button class="btnInscription">Je m'inscris</button>
    </div>
  </div>
    <?php include 'footer.php'?>

</body>

</html>