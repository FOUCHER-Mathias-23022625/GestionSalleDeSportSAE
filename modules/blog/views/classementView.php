<?php
namespace blog\views;
use controllers\classementController;
use controllers\performanceController;

use navebar;
require_once "Layout.php";

class classementView
{

    public function afficher()
    {
        ob_start();
        // Affichage d'un message d'erreur, s'il existe
        if (isset($_SESSION['error_message'])) {
            echo '<div class="error-messagePerf">' . $_SESSION['error_message'] . '</div>';
            unset($_SESSION['error_message']); // Supprimer le message après l'affichage
        }

        // Affichage d'un message de validation', s'il existe
        if (isset($_SESSION['valid_message'])) {
            echo '<div class="valid_messagePerf">' . $_SESSION['valid_message'] . '</div>';
            unset($_SESSION['valid_message']); // Supprimer le message après l'affichage
        }
        // Récupération des données des classements
        $performance = new classementController();
        $classementV = $performance->afficheClassementVictoire();
        $classementP = $performance->afficheClassementNBPerformance();
        $classementT = $performance->afficheClassementTempsCumule();
        ?>
        <main id="main-contentClass" class="containerClass">
            <h1 class="section-titleClass">Classements des adhérents</h1>

            <!-- Onglets -->
            <div class="tab-container">
                <button class="tab-button active" onclick="showTab(event, 'victoires')">Plus de victoires</button>
                <button class="tab-button" onclick="showTab(event, 'nbPerf')">Plus sportif</button>
                <button class="tab-button" onclick="showTab(event, 'nbTemps')">Plus endurant</button>
            </div>

            <!-- Contenu des onglets -->
            <section id="victoires" class="tab-content active">
                <h2>Classement par victoires</h2>
                <table id="classement-table">
                    <thead>
                    <tr>
                        <th>Rang</th>
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>Nombre de victoires</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $rank = 1; ?>
                    <?php foreach ($classementV as $row) : ?>
                        <tr class="<?php echo ($row['IdUtilisateur'] == $_SESSION['id']) ? 'highlight' : ''; ?>">
                            <td>
                                <?php
                                // Affichage des médailles en fonction du rang
                                if ($rank == 1) {
                                    echo "🥇 ";
                                } elseif ($rank == 2) {
                                    echo "🥈 ";
                                } elseif ($rank == 3) {
                                    echo "🥉 ";
                                }
                                echo $rank++;
                                ?>
                            </td>
                            <td><?php echo htmlspecialchars($row['NomU']) ?></td>
                            <td><?php echo htmlspecialchars($row['PrenomU']) ?></td>
                            <td><?php echo htmlspecialchars($row['nombre_victoires']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </section>

            <section id="nbPerf" class="tab-content">
                <h2>Classement par nombres de performances</h2>
                <table id="classement-table">
                    <thead>
                    <tr>
                        <th>Rang</th>
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>Nombre de performances</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $rank = 1; ?>
                    <?php foreach ($classementP as $rows) : ?>
                        <tr class="<?php echo ($rows['IdUtilisateur'] == $_SESSION['id']) ? 'highlight' : ''; ?>">
                            <td>
                                <?php
                                // Affichage des médailles en fonction du rang
                                if ($rank == 1) {
                                    echo "🥇 ";
                                } elseif ($rank == 2) {
                                    echo "🥈 ";
                                } elseif ($rank == 3) {
                                    echo "🥉 ";
                                }
                                echo $rank++;
                                ?>
                            </td>
                            <td><?php echo htmlspecialchars($rows['NomU']) ?></td>
                            <td><?php echo htmlspecialchars($rows['PrenomU']) ?></td>
                            <td><?php echo htmlspecialchars($rows['nombre_performances']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </section>

            <section id="nbTemps" class="tab-content">
                <h2>Classement par temps de performances</h2>
                <table id="classement-table">
                    <thead>
                    <tr>
                        <th>Rang</th>
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>Temps cumulés</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $rank = 1; ?>
                    <?php foreach ($classementT as $row) : ?>
                        <tr class="<?php echo ($row['IdUtilisateur'] == $_SESSION['id']) ? 'highlight' : ''; ?>">
                            <td>
                                <?php
                                // Affichage des médailles en fonction du rang
                                if ($rank == 1) {
                                    echo "🥇 ";
                                } elseif ($rank == 2) {
                                    echo "🥈 ";
                                } elseif ($rank == 3) {
                                    echo "🥉 ";
                                }
                                echo $rank++;
                                ?>
                            </td>
                            <td><?php echo htmlspecialchars($row['NomU']) ?></td>
                            <td><?php echo htmlspecialchars($row['PrenomU']) ?></td>
                            <td><?php echo htmlspecialchars($row['temps_cumule']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </section>
        </main>

        <footer id="main-footerPerf">
            <div class="containerPerf">
                <p>&copy; 2024 Salle Multi-Sport - Suivi des Performances</p>
            </div>
        </footer>

        <?php
        (new \blog\views\Layout('Classements',ob_get_clean()))->afficher();
    }
}
?>

<script src="/GestionSalleDeSportSAE/assets/scripts/classement.js"></script>
