    const form = document.getElementById('form-mdp');


const inputChangement = document.getElementById('changement');
const inputOublie = document.getElementById('oublieMdp');


inputChangement.addEventListener('click', function() {
    form.action = 'changementMdp'; // Action pour la connexion
});

inputOublie.addEventListener('click', function() {
    form.action = 'oublieMdp'; // Action pour l'inscription
});