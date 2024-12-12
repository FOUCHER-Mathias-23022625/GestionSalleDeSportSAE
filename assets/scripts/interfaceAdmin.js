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

function closeEditBox() {
    // Masquer la boîte modale
    document.getElementById('edit-overlay').style.display = 'none';
}

function openEditForm(user) {
    // Préremplir les champs avec les données de l'utilisateur
    document.getElementById('edit-id').value = user.IdUtilisateur; // Champ caché pour l'ID
    document.getElementById('edit-nom').value = user.NomU;
    document.getElementById('edit-prenom').value = user.PrenomU;
    document.getElementById('edit-email').value = user.EMail;
    document.getElementById('edit-admin').value = user.admin;

    // Afficher la boîte modale
    document.getElementById('edit-overlay').style.display = 'flex';
}

function getID(id){
    return id;
}