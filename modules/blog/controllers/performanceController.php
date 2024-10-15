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

    /*public function showPerformance()
    {
        $performances = $this->model->getPerformances(); // Récupère les données de la base
        // Inclure la vue et passer les données
        if (file_exists(__DIR__ . '/../views/performanceView.php')) {
            // On passe $performances à la vue
            include __DIR__ . '/../views/performanceView.php';
        } else {
            echo "Vue non trouvée";
        }
    }
*/
    public function afficherTableauPerformances($performances): string
    {
        // Vérifie si des performances sont disponibles
        if (!empty($performances)) {
            $html = '';
            // Parcourt chaque performance et génère les lignes du tableau
            foreach ($performances as $performance) {
                $html .= '<tr>';
                $html .= '<td>' . htmlspecialchars($performance['date']) . '</td>';
                $html .= '<td>' . htmlspecialchars($performance['sport']) . '</td>';
                $html .= '<td>' . htmlspecialchars($performance['temps_de_jeu']) . '</td>';
                $html .= '<td>' . htmlspecialchars($performance['score']) . '</td>';

                $html .= '</tr>';
            }
        } else {
            // Si aucune performance n'est disponible
            $html = '<tr><td colspan="4">Aucune performance enregistrée.</td></tr>';
        }


        return $html; // Retourne le code HTML pour l'affichage dans la vue
    }

    public function affichePerf(): void
    {
        $model = new performanceModel('127.0.0.1', 'root', '', 'saetest');
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

}
