// Variables pour gérer le délai
let dropdownTimeout;

// Fonction pour montrer le menu
function showDropdown(dropdownMenu) {
    clearTimeout(dropdownTimeout);
    dropdownMenu.classList.add('show');
}

// Fonction pour cacher le menu avec un délai
function hideDropdown(dropdownMenu) {
    dropdownTimeout = setTimeout(() => {
        dropdownMenu.classList.remove('show');
    }, 200); // 200ms de délai
}

// Ajouter des écouteurs d'événements pour le survol
document.querySelectorAll('.dropdown').forEach(dropdown => {
    const toggle = dropdown.querySelector('.dropdown-toggle');
    const menu = dropdown.querySelector('.dropdown-menu');

    toggle.addEventListener('mouseenter', () => showDropdown(menu));
    menu.addEventListener('mouseenter', () => showDropdown(menu));

    toggle.addEventListener('mouseleave', () => hideDropdown(menu));
    menu.addEventListener('mouseleave', () => hideDropdown(menu));
});