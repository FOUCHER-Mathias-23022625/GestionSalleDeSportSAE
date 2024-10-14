var previousElement = null; // Pour stocker l'élément sélectionné précédemment

function showForm(sport, element) {
    // Rendre le formulaire visible
    document.getElementById('form-container').style.display = 'block';

    // Si un élément précédent existe, remettre son image d'origine
    if (previousElement && previousElement !== element) {
        var previousSport = previousElement.id; // Obtenir l'ID du sport précédent
        var previousImage = previousElement.querySelector('img');
        previousImage.src = `../../../assets/images/icons-sport/${previousSport}.png`; // Remettre l'image d'origine
    }

    // Sélectionner l'image dans l'élément cliqué
    var imageElement = element.querySelector('img');
    var imagePath = `../../../assets/images/icons-sport/${sport}(1).png`;

    // Appliquer la transition pour changer d'image en douceur
    imageElement.style.opacity = 0; // D'abord on fait disparaître l'image en douceur
    setTimeout(function() {
        imageElement.src = imagePath; // On change le src une fois l'opacité à 0
        imageElement.onload = () => {
            imageElement.style.opacity = 1; // Puis on fait réapparaître l'image progressivement
        };
    }, 200); // Délai pour laisser la transition d'opacité se faire

    // Mettre à jour la valeur du sport sélectionné
    document.getElementById('selected-sport').value = sport.charAt(0).toUpperCase() + sport.slice(1);

    // Mettre à jour l'élément précédent pour la prochaine sélection
    previousElement = element;
}

function openModal(time) {
    document.getElementById("selectedTime").innerText = time;
    document.getElementById("inputSelectedTime").value = time;
    document.getElementById('reservationModal').style.display = 'block';
}

function closeModal() {
    document.getElementById('reservationModal').style.display = 'none';
}

function confirmReservation() {
    // Appel AJAX pour insérer la réservation
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "index.php?action=inserer_reservation", true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    // Envoyer la requête avec l'heure, la date et le sport
    xhr.send("time=" + selectedTime + "&date=" + selectedDate + "&sport=" + selectedSport);

    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            alert('Réservation confirmée avec succès!');
            closeModal(); // Fermer la modal après confirmation
            // Vous pouvez également mettre à jour l'interface utilisateur ici si nécessaire
        }
    };
}
