document.addEventListener('DOMContentLoaded', function () {
    // Objets de mapping entre champs de recherche et leurs tableaux respectifs
    const filters = [
        {
            inputId: 'search-utilisateurs',
            tableSelector: 'section:nth-of-type(1) table',
        },
        {
            inputId: 'search-reservations',
            tableSelector: 'section:nth-of-type(2) table',
        },
        {
            inputId: 'search-evenements',
            tableSelector: 'section:nth-of-type(3) table',
        }
    ];

    filters.forEach(filter => {
        const searchInput = document.getElementById(filter.inputId);
        const table = document.querySelector(filter.tableSelector);
        const rows = table.querySelectorAll('tr');

        // Fonction de filtrage pour le tableau
        searchInput.addEventListener('input', function () {
            const searchValue = searchInput.value.toLowerCase();

            rows.forEach((row, index) => {
                // Ignore la première ligne (l'en-tête)
                if (index === 0) return;

                const cells = row.querySelectorAll('td');
                if (cells.length > 0) {
                    // Vérifie si une des colonnes contient la valeur recherchée
                    const rowText = Array.from(cells).map(cell => cell.textContent.toLowerCase()).join(' ');
                    row.style.display = rowText.includes(searchValue) ? '' : 'none';
                }
            });
        });
    });
});

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



function openConfirmationBoxReserv(button) {
    // Récupérer les données à partir des attributs data-*
    const sport = button.getAttribute('data-sport');
    const userId = button.getAttribute('data-user-id');
    const date = button.getAttribute('data-date');
    const heure = button.getAttribute('data-heure');

    // Vérifie si les données sont valides
    if (!sport || !userId || !date || !heure) {
        console.error("Les paramètres sont manquants :", { sport, userId, date, heure });
        return;
    }

    // Récupère l'élément <a> du bouton "Confirmer"
    const confirmLink = document.getElementById('confirm-link');
    confirmLink.href = `/GestionSalleDeSportSAE/interfaceAdmin/deleteReservation/${sport}/${userId}/${date}/${heure}`;

    // Affiche la boîte de confirmation
    document.getElementById('confirm-overlay').style.display = 'flex';
}

function closeConfirmationBox() {
    document.getElementById('confirm-overlay').style.display = 'none';
}

function closeEditBoxUser() {
    // Masquer la boîte modale
    document.getElementById('edit-overlay-user').style.display = 'none';
}

function closeEditBoxResa() {
    // Masquer la boîte modale
    document.getElementById('edit-overlay-resa').style.display = 'none';
}
function closeEditBoxEvent() {
    // Masquer la boîte modale
    document.getElementById('edit-overlay-event').style.display = 'none';
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