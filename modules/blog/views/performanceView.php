<?php
namespace blog\views;
use navebar;
require_once "Layout.php";
use controllers\performanceController;

class performanceView
{

    public function afficher($performances,$imc)
    {
        ob_start();
        // Affichage du message d'erreur, s'il existe
        if (isset($_SESSION['error_message'])) {
            echo '<div class="error-messagePerf">' . $_SESSION['error_message'] . '</div>';
            unset($_SESSION['error_message']); // Supprimer le message après l'affichage
        }
        $controller = new PerformanceController();
        $afficherTabPerf = $controller->afficherTableauPerformances($performances);
        $sports = $controller->afficheSport($performances);
        $tempsJeu= $controller->afficheTmps($performances);
        $victoire= $controller->afficheTotVictoire($performances);

        //IMC
        $afficheImc = $controller->afficheImc();
        $afficheHistorique = $controller->afficheHistorique();


        // Récupérer les données pour le graphique
        $graphData = $controller->getPerformanceDataForGraph();
        $datesJson = json_encode($graphData['dates']);
        $tempsjeuJson = json_encode($graphData['temps_de_jeu']);

        // données pour graphique Imc
        $graphDataImc = $controller->getPerformanceDataForGraphImc();
        $dateJson = json_encode($graphDataImc['date']);
        $imcJson = json_encode($graphDataImc['imc']);?>


<main id="main-contentPerf" class="containerPerf">
    <section id="performance-overviewPerf">
        <h2 class="section-titlePerf">Résumé des Performances</h2>
        <div class="statsPerf">
            <div class="stat-itemPerf">
                <h3 class="stat-titlePerf">Temps de jeu total</h3>
                <p class="stat-valuePerf"> <?php echo $tempsJeu ?></p>
            </div>
            <div class="stat-itemPerf">
                <h3 class="stat-titlePerf">Nombre de victoire</h3>
                <p class="stat-valuePerf"><?php echo $victoire ?></p>
            </div>
            <div class="stat-itemPerf">
                <h3 class="stat-titlePerf">Sports pratiqués</h3>
                <p class="stat-valuePerf"><?php echo $sports ?></p>
            </div>
        </div>
    </section>

    <section id="detail-performancePerf">
        <h2 class="section-titlePerf">Détails des Performances</h2>
        <table id="performance-tablePerf">
            <?php if ($afficherTabPerf) : ?>
            <!-- Si des performances existent, on affiche le tableau avec toutes les colonnes-->
            <thead>
            <tr>
                <th>Date</th>
                <th>Sport</th>
                <th>Temps de jeu</th>
                <th>Score</th>
                <th>Suppression</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($performances as $performance): ?>
            <tr>
                <td><?php echo htmlspecialchars($performance['date']); ?></td>
                <td><?php echo htmlspecialchars($performance['sport']); ?></td>

                <td><?php echo htmlspecialchars($performance['temps_de_jeu']); ?></td>
                <td><?php echo htmlspecialchars($performance['score']); ?></td>
                <td>
                    <form method="POST" action="deletePerformance" onsubmit="return confirmDelete();">
                        <input type="hidden" name="Date" value="[date]">
                        <input type="hidden" name="Sport" value="[sport]">
                        <button type="submit" class="delete-btnPerf">Supprimer</button>
                    </form>
                </td>
            </tr>
            <?php endforeach; ?>
            </tbody>
            <?php endif; ?>
            <?php if (!$afficherTabPerf) : ?>
            <section id="pas_valeurs">
            <thead>
            <tr>
                <th>Date</th>
                <th>Sport</th>
                <th>Temps de jeu</th>
                <th>Score</th>
            </tr>
            </thead>
            <tr>
                <td colspan="4">Aucune performance enregistrée.</td>
            </tr>
            </section>
            <?php endif; ?>

        </table>
        <div class="button-containerPerf">
            <button id="add-performance-btnPerf" onclick="formAjt()">Ajouter une performance</button>
        </div>
    </section>

    <?php if (count($performances) >= 2) : ?>
        <section id="performance-graphePerf">
            <h2 class="section-titlePerf">Statistiques Visualisées</h2>
            <div class="chartPerf">
                <canvas id="performanceGraphe"></canvas>
            </div>
    <?php endif; ?>

    <!-- Graphique IMC : -->
    <section id="ImcPerf">
        <h2 class="section-titlePerf">Indice de masse corporelle</h2>
        <?php echo $afficheImc ?>
        <br>
        <?php echo $afficheHistorique ?>
    </section>

    <?php if (count($imc) >= 2) : ?>
        <section id="performance-grapheImc">
            <h2 class="section-titlePerf">Mon évolution</h2>
            <div class="chartPerf">
                <canvas id="performanceGrapheImc"></canvas>
            </div>
        </section>
    <?php endif; ?>
</main>


        <footer id="main-footerPerf">
    <div class="containerPerf">
        <p>&copy; 2024 Salle Multi-Sport - Suivi des Performances</p>
    </div>
</footer>

<div class="overlayFormPerf" id="formOverlayAddPerf">
    <div class="form-containerPerf">
        <h1 class="form-titlePerf">Ajouter une performance</h1>
        <form class="event-formPerf" action="addPerformance" method="POST">
            <span class="close-btnPerf" onclick="closeForm()">&times;</span>
            <br>
            <!--Date-->
            <div class="placeholder-form">
                <label class="form-labelPerf" for="Date">Date</label>
                <input class="form-inputPerf" type="DATE" id="Date" name="Date" required>
            </div>
            <br><br>
            <!--Sport-->
            <div class="placeholder-form">
                <label class="form-labelPerf" for="Sport">Sport</label>
                <select class="form-selectPerf" id="Sport" name="Sport" required>
                    <option value=""> Sélectionnez un sport </option>
                    <option value="Volley">Volley</option>
                    <option value="Football">Football</option>
                    <option value="Tennis">Tennis</option>
                    <option value="Ping-Pong">Ping-Pong</option>
                    <option value="Badminton">Badminton</option>
                </select>
            </div>
            <br><br>
            <!--Temps de jeu-->
            <div class="placeholder-form">
                <label class="form-labelPerf" for="TmpJeu">Temps de jeu </label>
                <input class="form-inputPerf" type="number" id="TmpJeu" name="TempsJeu" required>
            </div>
            <br><br>
            <!--Score-->
            <div class="placeholder-form">
                <label class="form-labelPerf" for="Score">Score</label>
                <input class="form-inputPerf" type="text" id="Score" name="Score" required>
            </div>
            <br><br>
            <!--Resultat-->
            <div class="form-radio-groupPerf">
                <label class="form-radioPerf">
                    <input type="radio" name="resultat" value="Victoire" required>
                    <span class="custom-radioPerf"></span> Victoire
                </label>
                <label class="form-radioPerf">
                    <input type="radio" name="resultat" value="Défaite" required>
                    <span class="custom-radioPerf"></span> Défaite
                </label>
            </div>
            <br>
            <input class="form-submitPerf" type="submit" name="submit" id="submit" value="Ajouter la performance">

        </form>
    </div>
</div>
<div class="overlayFormPerf" id="formOverlayAddImc">
    <div class="form-containerPerf">
        <h1 class="form-titlePerf">Mon IMC</h1>
        <form class="event-formPerf" action="addImc" method="POST">
            <span class="close-btnPerf" onclick="closeFormImc()">&times;</span>
            <br>
            <!--Taille -->
                <div class="placeholder-form">
                    <label class="unite">cm</label>
                <input class="form-inputPerf" type="number" id="taille" name="taille" placeholder="Ma taille" min="100" max="250" required>
            </div>
            <br><br>
            <!-- Poids -->
            <div class="placeholder-form">
                <label class="unite">kg</label>
                <input class="form-inputPerf" type="number" id="poids" name="poids" placeholder="Mon poids" min="30" max="300" required>
            </div>
            <br><br>
            <input class="form-submitPerf" type="submit" name="submit" id="submit" value="Découvrir mon IMC">
        </form>
    </div>
</div>
<!-- Chart.js script -->
<script>
    // Données du graphe
    const dates = <?php echo $datesJson ?>;
    const tempsjeu = <?php echo $tempsjeuJson ?>;

    console.log(dates);
    console.log(tempsjeu);

    //données du graphe Imc
    const date = <?php echo $dateJson ?>;
    const imc = <?php echo $imcJson ?>;

    console.log(date);
    console.log(imc);
</script>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="/GestionSalleDeSportSAE/assets/scripts/graphe.js"></script>
<script src="/GestionSalleDeSportSAE/assets/scripts/performance_form.js"></script>
<script src="/GestionSalleDeSportSAE/assets/scripts/confirmSupprPerformance.js"></script>

<?php
        (new \blog\views\Layout('Mes Performances',ob_get_clean()))->afficher();
    }
}
?>
