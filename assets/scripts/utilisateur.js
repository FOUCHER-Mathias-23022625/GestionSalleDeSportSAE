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
    document.getElementById('signup-form').action = 'inscription';
});

