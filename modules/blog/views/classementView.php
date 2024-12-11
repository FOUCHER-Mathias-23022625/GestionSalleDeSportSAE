<?php
namespace blog\views;
use navebar;
require_once "Layout.php";
use controllers\classementController;

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
        ?>
        <main id="main-contentClass" class="containerClass">
            <h1 class="section-titleClass">Classements des adhérents</h1>
            <section id="win-content">
                <h2>Nombre de victoires </h2>
                <thead>
                    <tr>
                        <th>Rang</th>
                        <th>Nom</th>
                        <th>Prenom</th>
                        <th>Nombres de victoires</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (!empty($classement)) {
                        $rank = 1;
                        foreach ($classement as $row) {
                            echo '<tr>';
                            echo '<td>' . $rank++ . '</td>';
                            echo '<td>' . htmlspecialchars($row['nom']) . '</td>';
                            echo '<td>' . htmlspecialchars($row['prenom']) . '</td>';
                            echo '<td>' . htmlspecialchars($row['victoires']) . '</td>';
                            echo '</tr>';
                        }
                    } else {
                        echo '<tr><td colspan="4">Aucun adhérent trouvé.</td></tr>';
                    }
                    ?>
                </tbody>
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