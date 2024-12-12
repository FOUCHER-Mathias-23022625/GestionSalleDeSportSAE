function openConfirmationBox(userId) {
    // Récupère l'élément <a> du bouton "Confirmer"
    const confirmLink = document.getElementById('confirm-link');

    // Met à jour dynamiquement l'attribut href avec l'ID utilisateur
    confirmLink.href = `/GestionSalleDeSportSAE/interfaceAdmin/deleteUser/${userId}`;

    // Affiche la boîte de confirmation
    document.getElementById('confirm-overlay').style.display = 'flex';
}

function closeConfirmationBox() {
    document.getElementById('confirm-overlay').style.display = 'none';
}

function getID(id){
    return id;
}