document.getElementById('search').addEventListener('input', function () {
    const query = this.value.toLowerCase();
    const cards = document.querySelectorAll('.reservation-card');
    cards.forEach(card => {
        const text = card.textContent.toLowerCase();
        card.style.display = text.includes(query) ? 'block' : 'none';
    });
});

document.getElementById('filter').addEventListener('change', function () {
    const filterValue = this.value.toLowerCase();
    const cards = document.querySelectorAll('.reservation-card');
    cards.forEach(card => {
        const sport = card.querySelector('.reservation-info').textContent.toLowerCase();
        card.style.display = sport.includes(filterValue) ? 'block' : 'none';
    });
});

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