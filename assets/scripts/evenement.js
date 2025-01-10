const buttons = document.querySelectorAll('.sinscrire');
const overlay = document.getElementById('overlay_popup');
const popup = document.getElementById('popup_event');
const closePopup = document.getElementById('closePopup');

function handleParticipationEvenementClick(isUserConnected) {
    if (!isUserConnected) {
        alert('Vous devez être connecté pour vous inscrire à un évenement.');
    }else {
        popup.classList.add('show');
        overlay.classList.add('show');
        document.body.style.overflow = 'hidden';
    }
}

function confirmSupprimerEven(id) {
    return confirm("Voulez-vous vraiment supprimer cet événement ?");
}


closePopup.addEventListener('click', function() {
    popup.classList.remove('show');
    overlay.classList.remove('show');
    document.body.style.overflow = 'auto';
});

window.addEventListener('click', function (event) {
    if (event.target == overlay) { // Vérifie si le clic est sur l'overlay
        popup.classList.remove('show');
        overlay.classList.remove('show');
        document.body.style.overflow = 'auto';
    }
});

document.getElementById('addParticipant').addEventListener('click', function() {
    const newParticipant = document.createElement('div');
    newParticipant.classList.add('inputbox');

    newParticipant.innerHTML = `
        <input type="text" required="required" name="participantName[]">
        <span>Email</span>
    `;

    document.getElementById('participantsList').appendChild(newParticipant);
});

