const buttons = document.querySelectorAll('.sinscrire');
const popup = document.getElementById('popup_event');
const closePopup = document.getElementById('closePopup');

buttons.forEach(button => {
    button.addEventListener('click', function() {
        popup.classList.add('show');
    });
});

closePopup.addEventListener('click', function() {
    popup.classList.remove('show');
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

