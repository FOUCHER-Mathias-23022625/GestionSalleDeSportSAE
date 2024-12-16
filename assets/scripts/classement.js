
    // Fonction pour afficher les contenus des onglets
    function showTab(event, tabId) {
    // Cacher tous les contenus des onglets
    const tabContents = document.querySelectorAll('.tab-content');
    tabContents.forEach(content => content.classList.remove('active'));

    // Supprimer l'état actif des boutons
    const tabButtons = document.querySelectorAll('.tab-button');
    tabButtons.forEach(button => button.classList.remove('active'));

    // Afficher l'onglet sélectionné et activer le bouton correspondant
    document.getElementById(tabId).classList.add('active');
    event.currentTarget.classList.add('active');
}
