// Script pour initialiser le graphique
window.onload = function() {
    const ctx = document.getElementById("performanceGraphe").getContext("2d");
    const performanceChart = new Chart(ctx, {
        type: "line",
        data: {
            labels: dates, // Utilisation de la variable dates injectée
            datasets: [{
                label: "Temps de jeu",
                data: tempsjeu, // Utilisation de la variable tempsjeu injectée
                borderColor: "rgba(167, 201, 87, 1)",
                backgroundColor: "rgba(167, 201, 87, 0.2)",
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
                    text: "Évolution des Performances"
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
                        text: 'Temps de jeu (minutes)'
                    },
                    beginAtZero: true
                }
            }
        }
    });
};
