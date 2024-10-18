function handleReservationClick(isUserConnected) {
    if (!isUserConnected) {
        alert('Vous devez être connecté pour réserver un terrain.');
    } else {
        window.location.href = '../reservationTerrain/displayReservationTerrain';
    }
}
