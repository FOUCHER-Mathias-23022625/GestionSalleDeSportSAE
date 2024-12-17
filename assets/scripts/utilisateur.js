document.getElementById('btn-inscription').addEventListener('click', function() {
    document.getElementById('registration-form').style.display = 'block';
    document.getElementById('login-form').style.display = 'none';
});

// Masquer le formulaire d'inscription et revenir au formulaire de connexion
document.getElementById('btn-cancel').addEventListener('click', function() {

    document.getElementById('registration-form').style.display = 'none';
    document.getElementById('login-form').style.display = 'block';
});


document.getElementById('btn-connexion').addEventListener('click', function() {
    document.getElementById('login-form').action = 'connexion';
});


document.getElementById('inscription').addEventListener('click', function() {
    document.getElementById('signup-form').action = 'verifMail';
});

document.getElementById('oublieMdp-btn').addEventListener('click', function() {
    document.getElementById('registration-form').style.display = 'none';
    document.getElementById('login-form').style.display = 'none';
    document.getElementById('oublie-mdp-form').style.display = 'block';
});

document.getElementById('btn-cancel2').addEventListener('click', function() {

    document.getElementById('registration-form').style.display = 'none';
    document.getElementById('login-form').style.display = 'block';
    document.getElementById('oublie-mdp-form').style.display = 'none';
});

function moveFocus(currentInput, nextIndex) {
    if (currentInput.value.length === 1) {
        const nextInput = currentInput.parentElement.children[nextIndex];
        if (nextInput) {
            nextInput.focus();
        }
    }
}

function closePopup() {
    alert("Vous n'avez pas fini l'inscription. Votre compte n'a donc pas été créé")
    document.getElementById('popupOverlay').style.display = 'none';
}

