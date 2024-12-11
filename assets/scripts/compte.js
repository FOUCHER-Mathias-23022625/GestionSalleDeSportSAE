    const form = document.getElementById('compte-info');


const inputChangement = document.getElementById('changement');



inputChangement.addEventListener('click', function() {
    form.action = 'changementMdp'; // Action pour la connexion
});

const Prenom = document.getElementById('PrenomU');
const modifPrenom = document.getElementById('prenomModif');
modifPrenom.addEventListener('click', function() {
    Prenom.disabled = false; });// Action pour la connexion