    const form = document.getElementById('compte-info');


const inputChangement = document.getElementById('changement');



inputChangement.addEventListener('click', function() {
    form.action = 'changementMdp'; // Action pour la connexion
});
