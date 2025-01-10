//Partie graphe
function initChart(canvasId, labels, datasetLabel, datasetData, yAxisLabel, borderColor, backgroundColor, reverse = false, addBands = false) {
    if (reverse) {
        labels = labels.slice().reverse();
        datasetData = datasetData.slice().reverse();
    }

    const ctx = document.getElementById(canvasId).getContext("2d");

    // Configuration de base des plugins
    const plugins = {
        legend: {
            display: false,
            position: "top",
        },
        title: {
            display: true,
            text: datasetLabel
        }
    };

    // Ajouter les bandes si l'option est activée
    if (addBands) {
        plugins.annotation = {
            drawTime: "beforeDatasetsDraw",
            annotations: [
                {
                    // Partie poids sous-poids (rouge)
                    type: 'box',
                    yMax: 18.5,
                    backgroundColor: 'rgba(255, 0, 0, 0.2)',
                    borderWidth: 0,
                },
                {
                    // Partie poids normal (vert)
                    type: 'box',
                    yMin: 18.5,
                    yMax: 25,
                    backgroundColor: 'rgba(76, 175, 80,0.3)',
                    borderWidth: 0,
                },
                {
                    // Partie poids sur-poids (orange)
                    type: 'box',
                    yMin: 25,
                    yMax: 30,
                    backgroundColor: 'rgba(255, 128, 0, 0.2)',
                    borderWidth: 0,
                },
                {
                    // Partie obésité (rouge)
                    type: 'box',
                    yMin: 30,
                    backgroundColor: 'rgba(255, 0, 0, 0.2)',
                    borderWidth: 0,
                }
            ]
        };
    }

    // Définir le dataset avec une couleur de fond sous la courbe
    const dataset = {
        label: datasetLabel,
        data: datasetData,
        borderColor: borderColor,
        tension: 0.4,
        fill: true,  // Remplissage sous la courbe
        backgroundColor: backgroundColor || "rgba(167, 201, 87, 0.2)"  // Si pas de fond passé, couleur par défaut
    };

    const chart = new Chart(ctx, {
        type: "line",
        data: {
            labels: labels,
            datasets: [dataset]
        },
        options: {
            responsive: true,
            plugins: plugins,
            scales: {
                x: {
                    title: {
                        display: true,
                        text: 'Date'
                    }
                },
                y: {
                    title: {
                        display: true,
                        text: yAxisLabel
                    },
                    beginAtZero: true
                }
            }
        }
    });
}

// Initialisation des graphiques
// Fonction pour initialiser le graphe des performances
function initPerformanceChart() {
    initChart(
        "performanceGraphe",
        dates,
        "Temps de jeu",
        tempsjeu,
        "Temps de jeu (minutes)",
        "rgba(76, 175, 80, 1)",
        "rgba(76, 175, 80, 0.2)",
        true,  //sens du graphe
        false  //bande de IMC
    );
}

// Fonction pour initialiser le graphe de l'IMC
function initImcChart() {
    initChart(
        "performanceGrapheImc",
        date,
        "🟥 sous-poids       🟩 poids normal       🟧 sur-poids       🟥 obésité",     //Légende
        imc,
        "IMC",
        "rgba(0,0,0,1)",
        "rgba(76, 175, 80, 0.0)",
        true,  //sens du graphe
        true  //bande de IMC
    );
}
//Appel selon le graphe demandé
document.addEventListener("DOMContentLoaded", () => {
    if (document.getElementById("performanceGraphe")) {
        initPerformanceChart();
    }
    if (document.getElementById("performanceGrapheImc")) {
        initImcChart();
    }
});

// Partie formulaire

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

//Partie confirmation (pop-up)
function confirmDelete() {
    return confirm('Êtes-vous sûr de vouloir supprimer cette performance ?');
}




