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
window.onload = function() {
    // Graphique avec fond sous la courbe (pas de bandes)
    initChart("performanceGraphe", dates, "Temps de jeu", tempsjeu, "Temps de jeu (minutes)", "rgba(76, 175, 80, 1)", "rgba(76, 175, 80, 0.2)", true, false);

    // Graphique avec bandes (IMC)
    initChart("performanceGrapheImc", date, "🟥: sous poids       🟩: poids normal       🟧: sur-poids       🟥: obésité", imc, "IMC", "rgba(0,0,0,1)", "rgba(76, 175, 80, 0.0)", true, true);
};
