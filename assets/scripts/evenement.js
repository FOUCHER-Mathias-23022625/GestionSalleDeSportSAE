const buttons = document.querySelectorAll('.sinscrire');
const overlay = document.getElementById('overlay_popup');
const popup = document.getElementById('popup_event');
const closePopup = document.getElementById('closePopup');


buttons.forEach(button => {
    button.addEventListener('click', function() {
        const eventId = this.getAttribute('IdEven'); // Récupère l'ID de l'événement
        console.log('ID de l\'événement:', eventId); // Affiche l'ID dans la console (à remplacer par votre logique)


        if (!isUserConnected) {
            alert('Vous devez être connecté pour vous inscrire à un évenement.');
        } else {
            // Optionnel : Ajouter l'ID de l'événement dans un champ caché du formulaire pour l'envoyer au serveur
            const hiddenInput = document.createElement('input');
            hiddenInput.type = 'hidden';
            hiddenInput.name = 'eventId';
            hiddenInput.value = eventId;
            popup.querySelector('form').appendChild(hiddenInput);

            popup.classList.add('show');
            overlay.classList.add('show');
            document.body.style.overflow = 'hidden';
        }
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

