const searchInput = document.getElementById('search');
const filterSelect = document.getElementById('filter');
const reservationCards = document.querySelectorAll('.future-reservations .reservation-card');

// Fonction de filtrage
function filterReservations() {
    const searchValue = searchInput.value.toLowerCase();
    const filterValue = filterSelect.value;

    // Parcourir les cartes de réservation
    reservationCards.forEach(card => {
        const sport = card.querySelector('.reservation-info div:nth-child(1)').textContent.toLowerCase();
        const date = card.querySelector('.reservation-info div:nth-child(2)').textContent.toLowerCase();

        // Vérifier si la carte correspond à la recherche et au filtre
        const matchesSearch = sport.includes(searchValue) || date.includes(searchValue);
        const matchesFilter = !filterValue || sport.includes(filterValue.toLowerCase());

        // Afficher ou masquer la carte
        if (matchesSearch && matchesFilter) {
            card.style.display = '';
        } else {
            card.style.display = 'none';
        }
    });
}

// Ajouter des écouteurs d'événements pour le champ de recherche et le filtre
searchInput.addEventListener('input', filterReservations);
filterSelect.addEventListener('change', filterReservations);

function openModaldeleteUtilisateur(sport, time, date) {
    document.getElementById("selectedSport").innerText = sport;
    document.getElementById("inputSelectedSport").value = sport;
    document.getElementById("selectedTime").innerText = time;
    document.getElementById("inputSelectedTime").value = time;
    document.getElementById("selectedDate").innerText = date;
    document.getElementById("inputSelectedDate").value = date;
    document.getElementById('modal-delete-utilisateur').style.display = 'block';
    // Ajout de la classe "modal-open" pour flouter la page
    document.body.classList.add('modal-open');

    // Affichage de l'overlay et du modal
    document.querySelector('.modal-overlay').style.display = 'block';
}

function closeModalDelete(){
    document.getElementById('modal-delete-utilisateur').style.display = 'none';
    document.body.classList.remove('modal-open');
    document.querySelector('.modal-overlay').style.display = 'none';
}