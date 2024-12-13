function openConfirmationBox(userId) {
    // Récupère l'élément <a> du bouton "Confirmer"
    const confirmLink = document.getElementById('confirm-link');

    // Met à jour dynamiquement l'attribut href avec l'ID utilisateur
    confirmLink.href = `/GestionSalleDeSportSAE/interfaceAdmin/deleteUser/${userId}`;

    // Affiche la boîte de confirmation
    document.getElementById('confirm-overlay').style.display = 'flex';
}

function openConfirmationBoxEvent(eventId) {
    // Récupère l'élément <a> du bouton "Confirmer"
    const confirmLink = document.getElementById('confirm-link');

    // Met à jour dynamiquement l'attribut href avec l'ID utilisateur
    confirmLink.href = `/GestionSalleDeSportSAE/interfaceAdmin/deleteEvent/${eventId}`;

    // Affiche la boîte de confirmation
    document.getElementById('confirm-overlay').style.display = 'flex';
}



function openConfirmationBoxReserv(sport, idUser, date, heure) {
    // Vérifie si les paramètres sont valides
    if (!sport || !idUser || !date || !heure) {
        console.error("Les paramètres sont manquants :", { sport, idUser, date, heure });
        return;
    }

    // Récupère l'élément <a> du bouton "Confirmer"
    const confirmLink = document.getElementById('confirm-link');

    // Met à jour dynamiquement l'attribut href avec les valeurs fournies
    confirmLink.href = `/GestionSalleDeSportSAE/interfaceAdmin/deleteReservation/${sport}/${idUser}/${date}/${heure}`;

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
    document.getElementById('edit-overlay-user').style.display = 'flex';
}

function openEditReservationBox(reservation) {
    // Remplir les champs du formulaire avec les données de la réservation
    document.getElementById("edit-sport").value = reservation.sport;
    document.getElementById("edit-user-id").value = reservation.user_id;
    document.getElementById("edit-date").value = reservation.date;
    document.getElementById("edit-heure").value = reservation.heure;
    document.getElementById("edit-terrain").value = reservation.terrain;

    // Afficher la boîte de modification
    document.getElementById("edit-overlay-resa").style.display = "flex";
}

function openEditEvenementBox(evenement) {
    // Remplir les champs du formulaire avec les données de l'événement
    document.getElementById("edit-evenement-id").value = evenement.IdEvenement;
    document.getElementById("edit-nom-even").value = evenement.NomEven;
    document.getElementById("edit-date-even").value = evenement.DateEven;
    document.getElementById("edit-nom-sport").value = evenement.NomSport;

    // Afficher la boîte de modification
    document.getElementById("edit-overlay-event").style.display = "flex";
}