<?php
namespace controllers;
use blog\models\performanceModel;
use blog\views\performanceView;
require_once "modules/blog/views/performanceView.php";
require_once "modules/blog/models/performanceModel.php";
require_once "./index.php";



ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

class performanceController
{
    private $model;
    private $view;

    public function __construct()
    {
        $host_name = "127.0.0.1";
        $user_name = "root";
        $password = "";
        $database_name = "saetest";

        $this->model = new performanceModel($host_name, $user_name, $password, $database_name);
        $this->view = new performanceView();
    }

    public function afficherTableauPerformances($performances): string
    {
        $html = '';
        // Vérifie si des performances sont disponibles
        if (!empty($performances)) {
            // Si des performances existent, on affiche le tableau avec toutes les colonnes
            $html .= '<thead>';
            $html .= '<tr>';
            $html .= '<th>Date</th>';
            $html .= '<th>Sport</th>';
            $html .= '<th>Temps de jeu</th>';
            $html .= '<th>Score</th>';
            $html .= '<th>Suppression</th>';
            $html .= '</tr>';
            $html .= '</thead>';
            $html .= '<tbody>';
            // Parcourt chaque performance et génère les lignes du tableau
            foreach ($performances as $performance) {
                $html .= '<tr>';
                $html .= '<td>' . htmlspecialchars($performance['date']) . '</td>';
                $html .= '<td>' . htmlspecialchars($performance['sport']) . '</td>';
                $html .= '<td>' . htmlspecialchars($performance['temps_de_jeu']) . '</td>';
                $html .= '<td>' . htmlspecialchars($performance['score']) . '</td>';

                // Ajout de bouton de suppression à chaque ligne
                $html .= '<td>';
                $html .= '<form method="POST" action="deletePerformance" onsubmit="return confirmDelete();">'; // Appel de la fonction
                $html .= '<input type="hidden" name="Date" value="' . htmlspecialchars($performance['date']) . '">';
                $html .= '<input type="hidden" name="Sport" value="' . htmlspecialchars($performance['sport']) . '">';
                $html .= '<button type="submit" class="delete-btnPerf">Supprimer</button>';
                $html .= '</form>';
                $html .= '</td>';


                $html .= '</tr>';
            }
        } else {
            // Si aucune performance n'est disponible, on affiche un message sans la colonne Suppression/Modification
            $html .= '<thead>';
            $html .= '<tr>';
            $html .= '<th>Date</th>';
            $html .= '<th>Sport</th>';
            $html .= '<th>Temps de jeu</th>';
            $html .= '<th>Score</th>';
            $html .= '</tr>';
            $html .= '</thead>';
            $html = '<tr><td colspan="4">Aucune performance enregistrée.</td></tr>';
        }


        return $html; // Retourne le code HTML pour l'affichage dans la vue
    }

    public function affichePerf(): void
    {
        $model = new performanceModel('mysql-gestionsaetest.alwaysdata.net', '379076', 'gestionSae', 'gestionsaetest_bd');
        $view = new performanceView();
        $view->afficher($model->getPerformances());
    }

    public function afficheSport($performances): string
    {
        // Vérifie si des performances sont disponibles
        if (!empty($performances)) {
            $sports = [];
            foreach ($performances as $performance) {
                $sport = htmlspecialchars($performance['sport']);
                // Ajoute le sport s'il n'est pas déjà dans le tableau
                if (!in_array($sport, $sports)) {
                    $sports[] = $sport;
                }
            }
            // Génère une chaîne de sports séparée par des virgules
            $html = implode(', ', $sports);
        } else {
            // Si aucun sport pratiqué
            $html = '<p>Aucun sport pratiqué.</p>';
        }
        return $html; // Retourne le code HTML pour l'affichage dans la vue
    }

    function afficheTmps($performances): string
    {
        $tempsTotal = 0;
        // Vérifie si des performances sont disponibles
        if (!empty($performances)) {
            foreach ($performances as $performance) {
                // Additionne la durée en minutes pour chaque performance
                $tempsTotal += (int)$performance['temps_de_jeu'];
            }
        }
        // Convertit le temps total en heures et minutes
        $heures = floor($tempsTotal / 60);
        $minutes = $tempsTotal % 60;

        // Génère une chaîne pour afficher le temps sous forme "X heures et Y minutes"
        $resultat = $heures . ' heure' . ($heures > 1 ? 's' : '') .
            ' et ' . $minutes . ' minute' . ($minutes > 1 ? 's' : '');

        return $resultat;
    }

    function afficheTotVictoire($performances): int
    {
        $totalVictoire = 0;

        // Vérifie si des performances sont disponibles
        if (!empty($performances)) {
            foreach ($performances as $performance) {
                if ($performance['resultat']) {
                    $totalVictoire += 1;
                }
            }
        }
        return $totalVictoire;
    }

    public function getPerformanceJson() {
        $model = new performanceModel('host_name', 'user_name', 'password', 'database_name');
        $performances = $model->getPerformances();

        header('Content-Type: application/json');
        echo json_encode($performances);
    }

    public function getPerformanceDataForGraph(): array
    {
        $performances = $this->model->getPerformances();

        $dates = [];
        $tempsjeu = [];

        foreach ($performances as $performance) {
            $dates[] = $performance['date'];
            $tempsjeu[] = (int)$performance['temps_de_jeu'];
        }

        // Retourner un tableau associatif avec les données nécessaires pour le graphe
        return [
            'dates' => $dates,
            'temps_de_jeu' => $tempsjeu
        ];
    }
    public function addPerformance(): void
    {
        // Récupère les données du formulaire
        $date = $_POST['Date'];
        $sport = $_POST['Sport'];
        $tempsJeu = $_POST['TempsJeu'];
        $score = $_POST['Score'];
        $resultat = ($_POST['resultat'] === 'Victoire') ? 1 : 0;

        // Récupérer la date du jour
        $currentDate = date('Y-m-d');

        // Vérifier si la date de la performance n'est pas supérieure à la date du jour
        if ($date > $currentDate) {
            $_SESSION['error_message'] = "La date de la performance ne peut pas être supérieure à la date du jour.";
            echo "La date de la performance ne peut pas être supérieure à la date du jour.";
            header('Location:affichePerf');
            exit();
        }
        // Vérifie que toutes les données obligatoires sont présentes
        if ($date && $sport && $tempsJeu && $score && $resultat !== null) {
            // Ajouter la performance à la base de données
            $this->model->insertPerformance($date, $sport, $tempsJeu, $score, $resultat);
            header('Location:affichePerf');
            exit();
        }
        else {
            echo "Veuillez remplir tous les champs obligatoires.";
        }
    }

    public function deletePerformance(): void
    {
        $date = $_POST['Date'];
        $sport = $_POST['Sport'];
        // Vérifie que la cle primaire est bien fourni
        if ($date && $sport) {
            $this->model->deletePerformance($date, $sport);

            // Redirection après la suppression
            header('Location: affichePerf');
            exit();
        } else {
            echo "Primary key de la performance non valide.";
        }
    }
}
