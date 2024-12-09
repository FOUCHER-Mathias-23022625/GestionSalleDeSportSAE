const buttons = document.querySelectorAll('.sinscrire');
const overlay = document.getElementById('overlay_popup');
const popup = document.getElementById('popup_event');
const closePopup = document.getElementById('closePopup');

function handleParticipationEvenementClick(isUserConnected) {
    if (!isUserConnected) {
        alert('Vous devez être connecté pour vous inscrire à un évenement.');
    } else {
        window.location.href = '../evenement/afficheEvenement';
    }
}

buttons.forEach(button => {
    button.addEventListener('click', function() {
        popup.classList.add('show');
        overlay.classList.add('show');
        document.body.style.overflow = 'hidden';
    });
});

closePopup.addEventListener('click', function() {
    popup.classList.remove('show');
    overlay.classList.remove('show');
    document.body.style.overflow = 'auto';
});

window.addEventListener('click', function(event) {
    if (event.target == popup) {
        popup.classList.remove('show');
    }
});

document.getElementById('addParticipant').addEventListener('click', function() {
    const newParticipant = document.createElement('div');
    newParticipant.classList.add('inputbox');

    newParticipant.innerHTML = `
        <input type="text" required="required" name="participantName[]">
        <span>Nom</span>
    `;

    document.getElementById('participantsList').appendChild(newParticipant);
});

