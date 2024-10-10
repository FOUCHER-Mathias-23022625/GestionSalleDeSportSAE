<?php
namespace blog\views;
use navebar;
require_once "navebar.php";
use controllers\performanceController; // Assurez-vous de bien importer ce namespace

class performanceView
{
    public function __construct(){

    }

    public function afficher($performances)
    {
        $navebar = new navebar();
        $controller = new PerformanceController();
        $performancesTableHtml = $controller->afficherTableauPerformances($performances);
        echo '<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Suivi des Performances</title>
    <link rel="stylesheet" href="../../../assets/styles/performance.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>
    <header>
        ' . $navebar->afficher() .//$index->url(). '
            '
    </header>

<main id="main-content" class="container">
    <section id="performance-overview">
        <h2 class="section-title">Résumé des Performances</h2>
        <div class="stats">
            <div class="stat-item">
                <h3 class="stat-title">Temps de jeu total</h3>
                <p class="stat-value">35h 25m</p>
            </div>
            <div class="stat-item">
                <h3 class="stat-title">Meilleur score</h3>
                <p class="stat-value">98 points</p>
            </div>
            <div class="stat-item">
                <h3 class="stat-title">Sports pratiqués</h3>
                <p class="stat-value">Basketball, Tennis, Football</p>
            </div>
        </div>
    </section>

    <section id="detail-performance">
        <h2 class="section-title">Détails des Performances</h2>
        <table id="performance-table">
            <thead>
            <tr>
                <th>Date</th>
                <th>Sport</th>
                <th>Temps de jeu</th>
                <th>Score</th>
            </tr>
            </thead>
            <tbody>
                ' . $performancesTableHtml . '
            </tbody>
        </table>
        <div class="button-container">
            <button id="add-performance-btn" onclick="formAjt()">Ajouter une performance</button>
        </div>
    </section>

    <section id="performance-graphe">
        <h2 class="section-title">Statistiques Visualisées</h2>
        <div class="chart">
            <canvas id="performanceGraphe"></canvas>
        </div>
    </section>
</main>

<footer id="main-footer">
    <div class="container">
        <p>&copy; 2024 Salle Multi-Sport - Suivi des Performances</p>
    </div>
</footer>

<div class="overlayForm" id="formOverlayAddPerf">
    <div class="form-container">
        <h1 class="form-title">Ajouter une performance</h1>
        <form class="event-form" action="/?page=performance&form=formAjt" method="POST">
            <span class="close-btn" onclick="closeForm()">&times;</span>
            <label class="form-label" for="Date_">Date</label>
            <input class="form-input" type="DATE" id="Date_" name="Date_" required>

            <label class="form-label" for="Sport">Sport</label>
            <input class="form-input" type="text" id="Sport" name="Sport" required>

            <label class="form-label" for="TmpJeu">Temps de jeu</label>
            <input class="form-input" type="text" id="TmpJeu" name="Durée" required></input>

            <label class="form-label" for="Score">Score</label>
            <input class="form-input" type="text" id="Score" name="Score" ></input>

            <input class="form-submit" type="submit" name="submit" id="submit" value="Ajouter la performance">
        </form>
    </div>
</div>
<!-- Chart.js script -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="../../../assets/scripts/graphe.js"></script>
<script src="../../../assets/scripts/performance_form.js"></script>
</body>

</html>';
    }
}
