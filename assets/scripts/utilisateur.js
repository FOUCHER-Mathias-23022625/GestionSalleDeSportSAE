const form = document.getElementById('login-form');


const btnConnexion = document.getElementById('btn-connexion');
const btnInscription = document.getElementById('btn-inscription');


btnConnexion.addEventListener('click', function() {
    form.action = 'connexion'; // Action pour la connexion
});

btnInscription.addEventListener('click', function() {
    form.action = 'inscription'; // Action pour l'inscription
});