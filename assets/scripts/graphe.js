<!-- Script pour initialiser le graphique -->
    window.onload = function() {
    const ctx = document.getElementById('performanceGraphe').getContext('2d');
    const performanceChart = new Chart(ctx, {
    type: 'line',
    data: {
    labels: ['Septembre', 'Octobre', 'Novembre', 'Décembre', 'Janvier'],
    datasets: [{
    label: 'Score',
    data: [85, 92, 78, 88, 95],
    borderColor: 'rgba(0, 123, 255, 1)',
    backgroundColor: 'rgba(0, 123, 255, 0.2)',
    fill: true,
    tension: 0.4
}]
},
    options: {
    responsive: true,
    plugins: {
    legend: {
    display: true,
    position: 'top',
},
    title: {
    display: true,
    text: 'Évolution des Performances'
}
},
    scales: {
    y: {
    beginAtZero: true
}
}
}
});
};
