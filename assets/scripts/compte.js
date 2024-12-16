const form = document.getElementById('compte-info');


const inputChangement = document.getElementById('changement');

const supprPP = document.getElementById('supprPP');
supprPP.addEventListener('click', function() {
    return confirm("Etes vous sur de vouloir supprimer votre photo de profil?")
});

inputChangement.addEventListener('click', function() {
    form.action = 'changementMdp'; // Action pour la connexion
});

const Prenom = document.getElementById('PrenomU');
const modifPrenom = document.getElementById('prenomModif');
modifPrenom.addEventListener('click', function() {
    Prenom.disabled = false; });// Action pour la connexion

const Nom = document.getElementById('NomU');
const modifNom = document.getElementById('nomModif');
modifNom.addEventListener('click', function() {
    Nom.disabled = false; });// Action pour la connexion

const Email = document.getElementById('Email');
const modifEmail = document.getElementById('mailModif');
modifEmail.addEventListener('click', function() {
    Email.disabled = false; });// Action pour la connexion

const inputInfo = document.getElementById('maj_btn')
inputInfo.addEventListener('click', function (){
    alert("Vos données ont bien été modifiées");
});