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
        // Récupération des données du classement
        $performance = new classementController();
        $classement = $performance->afficheClassementVictoire();
        ?>
        <main id="main-contentClass" class="containerClass">
            <h1 class="section-titleClass">Classements des adhérents</h1>
            <section id="win-content">
                <h2>Nombre de victoires </h2>
                <table id="classement-table">
                    <thead>
                        <tr>
                            <th>Rang</th>
                            <th>Nom</th>
                            <th>Prénom</th>
                            <th>Nombres de victoires</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php $rank = 1; ?>
                    <?php foreach ($classement as $row) : ?>
                        <tr class="<?php echo ($row['IdUtilisateur'] == $_SESSION['id']) ? 'highlight' : ''; ?>">
                        <td>
                                <?php
                                // Affichage des médailles en fonction du rang
                                if ($rank == 1) {
                                    echo "🥇 "; // Médaille d'or pour le premier
                                } elseif ($rank == 2) {
                                    echo "🥈 "; // Médaille d'argent pour le deuxième
                                } elseif ($rank == 3) {
                                    echo "🥉 "; // Médaille de bronze pour le troisième
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