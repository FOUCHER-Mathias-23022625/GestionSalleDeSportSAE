function openConfirmationBox() {
    const confirmLink = document.getElementById('confirm-link');
    confirmLink.href = `/GestionSalleDeSportSAE/interfaceAdmin/deleteUser/${userId}`;

    // Afficher la boîte de confirmation
    document.getElementById('confirm-overlay').style.display = 'flex';
}

function closeConfirmationBox() {
    document.getElementById('confirm-overlay').style.display = 'none';
}

function getID(id){
    return id;
}