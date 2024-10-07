function showForm(sport) {
    document.getElementById('form-container').style.display = 'block';
    document.getElementById('selected-sport').value = sport.charAt(0).toUpperCase() + sport.slice(1);
}