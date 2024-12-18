const form = document.getElementById('compte-info');

// Gestion de la suppression de photo de profil
const supprPP = document.getElementById('supprPP');
supprPP.addEventListener('click', function () {
    return confirm("Êtes-vous sûr de vouloir supprimer votre photo de profil ?");
});

// Gestion du changement de mot de passe
const inputChangement = document.getElementById('changement');
inputChangement.addEventListener('click', function () {
    form.action = 'changementMdp';
});

// Permettre la modification des champs désactivés
const Prenom = document.getElementById('PrenomU');
const modifPrenom = document.getElementById('prenomModif');
modifPrenom.addEventListener('click', function () {
    Prenom.disabled = false; // Activer le champ Prénom
});

const Nom = document.getElementById('NomU');
const modifNom = document.getElementById('nomModif');
modifNom.addEventListener('click', function () {
    Nom.disabled = false; // Activer le champ Nom
});

const Email = document.getElementById('Email');
const modifEmail = document.getElementById('mailModif');
modifEmail.addEventListener('click', function () {
    Email.disabled = false; // Activer le champ Email
});

// Gestion de la mise à jour des informations
const inputInfo = document.getElementById('maj_btn');
inputInfo.addEventListener('click', function () {
    alert("Vos données ont bien été modifiées");
});

// Empêcher la touche "Entrée" de soumettre le mauvais bouton
form.addEventListener('keydown', function (e) {
    if (e.key === 'Enter') {
        const activeElement = document.activeElement;

        // Vérifiez si l'élément actif est un champ de texte, email ou mot de passe
        if (activeElement.tagName === 'INPUT') {
            const isPasswordField = activeElement.id === 'ancienMdp' || activeElement.id === 'nouveauMdp';

            // Si on est dans un champ de mot de passe
            if (isPasswordField) {
                e.preventDefault(); // Empêche le comportement par défaut

                // Simule un clic sur le bouton de changement de mot de passe
                inputChangement.click();
            } else if (
                activeElement.type === 'text' ||
                activeElement.type === 'email'
            ) {
                e.preventDefault(); // Empêche le comportement par défaut

                // Simule un clic sur le bouton de mise à jour des informations
                inputInfo.click();
            }
        }
    }
});
