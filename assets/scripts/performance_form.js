//Formulaire ajouter performance
function formAjt() {
    document.getElementById("formOverlayAddPerf").style.display = "flex";
}

function closeForm() {
    document.getElementById("formOverlayAddPerf").style.display = "none";
}

//formulaire ajouter IMC
function formAjtImc() {
    document.getElementById("formOverlayAddImc").style.display = "flex";
}

function closeFormImc() {
    document.getElementById("formOverlayAddImc").style.display = "none";
}
function afficheHistorique() {
    var table = document.getElementById('historique-table');
    if (table.style.display === 'none') {
    table.style.display = 'table';
} else {
    table.style.display = 'none';
    }
}
