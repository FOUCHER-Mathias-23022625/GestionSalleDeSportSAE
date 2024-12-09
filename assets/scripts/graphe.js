// Fonction pour initialiser un graphique avec l'option d'inverser les données
function initChart(canvasId, labels, datasetLabel, datasetData, yAxisLabel, borderColor, backgroundColor, reverse = false) {
    // Inverser les labels et les données si reverse est true
    if (reverse) {
        labels = labels.slice().reverse();
        datasetData = datasetData.slice().reverse();
    }

    const ctx = document.getElementById(canvasId).getContext("2d");
    const chart = new Chart(ctx, {
        type: "line",
        data: {
            labels: labels, // Les dates ou autres labels pour l'axe X
            datasets: [{
                label: datasetLabel, // Label de la dataset
                data: datasetData, // Données pour l'axe Y
                borderColor: borderColor,
                backgroundColor: backgroundColor,
                fill: true,
                tension: 0.4
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    display: true,
                    position: "top",
                },
                title: {
                    display: true,
                    text: datasetLabel
                }
            },
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
                        text: yAxisLabel // Label pour l'axe Y
                    },
                    beginAtZero: true
                }
            }
        }
    });
}

// Initialisation du graphique
window.onload = function() {
    initChart("performanceGraphe", dates, "Temps de jeu", tempsjeu, "Temps de jeu (minutes)", "rgba(167, 201, 87, 1)", "rgba(167, 201, 87, 0.2)",true);

    // Initialisation d'un autre graphique pour l'IMC
    initChart("performanceGrapheImc", date, "IMC", imc, "IMC", "rgba(167, 201, 87, 1)", "rgba(167, 201, 87, 0.2)",true);
};
